<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Jabatan;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * MASTER JABATAN — CRUD jabatan berhirarki (terikat bidang) di
 * panel admin.
 *
 * Otorisasi: middleware `permission:master_jabatan.*` per aksi route
 * (pola sama dengan `karyawan_data.*` — tidak ada sistem otorisasi baru).
 *
 * Validasi relasi (semua server-side):
 * - bidang_id WAJIB dan HANYA ke bidangs.id.
 * - parent_id HANYA ke jabatans.id (bukan ke bidang), boleh NULL.
 * - diri sendiri tidak boleh jadi parent; siklus multi-tingkat ditolak.
 * - penghapusan ditolak bila masih punya child jabatan atau masih
 *   dipakai data karyawan (kolom string karyawans.jabatan — DIBACA saja).
 */
class MasterJabatanController extends Controller
{
    /** Daftar tabel berjenjang per bidang: akar dulu, lalu child-nya. */
    public function index()
    {
        $rows = Jabatan::treeOrdered(Jabatan::withCount('children'), ['bidang', 'parent']);

        return view('admin.master.jabatan.index', [
            'rows'    => $rows,
            'total'   => $rows->count(),
            'roots'   => $rows->where('depth', 0)->count(),
            'bidangs' => Bidang::orderBy('nama')->get(),
        ]);
    }

    public function show(Jabatan $jabatan)
    {
        return view('admin.master.jabatan.show', [
            'jabatan'       => $jabatan,
            'bidang'        => $jabatan->bidang,
            'parent'        => $jabatan->parent,
            'children'      => $jabatan->children()->orderBy('nama')->get(),
            'karyawanUsage' => $jabatan->karyawanUsage(),
        ]);
    }

    public function create()
    {
        return view('admin.master.jabatan.form', [
            'jabatan' => null,
            'bidangs' => Bidang::orderBy('nama')->get(),
            'parents' => Jabatan::treeOrdered(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validatePayload($request);

        $jabatan = Jabatan::create($validated);

        ActivityLogger::log('create', null, [
            'module'      => 'master_jabatan',
            'description' => "menambahkan jabatan \"{$jabatan->nama}\"",
            'subject'     => $jabatan,
        ]);

        return redirect()->route('admin.master_jabatan.index')
            ->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function edit(Jabatan $jabatan)
    {
        // Opsi parent: kecualikan diri sendiri + seluruh keturunan
        // (pencegah siklus di sisi tampilan; server tetap validasi ulang).
        $excluded = array_merge([(int) $jabatan->id], $jabatan->descendantIds());
        $parents = Jabatan::treeOrdered()
            ->reject(fn (array $row) => in_array((int) $row['node']->id, $excluded, true))
            ->values();

        return view('admin.master.jabatan.form', [
            'jabatan' => $jabatan,
            'bidangs' => Bidang::orderBy('nama')->get(),
            'parents' => $parents,
        ]);
    }

    public function update(Request $request, Jabatan $jabatan)
    {
        $validated = $this->validatePayload($request, $jabatan);

        $jabatan->update($validated);

        ActivityLogger::log('update', null, [
            'module'      => 'master_jabatan',
            'description' => "mengubah jabatan \"{$jabatan->nama}\"",
            'subject'     => $jabatan,
        ]);

        return redirect()->route('admin.master_jabatan.index')
            ->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy(Jabatan $jabatan)
    {
        // Proteksi hapus — pesan jelas, data tidak disentuh sama sekali.
        $childCount = $jabatan->children()->count();

        if ($childCount > 0) {
            return redirect()->route('admin.master_jabatan.index')->withErrors([
                'delete' => "Jabatan \"{$jabatan->nama}\" tidak dapat dihapus karena masih memiliki {$childCount} jabatan anak. "
                    . 'Pindahkan atau hapus jabatan anak tersebut terlebih dahulu.',
            ]);
        }

        $karyawanUsage = $jabatan->karyawanUsage();

        if ($karyawanUsage > 0) {
            return redirect()->route('admin.master_jabatan.index')->withErrors([
                'delete' => "Jabatan \"{$jabatan->nama}\" tidak dapat dihapus karena masih digunakan oleh {$karyawanUsage} data karyawan. "
                    . 'Data karyawan tidak diubah otomatis — sesuaikan manual bila memang jabatan sudah tidak berlaku.',
            ]);
        }

        $nama = $jabatan->nama;
        $jabatan->delete();

        ActivityLogger::log('delete', null, [
            'module'      => 'master_jabatan',
            'description' => "menghapus jabatan \"{$nama}\"",
        ]);

        return redirect()->route('admin.master_jabatan.index')
            ->with('success', 'Jabatan berhasil dihapus.');
    }

    /**
     * Aturan validasi bersama store() & update() — termasuk pengecekan
     * bidang & parent (diri sendiri, siklus hierarki) di sisi server.
     *
     * @return array{nama: string, bidang_id: int, parent_id: ?int}
     */
    private function validatePayload(Request $request, ?Jabatan $jabatan = null): array
    {
        $validated = $request->validate([
            'nama'      => ['required', 'string', 'max:100'],
            'bidang_id' => ['required', 'integer', 'exists:bidangs,id'],
            'parent_id' => ['nullable', 'integer', 'exists:jabatans,id'],
        ], [
            'nama.required'      => 'Nama jabatan wajib diisi.',
            'nama.max'           => 'Nama jabatan maksimal 100 karakter.',
            'bidang_id.required' => 'Bidang tempat jabatan berada wajib dipilih.',
            'bidang_id.exists'   => 'Bidang yang dipilih tidak ditemukan — pilih dari daftar bidang yang tersedia.',
            'parent_id.integer'  => 'Parent jabatan tidak valid.',
            'parent_id.exists'   => 'Parent jabatan tidak ditemukan — pilih dari daftar jabatan yang tersedia.',
        ]);

        // Field nullable yang tidak dikirim bisa tidak ikut masuk $validated.
        $parentId = ! empty($validated['parent_id']) ? (int) $validated['parent_id'] : null;

        if ($jabatan !== null && $jabatan->createsCycle($parentId)) {
            throw ValidationException::withMessages([
                'parent_id' => $parentId === (int) $jabatan->id
                    ? 'Tidak boleh memilih jabatan itu sendiri sebagai parent.'
                    : 'Parent tidak valid — pilihan itu adalah keturunan dari jabatan ini dan akan membentuk siklus hierarki.',
            ]);
        }

        $validated['bidang_id'] = (int) $validated['bidang_id'];
        $validated['parent_id'] = $parentId;

        return $validated;
    }
}
