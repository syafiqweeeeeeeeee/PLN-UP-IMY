<?php

namespace App\Http\Controllers\Concerns;

use App\Models\Tamu;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * VerifiesTamu — aksi status kunjungan tamu ("approve" / "reject").
 *
 * ATURAN BISNIS (REVISI STATUS): status BISA diubah berulang kali.
 * "Menunggu", "Disetujui" dan "Dibatalkan" saling bertukar bebas — dari
 * tombol tabel maupun endpoint approve/reject. Setiap aksi selalu
 * memperbarui:
 *   - status_verifikasi  -> STATUS_DISETUJUI / STATUS_DITOLAK
 *   - verified_by        -> auth()->id() (pihak terakhir yang berubah)
 *   - verified_at        -> now()
 * sehingga kartu log di MODAL DETAIL selalu menampilkan SIAPA dan
 * KAPAN perubahan terakhir dilakukan.
 *
 * Semua aksi SELALU kembali ke halaman daftar (halaman detail sudah
 * dihapus — seluruh isi detail tersedia di modal pop-up).
 *
 * Pengecualian yang TETAP berlaku:
 *   - Authorization: konteks boleh membatasi lewat bolehVerifikasi()
 *     (portal karyawan: hanya tamu yang menunjuk akun ini).
 *
 * Dipakai oleh:
 *   - App\Http\Controllers\Admin\TamuController (panel Admin)
 *   - App\Http\Controllers\Karyawan\TamuController (portal Data Tamu)
 *   - App\Http\Controllers\Karyawan\PortalController (halaman Kunjungan Tamu)
 */
trait VerifiesTamu
{
    /** Nama route tujuan redirect setelah aksi dari tabel (per konteks halaman). */
    abstract protected function verifikasiRedirectRoute(): string;

    /**
     * Izin aksi verifikasi untuk konteks ini.
     * Default: semua (panel admin sudah dijaga permission route).
     */
    protected function bolehVerifikasi(Request $request, Tamu $tamu): bool
    {
        return true;
    }

    /**
     * Redirect tujuan setelah aksi status: SELALU halaman daftar
     * (halaman detail sudah dihapus — modal jadi satu-satunya tampilan
     * detail, diisi dari payload halaman daftar).
     */
    protected function aksiStatusRedirect(Request $request, Tamu $tamu): RedirectResponse
    {
        return redirect()->route($this->verifikasiRedirectRoute());
    }

    /** Setujui kunjungan — boleh dari status apa pun (approve/revisi). */
    public function approve(Request $request, Tamu $tamu): RedirectResponse
    {
        return $this->prosesKeputusan($request, $tamu, true);
    }

    /** Batalkan kunjungan — boleh dari status apa pun (reject/revisi). */
    public function reject(Request $request, Tamu $tamu): RedirectResponse
    {
        return $this->prosesKeputusan($request, $tamu, false);
    }

    /**
     * Aksi verifikasi dari tabel (parameter keputusan: setuju / tolak).
     * Dulu dibatasi hanya saat status "menunggu"; kini status boleh
     * direvisi berulang sesuai kebutuhan.
     */
    public function verifikasi(Request $request, Tamu $tamu): RedirectResponse
    {
        $validated = $request->validate([
            'keputusan' => ['required', 'in:setuju,tolak'],
        ], [
            'keputusan.required' => 'Pilih keputusan verifikasi terlebih dahulu.',
            'keputusan.in'       => 'Keputusan verifikasi tidak valid.',
        ]);

        return $this->prosesKeputusan($request, $tamu, $validated['keputusan'] === 'setuju');
    }

    /**
     * Terapkan keputusan status: "Disetujui" atau "Dibatalkan".
     *
     * @param  bool  $setuju  true = Disetujui, false = Dibatalkan
     */
    protected function prosesKeputusan(
        Request $request,
        Tamu $tamu,
        bool $setuju
    ): RedirectResponse {
        if (! $this->bolehVerifikasi($request, $tamu)) {
            return $this->aksiStatusRedirect($request, $tamu)
                ->with('error', 'Anda tidak berwenang memverifikasi kunjungan ini.');
        }

        $statusSebelumnya = $tamu->status_verifikasi;
        $revisi = $statusSebelumnya !== Tamu::STATUS_MENUNGGU;

        /* =====================================================
           STATUS DIPERBARUI — status + SIAPA (verified_by) +
           KAPAN (verified_at). Berlaku meski status sebelumnya
           sudah "Disetujui" / "Dibatalkan" (revisi/override).
           ===================================================== */
        $tamu->update([
            'status_verifikasi' => $setuju ? Tamu::STATUS_DISETUJUI : Tamu::STATUS_DITOLAK,
            'verified_at'       => now(),
            'verified_by'       => $request->user()?->id ?? auth()->id(),
        ]);

        $statusLabel = $setuju ? 'disetujui' : 'dibatalkan';

        ActivityLogger::log($setuju ? 'approve' : 'reject', null, [
            'module' => 'tamu',
            'description' => ($revisi ? 'merevisi status' : ($setuju ? 'menyetujui' : 'menolak') . ' pendaftaran')
                . " tamu \"{$tamu->nama}\" (NIK {$tamu->nik}) menjadi {$statusLabel}",
            'subject' => $tamu,
        ]);

        $redirect = $this->aksiStatusRedirect($request, $tamu)
            ->with('success', "Status kunjungan tamu \"{$tamu->nama}\" menjadi {$statusLabel}.");

        // Pop-up "kirim konfirmasi WA" di halaman daftar (modal detail
        // tidak punya halaman sendiri lagi, sehingga SEMUA aksi memakai
        // pop-up yang sama).
        $redirect = $redirect->with('wa_konfirmasi', [
            'nama'   => $tamu->nama,
            'no_wa'  => $tamu->wa_number,
            'status' => $statusLabel,
            'wa_url' => $setuju ? $tamu->wa_approve_url : $tamu->wa_reject_url,
        ]);

        return $redirect;
    }
}
