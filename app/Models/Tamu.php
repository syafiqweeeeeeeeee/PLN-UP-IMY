<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * Tamu — buku registrasi pengunjung kantor/instansi.
 *
 * Kolom status: checked_in_at / checked_out_at (null = belum).
 * Helper isCheckedin() & durasiKunjungan() memudahkan front office.
 *
 * Alur verifikasi admin: status_verifikasi "menunggu" -> "disetujui"
 * / "ditolak" (keputusan tercatat di verified_at / verified_by).
 *
 * PENJADWALAN (slot locking): tiap kunjungan yang DISETUJUI memblokir
 * rentang DURASI_KUNJUNGAN_JAM sejak jam mulai untuk tujuan_ditemui
 * yang sama. Pengajuan divisi berbeda pada jam yang sama TETAP BOLEH.
 */
class Tamu extends Model
{
    protected $table = 'tamus';

    /** Status verifikasi kunjungan. */
    public const STATUS_MENUNGGU = 'menunggu';
    public const STATUS_DISETUJUI = 'disetujui';
    public const STATUS_DITOLAK   = 'ditolak';

    /** Durasi kunjungan standar (jam) — rentang waktu yang diblokir tiap pengajuan. */
    public const DURASI_KUNJUNGAN_JAM = 3;

    /**
     * Pilihan jam mulai kunjungan (dropdown form).
     * Sesi pagi 08:00–11:30 & sesi siang 13:00–16:00;
     * jam 12:00–13:00 adalah istirahat (tidak ada slot).
     */
    public const SLOT_JAM = ['08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00'];

    protected $fillable = [
        'nik',
        'nama',
        'instansi',
        'no_hp',
        'email',
        'dokumen_zip',
        'tujuan_ditemui',
        'jumlah_tamu',
        'tanggal_kunjungan',
        'keperluan',
        'checked_in_at',
        'checked_out_at',
        'status_verifikasi',
        'verified_at',
        'verified_by',
    ];

    protected $casts = [
        'jumlah_tamu'       => 'integer',
        'tanggal_kunjungan' => 'datetime',
        'checked_in_at'     => 'datetime',
        'checked_out_at'    => 'datetime',
        'verified_at'       => 'datetime',
    ];

    /**
     * Label status verifikasi dalam bahasa Indonesia (untuk badge UI).
     */
    public function getVerifikasiLabelAttribute(): string
    {
        return match ($this->status_verifikasi) {
            self::STATUS_DISETUJUI => 'Disetujui',
            self::STATUS_DITOLAK   => 'Ditolak',
            default                => 'Menunggu',
        };
    }

    /**
     * Apakah tamu memiliki lampiran dokumen (ZIP).
     */
    public function hasDokumen(): bool
    {
        return ! empty($this->dokumen_zip);
    }

    /**
     * URL unduh dokumen ZIP — disajikan lewat route PRIVAT
     * (admin.tamu.dokumen) yang meng-stream file dari disk private.
     *
     * Route berada di grup middleware auth + permission:tamu.view,
     * sehingga dokumen tidak bisa diakses publik via /storage.
     */
    public function getDokumenZipUrlAttribute(): ?string
    {
        if (! $this->dokumen_zip) {
            return null;
        }

        return route('admin.tamu.dokumen', $this);
    }

    /**
     * Nomor HP dalam format internasional (awalan 08 -> 62)
     * untuk link click-to-chat WhatsApp.
     */
    public function getWaNumberAttribute(): string
    {
        $digits = preg_replace('/\D/', '', (string) $this->no_hp);

        // 0xxxxxxxxxx  -> 62xxxxxxxxxx
        // 8xxxxxxxxxx  -> 62xxxxxxxxxx (user lupa mengetik 0)
        // 62xxxxxxxxxx -> sudah benar
        if (str_starts_with($digits, '0')) {
            $digits = '62' . substr($digits, 1);
        } elseif (str_starts_with($digits, '8')) {
            $digits = '62' . $digits;
        }

        return $digits;
    }

