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
 * "Menunggu", "Disetujui" dan "Dibatalkan" saling bertukar bebas — baik
 * dari halaman detail (approve/reject) maupun tombol di tabel. Setiap
 * aksi selalu memperbarui:
 *   - status_verifikasi  -> STATUS_DISETUJUI / STATUS_DITOLAK
 *   - verified_by        -> auth()->id() (pihak terakhir yang berubah)
 *   - verified_at        -> now()
 * sehingga kartu log di halaman detail selalu menampilkan SIAPA dan
 * KAPAN perubahan terakhir dilakukan.
 *
 * Pengecualian yang TETAP berlaku:
 *   - Authorization: konteks boleh membatasi lewat bolehVerifikasi()
 *     (portal karyawan: hanya tamu yang menunjuk akun ini).
 *   - Approve tetap diblokir bila jadwal sudah terisi kunjungan lain
 *     (satu slot = satu kunjungan per divisi).
 *
 * Dipakai oleh:
 *   - App\Http\Controllers\Admin\AdminTamu... (panel Admin)
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
     * Redirect tujuan aksi status dari HALAMAN DETAIL.
     * Default: kembali ke daftar. Admin meng-override agar kembali ke
     * halaman detail tamu yang sedang dibuka.
     */
    protected function aksiStatusRedirect(Request $request, Tamu $tamu): RedirectResponse
    {
        return redirect()->route($this->verifikasiRedirectRoute());
    }

    /** Setujui kunjungan — boleh dari status apa pun (approve/revisi). */
    public function approve(Request $request, Tamu $tamu): RedirectResponse
    {
        return $this->prosesKeputusan($request, $tamu, true, true);
    }

    /** Batalkan kunjungan — boleh dari status apa pun (reject/revisi). */
    public function reject(Request $request, Tamu $tamu): RedirectResponse
    {
        return $this->prosesKeputusan($request, $tamu, false, true);
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
     * @param  bool  $setuju           true = Disetujui, false = Dibatalkan
     * @param  bool  $dariHalamanDetail  true = dipanggil approve()/reject()
     *                                   dari halaman detail (redirect ke detail)
     */
    protected function prosesKeputusan(
        Request $request,
        Tamu $tamu,
        bool $setuju,
        bool $dariHalamanDetail = false
    ): RedirectResponse {
        if (! $this->bolehVerifikasi($request, $tamu)) {
            return $this->redirectAksi($request, $tamu, $dariHalamanDetail)
                ->with('error', 'Anda tidak berwenang memverifikasi kunjungan ini.');
        }

        $statusSebelumnya = $tamu->status_verifikasi;
        $revisi = $statusSebelumnya !== Tamu::STATUS_MENUNGGU;

        /* =====================================================
           CEK BLOKIR SLOT — satu jadwal per divisi hanya boleh
           SATU kunjungan yang diizinkan. Berlaku untuk approve
           pertama MAUPUN revisi dari "Dibatalkan" -> "Disetujui".
           ===================================================== */
        if ($setuju) {
            $tanggal = $tamu->tanggal_kunjungan?->format('Y-m-d');
            $jam     = $tamu->tanggal_kunjungan?->format('H:i');

            $bentrok = ($tanggal && $jam)
                ? Tamu::kunjunganBentrok($tanggal, $jam, $tamu->tujuan_ditemui, $tamu->id)
                : null;

            if ($bentrok) {
                ActivityLogger::log('approve', null, [
                    'module' => 'tamu',
                    'description' => "approve kunjungan tamu \"{$tamu->nama}\" (NIK {$tamu->nik}) "
                        . "DIBLOKIR — jadwal bentrok dengan kunjungan \"{$bentrok->nama}\" "
                        . "(id {$bentrok->id}) yang sudah diizinkan",
                    'subject' => $tamu,
                ]);

                return $this->redirectAksi($request, $tamu, $dariHalamanDetail)
                    ->with('wa_konfirmasi', [
                        'nama'   => $tamu->nama,
                        'no_wa'  => $tamu->wa_number,
                        // "bentrok" -> popup peringatan, bukan konfirmasi approve
                        'status' => 'bentrok',
                        'wa_url' => $tamu->wa_bentrok_url,
                        'bentrok' => true,
                        'bentrok_dengan' => $bentrok->nama,
                        'bentrok_jadwal' => $bentrok->tanggal_kunjungan?->translatedFormat('d M Y, H:i'),
                    ])
                    ->with('error', "Approve ditolak: jadwal kunjungan \"{$tamu->nama}\" ("
                        . $tamu->tanggal_kunjungan?->translatedFormat('d M Y, H:i')
                        . ") sudah ada yang diizinkan untuk \"{$tamu->tujuan_ditemui}\".");
            }
        }

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

        $redirect = $this->redirectAksi($request, $tamu, $dariHalamanDetail)
            ->with('success', "Status kunjungan tamu \"{$tamu->nama}\" menjadi {$statusLabel}.");

        // Pop-up "kirim konfirmasi WA" di halaman daftar (bukan di detail).
        if (! $dariHalamanDetail) {
            $redirect = $redirect->with('wa_konfirmasi', [
                'nama'   => $tamu->nama,
                'no_wa'  => $tamu->wa_number,
                'status' => $statusLabel,
                'wa_url' => $setuju ? $tamu->wa_approve_url : $tamu->wa_reject_url,
            ]);
        }

        return $redirect;
    }

    /** Redirect dasar: daftar (tabel) atau halaman detail. */
    protected function redirectAksi(Request $request, Tamu $tamu, bool $dariHalamanDetail): RedirectResponse
    {
        return $dariHalamanDetail
            ? $this->aksiStatusRedirect($request, $tamu)
            : redirect()->route($this->verifikasiRedirectRoute());
    }
}
