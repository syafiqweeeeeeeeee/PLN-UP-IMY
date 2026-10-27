<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Admin\TamuController as BaseTamuController;
use App\Models\Tamu;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * TamuController (Portal Karyawan) — konteks akses KARYAWAN untuk
 * buku registrasi pengunjung.
 *
 * SELURUH logic (query + filter + stats + validasi + CRUD + verifikasi +
 * checkout) dipakai ulang dari App\Http\Controllers\Admin\TamuController;
 * subclass ini HANYA mengubah konteks tampilan:
 *
 *   - index  → view karyawan/tamu/index (layout Portal Karyawan)
 *   - redirect setelah aksi → karyawan.tamu.index
 *   - URL unduh dokumen privat → karyawan.tamu.dokumen
 *
 * Authorization TIDAK diubah: tetap dijaga permission tamu.* di
 * routes/web.php + Gate @can pada view (lihat User::hasPermission —
 * direct permission sebagai white-list override atas permission role).
 */
class TamuController extends BaseTamuController
{
    #[\Override]
    protected function indexRouteName(): string
    {
        return 'karyawan.tamu.index';
    }

    #[\Override]
    protected function indexView(): string
    {
        return 'karyawan.tamu.index';
    }

    #[\Override]
    protected function dokumenUrl(Tamu $tamu): ?string
    {
        return $tamu->dokumen_zip_url_karyawan;
    }

    /**
     * Konteks portal karyawan tidak punya halaman detail — aksi status
     * (approve/reject) selalu kembali ke daftar, sesuai kontrak subclass.
     */
    #[\Override]
    protected function aksiStatusRedirect(Request $request, Tamu $tamu): RedirectResponse
    {
        return redirect()->route($this->indexRouteName());
    }
}