    /**
     * URL click-to-chat WhatsApp dengan template pesan konfirmasi
     * kunjungan yang sudah terisi nama tamu.
     */
    public function getWaChatUrlAttribute(): string
    {
        $message = "Halo Bpk/Ibu {$this->nama}, terkait pendaftaran kunjungan "
            . "Anda di PT PLN Nusantara Power UP PLTU Indramayu, "
            . "kami ingin mengonfirmasi jadwal kunjungan Anda. Terima kasih.";

        return 'https://wa.me/' . $this->wa_number . '?text=' . rawurlencode($message);
    }

    /**
     * Pesan WA konfirmasi kunjungan DIIZINKAN (disetujui admin).
     * Menyertakan jadwal kunjungan yang disetujui.
     */
    public function getPesanWaDisetujuiAttribute(): string
    {
        return "Halo Bpk/Ibu {$this->nama}, pendaftaran kunjungan Anda di "
            . "PT PLN Nusantara Power UP PLTU Indramayu telah DIIZINKAN.\n\n"
            . "Jadwal kunjungan: {$this->tanggal_kunjungan?->translatedFormat('d F Y, H:i')} WIB\n"
            . "Yang akan ditemui: {$this->tujuan_ditemui}\n"
            . "Jumlah tamu: {$this->jumlah_tamu} orang\n\n"
            . "Silakan tunjukkan pesan ini dan membawa identitas diri (KTP) "
            . "saat tiba di front office. Terima kasih.";
    }

    /**
     * Pesan WA konfirmasi kunjungan DITOLAK (ditolak admin).
     */
    public function getPesanWaDitolakAttribute(): string
    {
        return "Halo Bpk/Ibu {$this->nama}, mohon maaf pendaftaran kunjungan Anda di "
            . "PT PLN Nusantara Power UP PLTU Indramayu pada "
            . "{$this->tanggal_kunjungan?->translatedFormat('d F Y, H:i')} WIB "
            . "belum dapat kami izinkan.\n\n"
            . "Silakan hubungi petugas atau lakukan pendaftaran ulang di waktu lain. "
            . "Terima kasih atas pengertiannya.";
    }

    /**
     * URL wa.me dengan pesan DIIZINKAN — dibuka saat admin menyetujui.
     */
    public function getWaApproveUrlAttribute(): string
    {
        return 'https://wa.me/' . $this->wa_number . '?text=' . rawurlencode($this->pesan_wa_disetujui);
    }

    /**
     * URL wa.me dengan pesan DITOLAK — dibuka saat admin menolak.
     */
    public function getWaRejectUrlAttribute(): string
    {
        return 'https://wa.me/' . $this->wa_number . '?text=' . rawurlencode($this->pesan_wa_ditolak);
    }

    /**
     * Link mailto dengan subjek email otomatis (konfirmasi kunjungan).
     * Null bila tamu tidak mengisi email.
     */
    public function getMailtoUrlAttribute(): ?string
    {
        if (! $this->email) {
            return null;
        }

        $subject = 'Konfirmasi Kunjungan Tamu - PLN Nusantara Power';

        return 'mailto:' . $this->email . '?subject=' . rawurlencode($subject);
    }

    /**
     * Apakah tamu sudah check-in (dan belum check-out).
     */
    public function isCheckedIn(): bool
    {
        return $this->checked_in_at !== null && $this->checked_out_at === null;
    }

    /**
     * Durasi kunjungan dalam menit (null bila belum check-out).
     */
    public function durasiKunjungan(): ?int
    {
        if ($this->checked_in_at === null || $this->checked_out_at === null) {
            return null;
        }

        return (int) round($this->checked_in_at->diffInMinutes($this->checked_out_at));
    }

    /* =========================================================
       QUERY SCOPES (filter halaman admin)
       ========================================================= */

    /**
     * Cari berdasarkan nama, instansi, atau NIK (contains).
     */
    public function scopeSearch($query, ?string $term)
    {
        $term = trim((string) $term);

        if ($term === '') {
            return $query;
        }

        return $query->where(function ($q) use ($term) {
            $q->where('nama', 'like', "%{$term}%")
              ->orWhere('instansi', 'like', "%{$term}%")
              ->orWhere('nik', 'like', "%{$term}%");
        });
    }

    /**
     * Filter rentang tanggal kunjungan (inklusif).
     */
    public function scopeTanggalAntara($query, ?string $dari, ?string $sampai)
    {
        if ($dari) {
            $query->whereDate('tanggal_kunjungan', '>=', $dari);
        }

        if ($sampai) {
            $query->whereDate('tanggal_kunjungan', '<=', $sampai);
        }

        return $query;
    }

