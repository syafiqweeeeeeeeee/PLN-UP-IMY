<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Jabatan;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

/**
 * MASTER BIDANG — CRUD bidang berhirarki di panel admin.
 *
 * Otorisasi: middleware `permission:master_bidang.*` per aksi route
 * (permission terdaftar di PermissionSeeder — di luar matriks admin,
 * pola sama dengan `karyawan_data.*`; tidak ada sistem otorisasi baru).
 *
 * Validasi relasi (semua server-side):
 * - parent_id HANYA ke bidangs.id (Rule exists pada tabel bidangs).
 * - parent boleh NULL (bidang tingkat teratas).
 * - diri sendiri tidak boleh jadi parent; siklus multi-tingkat ditolak.
 * - penghapusan ditolak bila masih punya child, masih dipakai jabatan,
 *   atau masih dipakai data karyawan (kolom string karyawans.bidang —
 *   DIBACA saja, tidak pernah diubah).
 */
class MasterBidangController extends Controller
{
    /** Daftar tabel berjenjang: akar dulu, lalu child-nya (indent). */
    public function index()
    {
        $rows = Bidang::treeOrdered(Bidang::withCount('children'), ['parent']);

        return view('admin.master.bidang.index', [
            'rows'  => $rows,
            'total' => $rows->count(),
            'roots' => $rows->where('depth', 0)->count(),
        ]);
    }

    public function show(Bidang $bidang)
    {
        $children = $bidang->children()->orderBy('nama')->get();
        $jabatans = $bidang->jabatans()->orderBy('nama')->get();

        return view('admin.master.bidang.show', [
            'bidang'        => $bidang,
            'parent'        => $bidang->parent,
            'children'      => $children,
            'jabatans'      => $jabatans,
            'karyawanUsage' => $bidang->karyawanUsage(),
        ]);
    }

