<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HariLibur;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

/**
 * HariLiburController — manajemen status tanggal (2 tipe):
 *
 *   libur       : Tanggal Merah — diblokir di form registrasi publik.
 *   masuk_kerja : Hari Kerja Khusus — override Sabtu/Minggu agar bisa
 *                 dipilih pengunjung.
 *
 * index()   : daftar tanggal (paginasi) + statistik.
 * store()   : tambah tanggal (tanggal wajib unik & tidak lampau).
 * update()  : ubah tanggal / tipe / keterangan satu baris.
 * destroy() : hapus satu baris.
 *
 * Otorisasi: permission khusus `hari_libur.*` (ID Menu 13, ikut
 * matriks hak akses Tambah/Edit Role & terdaftar di PermissionSeeder).
 * FALLBACK alias ke `tamu.*` (Permission::ACTION_ALIASES) menjaga role
 * lama yang sudah punya akses Data Tamu tetap bisa mengelola modul ini
 * tanpa re-scope.
 */
class HariLiburController extends Controller
{
    public function index(): View
    {
        $tanggalLibur = HariLibur::query()
            ->orderBy('tanggal')
            ->paginate(15)
            ->withQueryString();

        return view('admin.hari-libur.index', [
            'tanggalLibur' => $tanggalLibur,
            'total'        => $tanggalLibur->total(),
            'mendatang'    => HariLibur::whereDate('tanggal', '>=', today())->count(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tanggal'    => ['required', 'date', 'unique:hari_liburs,tanggal', 'after_or_equal:today'],
            'tipe'       => ['required', 'in:' . implode(',', HariLibur::TIPE_LIST)],
            'keterangan' => ['required', 'string', 'max:150'],
        ], [
            'tanggal.required'          => 'Tanggal wajib diisi.',
            'tanggal.date'              => 'Tanggal tidak valid.',
            'tanggal.unique'            => 'Tanggal tersebut sudah terdaftar.',
            'tanggal.after_or_equal'    => 'Tanggal tidak boleh di masa lalu.',
            'tipe.required'             => 'Tipe status tanggal wajib dipilih.',
            'tipe.in'                   => 'Tipe status tanggal tidak valid.',
            'keterangan.required'       => 'Keterangan wajib diisi.',
            'keterangan.max'            => 'Keterangan maksimal :max karakter.',
        ]);

        $libur = HariLibur::create($validated);

        ActivityLogger::log('create', null, [
            'module'      => 'tamu',
            'description' => 'menambahkan tanggal "'
                . $libur->tanggal->format('d M Y') . '" (' . $libur->keterangan . ')',
        ]);

        return redirect()->route('admin.hari-libur.index')
            ->with('success', $libur->isMasukKerja()
                ? 'Hari kerja khusus berhasil ditambahkan — tanggal akhir pekan ini kini bisa dipilih pengunjung.'
                : 'Tanggal merah berhasil ditambahkan.');
    }

    public function update(Request $request, HariLibur $hariLibur): RedirectResponse
    {
        $validated = $request->validate([
            'tanggal'    => ['required', 'date', 'unique:hari_liburs,tanggal,' . $hariLibur->id],
            'tipe'       => ['required', 'in:' . implode(',', HariLibur::TIPE_LIST)],
            'keterangan' => ['required', 'string', 'max:150'],
        ], [
            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date'     => 'Tanggal tidak valid.',
            'tanggal.unique'   => 'Tanggal tersebut sudah terdaftar.',
            'tipe.required'    => 'Tipe status tanggal wajib dipilih.',
            'tipe.in'          => 'Tipe status tanggal tidak valid.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'keterangan.max'    => 'Keterangan maksimal :max karakter.',
        ]);

        $hariLibur->update($validated);

        ActivityLogger::log('update', null, [
            'module'      => 'tamu',
            'description' => 'mengubah tanggal "'
                . $validated['tanggal'] . '" menjadi (' . $validated['keterangan'] . ')',
        ]);

        return redirect()->route('admin.hari-libur.index')
            ->with('success', 'Status tanggal berhasil diperbarui.');
    }

    public function destroy(HariLibur $hariLibur): RedirectResponse
    {
        $tanggal = $hariLibur->tanggal->format('d M Y');
        $hariLibur->delete();

        ActivityLogger::log('delete', null, [
            'module'      => 'tamu',
            'description' => "menghapus hari libur \"{$tanggal}\"",
        ]);

        return redirect()->route('admin.hari-libur.index')
            ->with('success', "Tanggal \"{$tanggal}\" berhasil dihapus.");
    }
}