    /**
     * Filter status gabungan untuk dropdown admin:
     * - "menunggu" / "disetujui" / "ditolak" → status verifikasi
     * - "berkunjung" (belum check-out) / "selesai" (sudah check-out)
     *   → hanya di antara tamu yang sudah disetujui.
     */
    public function scopeStatus($query, ?string $status)
    {
        return match ($status) {
            self::STATUS_MENUNGGU  => $query->where('status_verifikasi', self::STATUS_MENUNGGU),
            self::STATUS_DISETUJUI => $query->where('status_verifikasi', self::STATUS_DISETUJUI),
            self::STATUS_DITOLAK   => $query->where('status_verifikasi', self::STATUS_DITOLAK),
            'berkunjung' => $query->where('status_verifikasi', self::STATUS_DISETUJUI)->whereNull('checked_out_at'),
            'selesai'    => $query->where('status_verifikasi', self::STATUS_DISETUJUI)->whereNotNull('checked_out_at'),
            default      => $query,
        };
    }

    /* =========================================================
       SLOT LOCKING — pemblokiran jam kunjungan per divisi
       ========================================================= */

    /**
     * Jam-jam slot yang TERBLOKIR untuk satu divisi pada satu tanggal.
     *
     * Setiap kunjungan berstatus "disetujui" memblokir rentang
     * DURASI_KUNJUNGAN_JAM sejak jam mulainya (mis. 09:00 -> 09:00–12:00),
     * sehingga slot yang jatuh DI DALAM rentang itu (09:00, 10:00, 11:00)
     * tidak dapat dipilih untuk divisi yang sama. Divisi berbeda tidak
     * terpengaruh.
     *
     * @param  string  $tanggal  Format Y-m-d
     * @param  string  $divisi   Nilai kolom tujuan_ditemui
     * @param  int|null $kecualiId  ID kunjungan yang dikecualikan (dipakai
     *                              saat edit, agar tidak memblokir dirinya sendiri)
     * @param  int|null $durasiJam   Rentang blokir dalam jam (default
     *                              DURASI_KUNJUNGAN_JAM). Dikirim 1 oleh
     *                              modal edit admin — hanya jam booking
     *                              itu sendiri yang ditandai merah.
     * @return array<int, string> Daftar jam (HH:MM) terblokir, terurut
     */
    public static function jamTerblokir(string $tanggal, string $divisi, ?int $kecualiId = null, ?int $durasiJam = null): array
    {
        $query = self::query()
            ->where('status_verifikasi', self::STATUS_DISETUJUI)
            ->where('tujuan_ditemui', $divisi)
            ->whereDate('tanggal_kunjungan', $tanggal);

        if ($kecualiId !== null) {
            $query->where('id', '!=', $kecualiId);
        }

        $disetujui = $query->pluck('tanggal_kunjungan');

        $durasi = $durasiJam ?? self::DURASI_KUNJUNGAN_JAM;

        $terblokir = [];

        foreach ($disetujui as $mulai) {
            $akhir = $mulai->copy()->addHours($durasi);

            foreach (self::SLOT_JAM as $jam) {
                $slot = \Carbon\Carbon::parse("{$tanggal} {$jam}");

                if ($slot->greaterThanOrEqualTo($mulai) && $slot->lessThan($akhir)) {
                    $terblokir[] = $jam;
                }
            }
        }

        return array_values(array_unique($terblokir));
    }

    /**
     * Apakah jam mulai tertentu terblokir untuk divisi & tanggal ini?
     * Dipakai validasi store() agar double booking divisi yang sama
     * tidak lolos meski dilewati dari sisi frontend.
     *
     * @param  int|null $durasiJam  Rentang blokir (jam) — 1 untuk jalur
     *                              edit admin, null untuk aturan normal.
     */
    public static function isJamTerblokir(string $tanggal, string $jam, string $divisi, ?int $kecualiId = null, ?int $durasiJam = null): bool
    {
        return in_array($jam, self::jamTerblokir($tanggal, $divisi, $kecualiId, $durasiJam), true);
    }
}