    public function create()
    {
        return view('admin.master.bidang.form', [
            'bidang'  => null,
            'parents' => Bidang::treeOrdered(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validatePayload($request);

        $bidang = Bidang::create($validated);

        ActivityLogger::log('create', null, [
            'module'      => 'master_bidang',
            'description' => "menambahkan bidang \"{$bidang->nama}\"",
            'subject'     => $bidang,
        ]);

        return redirect()->route('admin.master_bidang.index')
            ->with('success', 'Bidang berhasil ditambahkan.');
    }

    public function edit(Bidang $bidang)
    {
        // Opsi parent di form: kecualikan diri sendiri + seluruh
        // keturunan (supaya siklus tak bisa dipilih dari UI; server
        // tetap memvalidasi ulang).
        $excluded = array_merge([(int) $bidang->id], $bidang->descendantIds());
        $parents = Bidang::treeOrdered()
            ->reject(fn (array $row) => in_array((int) $row['node']->id, $excluded, true))
            ->values();

        return view('admin.master.bidang.form', compact('bidang', 'parents'));
    }

    public function update(Request $request, Bidang $bidang)
    {
        $validated = $this->validatePayload($request, $bidang);

        $bidang->update($validated);

        ActivityLogger::log('update', null, [
            'module'      => 'master_bidang',
            'description' => "mengubah bidang \"{$bidang->nama}\"",
            'subject'     => $bidang,
        ]);

        return redirect()->route('admin.master_bidang.index')
            ->with('success', 'Bidang berhasil diperbarui.');
    }

    public function destroy(Bidang $bidang)
    {
        // Proteksi hapus — pesan jelas, data tidak disentuh sama sekali.
        $childCount = $bidang->children()->count();

        if ($childCount > 0) {
            return redirect()->route('admin.master_bidang.index')->withErrors([
                'delete' => "Bidang \"{$bidang->nama}\" tidak dapat dihapus karena masih memiliki {$childCount} sub-bidang. "
                    . 'Pindahkan atau hapus sub-bidang tersebut terlebih dahulu.',
            ]);
        }

        $jabatanCount = $bidang->jabatans()->count();

        if ($jabatanCount > 0) {
            return redirect()->route('admin.master_bidang.index')->withErrors([
                'delete' => "Bidang \"{$bidang->nama}\" tidak dapat dihapus karena masih menjadi induk dari {$jabatanCount} jabatan. "
                    . 'Hapus atau pindahkan jabatan tersebut terlebih dahulu.',
            ]);
        }

        $karyawanUsage = $bidang->karyawanUsage();

        if ($karyawanUsage > 0) {
            return redirect()->route('admin.master_bidang.index')->withErrors([
                'delete' => "Bidang \"{$bidang->nama}\" tidak dapat dihapus karena masih digunakan oleh {$karyawanUsage} data karyawan. "
                    . 'Data karyawan tidak diubah otomatis — sesuaikan manual bila memang bidang sudah tidak berlaku.',
            ]);
        }

        // Akun pengguna (tabel users) yang terikat bidang ini lewat
        // users.bidang_id (form Tambah/Edit Pengguna) — relasi FK
        // restrictOnDelete juga melindungi di level database.
        $userUsage = $bidang->userUsage();

        if ($userUsage > 0) {
            return redirect()->route('admin.master_bidang.index')->withErrors([
                'delete' => "Bidang \"{$bidang->nama}\" tidak dapat dihapus karena masih digunakan oleh {$userUsage} akun pengguna. "
                    . 'Data akun tidak diubah otomatis — pindahkan atau longgarkan terikatan akun tersebut terlebih dahulu.',
            ]);
        }

        // Link Kerja yang menargetkan bidang ini (kolom work_links.bidang_id).
        // Menghapus bidang akan melepas target link — relasi harus tetap
        // konsisten, jadi penghapusan ditolak sampai link dipindahkan/
        // dihapus. FK restrictOnDelete juga menjaga di level database.
        $workLinkUsage = $bidang->workLinks()->count();

        if ($workLinkUsage > 0) {
            return redirect()->route('admin.master_bidang.index')->withErrors([
                'delete' => "Bidang \"{$bidang->nama}\" tidak dapat dihapus karena masih menjadi target {$workLinkUsage} Link Kerja. "
                    . 'Pindahkan atau hapus link tersebut terlebih dahulu.',
            ]);
        }

        $nama = $bidang->nama;
        $bidang->delete();

        ActivityLogger::log('delete', null, [
            'module'      => 'master_bidang',
            'description' => "menghapus bidang \"{$nama}\"",
        ]);

        return redirect()->route('admin.master_bidang.index')
            ->with('success', 'Bidang berhasil dihapus.');
    }

    /**
     * Aturan validasi bersama store() & update() — termasuk pengecekan
     * parent (diri sendiri & siklus hierarki) di sisi server.
     *
     * @return array{nama: string, parent_id: ?int}
     */
    private function validatePayload(Request $request, ?Bidang $bidang = null): array
    {
        $validated = $request->validate([
            'nama'      => ['required', 'string', 'max:100'],
            'parent_id' => ['nullable', 'integer', 'exists:bidangs,id'],
        ], [
            'nama.required'      => 'Nama bidang wajib diisi.',
            'nama.max'           => 'Nama bidang maksimal 100 karakter.',
            'parent_id.integer'  => 'Parent bidang tidak valid.',
            'parent_id.exists'   => 'Parent bidang tidak ditemukan — pilih dari daftar bidang yang tersedia.',
        ]);

        // Field nullable yang tidak dikirim bisa tidak ikut masuk $validated.
        $parentId = ! empty($validated['parent_id']) ? (int) $validated['parent_id'] : null;

        if ($bidang !== null && $bidang->createsCycle($parentId)) {
            throw ValidationException::withMessages([
                'parent_id' => $parentId === (int) $bidang->id
                    ? 'Tidak boleh memilih bidang itu sendiri sebagai parent.'
                    : 'Parent tidak valid — pilihan itu adalah keturunan dari bidang ini dan akan membentuk siklus hierarki.',
            ]);
        }

        $validated['parent_id'] = $parentId;

        return $validated;
    }
}
