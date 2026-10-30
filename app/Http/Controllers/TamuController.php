<?php

namespace App\Http\Controllers;

use App\Models\HariLibur;
use App\Models\Jabatan;
use App\Models\Tamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * TamuController — pendaftaran tamu kantor/instansi.
 *
 * create()      : tampilkan form registrasi tamu (publik, tanpa auth).
 * store()       : validasi input + upload SATU berkas pendukung
 *                 (multi-format: ZIP/RAR/PDF/JPG/JPEG/PNG — arsip KTP,
 *                 surat permohonan, dsb. disatukan dalam satu berkas,
 *                 maks 10MB), simpan ke disk private, lalu insert ke * tabel tamus. Status tanggal mengikuti master hari_liburs:
 *                 akhir pekan (Sabtu/Minggu) default ditolak, kecuali
 *                 terdaftar sebagai tipe masuk_kerja (override); tanggal
 *                 bertipe libur selalu ditolak.
 */
class TamuController extends Controller
{
    public function create()
    {
        $semuaTanggal = HariLibur::query()->orderBy('tanggal')->get();

        return view('layanan.form-registrasi-tamu', [
            // Tanggal Merah (Y-m-d => keterangan) — tipe libur: diblokir
            // di sisi klien (merah/disabled) + ditolak validasi server.
            'tanggalMerah' => $semuaTanggal
                ->filter(fn (HariLibur $h) => $h->isLibur())
                ->mapWithKeys(fn (HariLibur $h) => [$h->tanggal->format('Y-m-d') => (string) $h->keterangan])
                ->all(),

            // Hari Kerja Khusus (Y-m-d => keterangan) — tipe masuk_kerja:
            // override akhir pekan, tanggal ini DIIZINKAN dipilih pengunjung.
            'tanggalMasuk' => $semuaTanggal
                ->filter(fn (HariLibur $h) => $h->isMasukKerja())
                ->mapWithKeys(fn (HariLibur $h) => [$h->tanggal->format('Y-m-d') => (string) $h->keterangan])
                ->all(),
        ]);
    }

    public function store(Request $request)
    {
        /* =========================================================
           1. VALIDASI
           ========================================================= */
        $validated = $request->validate([
            // NIK: wajib, persis 16 digit angka, unik di tabel tamus
            'nik' => [
                'required',
                'digits:16',
                'unique:tamus,nik',
            ],

            'nama'     => ['required', 'string', 'max:150'],
            'instansi' => ['required', 'string', 'max:150'],
            'no_hp'    => ['required', 'string', 'max:25', 'regex:/^[0-9+\-\s()]+$/'],
            'email'    => ['required', 'email', 'max:150'],

            // Berkas pendukung: WAJIB (multi-format —
            // PDF, DOC/DOCX, XLS/XLSX, ZIP, RAR, JPG/JPEG/PNG) maksimal 10MB
            'dokumen' => [
                'required',
                'file',
                'mimes:pdf,doc,docx,xls,xlsx,zip,rar,jpg,jpeg,png',
                'max:10240',
            ],

            'tujuan_ditemui' => ['required', 'string', 'max:150'],

            // Jabatan orang yang ditemui — WAJIB, dipilih dari master
            // jabatans (dropdown bertingkat mengikuti bidang tujuan).
            // Nilai dikirim sebagai NAMA jabatan; dicocokkan ke master
            // untuk mencegah isian bebas (relasi bidang ⇄ jabatan).
            'jabatan_ditemui' => [
                'required',
                'string',
                'max:150',
                function (string $attribute, mixed $value, \Closure $fail) use ($request) {
                    $divisi = trim((string) $request->input('tujuan_ditemui'));

                    if ($divisi === '') {
                        return; // biarkan rule required tujuan_ditemui yang menolak
                    }

                    $cocok = Jabatan::query()
                        ->where('nama', $value)
                        ->whereHas('bidang', fn ($q) => $q->where('nama', $divisi))
                        ->exists();

                    if (! $cocok) {
                        $fail("Jabatan \"{$value}\" bukan jabatan pada bidang \"{$divisi}\". "
                            . 'Silakan pilih ulang bidang dan jabatan yang ditemui.');
                    }
                },
            ],
            'jumlah_tamu'    => ['required', 'integer', 'min:1', 'max:100'],

            // Nama orang yang ditemui — WAJIB (teks bebas / pilih
            // dari daftar pengguna, pelengkap bidang & jabatan).
            'orang_ditemui' => ['required', 'string', 'max:150'],

            // Penjadwalan: tanggal & jam dikirim terpisah dari form.
            // Jam harus salah satu slot operasional (sesi pagi/siang).
            // Aturan tanggal (SINKRON dgn JS datepicker):
            //   1. Tercatat tipe masuk_kerja → DIIZINKAN (override weekend).
            //   2. Tercatat tipe libur       → ditolak (tanggal merah).
            //   3. Selain itu, Sabtu/Minggu  → ditolak (default hardcode).
            'tanggal_kunjungan' => [
                'required',
                'date',
                'after_or_equal:today',
                function (string $attribute, mixed $value, \Closure $fail) {
                    $tanggal = \Carbon\Carbon::parse((string) $value);
                    $libur = HariLibur::whereDate('tanggal', (string) $value)->first();

                    // 1. Override: akhir pekan yang dijadikan hari kerja khusus.
                    if ($libur !== null && $libur->isMasukKerja()) {
                        return;
                    }

                    // 2. Tanggal merah (tipe libur) — ditolak.
                    if ($libur !== null) {
                        $tgl = $tanggal->format('d F Y');
                        $ket = $libur->keterangan !== '' ? ' — ' . $libur->keterangan : '';
                        $fail("Tanggal {$tgl} adalah hari libur{$ket} dan tidak dapat dipilih untuk kunjungan.");

                        return;
                    }

                    // 3. Akhir pekan tanpa override — hardcode libur.
                    if ($tanggal->isWeekend()) {
                        $fail("Tanggal {$tanggal->translatedFormat('d F Y')} adalah "
                            . $tanggal->translatedFormat('l')
                            . ' (akhir pekan) — kunjungan hanya dapat dijadwalkan pada hari kerja '
                            . '(Sabtu/Minggu dapat dibuka oleh admin lewat tipe "Masuk Kerja").');
                    }
                },
            ],
            'jam_kunjungan' => [
                'required',
                'date_format:H:i',
                'in:' . implode(',', Tamu::SLOT_JAM),
            ],

            'keperluan' => ['required', 'string', 'max:2000'],
        ], [
            'nik.required'              => 'NIK / No. KTP wajib diisi.',
            'nik.digits'                => 'NIK harus tepat :digits digit angka.',
            'nik.unique'                => 'NIK ini sudah terdaftar sebelumnya.',
            'nama.required'             => 'Nama lengkap wajib diisi.',
            'nama.max'                  => 'Nama lengkap maksimal :max karakter.',
            'instansi.required'         => 'Perusahaan / instansi wajib diisi.',
            'no_hp.required'            => 'No. WhatsApp / HP wajib diisi.',
            'no_hp.regex'               => 'Format No. WhatsApp / HP tidak valid.',
            'email.required'            => 'Email wajib diisi.',
            'email.email'               => 'Format email tidak valid.',
            'dokumen.required'          => 'Berkas pendukung wajib diunggah.',
            'dokumen.file'              => 'Berkas yang diunggah tidak valid.',
            'dokumen.mimes'             => 'Berkas harus berformat PDF, DOC, DOCX, XLS, XLSX, ZIP, RAR, JPG, JPEG, atau PNG.',
            'dokumen.max'               => 'Ukuran berkas maksimal :max kilobyte (10MB).',
            'tujuan_ditemui.required'   => 'Orang / divisi yang ditemui wajib diisi.',
            'jumlah_tamu.required'      => 'Jumlah tamu wajib diisi.',
            'jumlah_tamu.min'           => 'Jumlah tamu minimal 1 orang.',
            'tanggal_kunjungan.required' => 'Tanggal kunjungan wajib diisi.',
            'tanggal_kunjungan.date'     => 'Tanggal kunjungan tidak valid.',
            'tanggal_kunjungan.after_or_equal' => 'Tanggal kunjungan tidak boleh di masa lalu.',
            'jam_kunjungan.required'    => 'Jam kunjungan wajib dipilih.',
            'jam_kunjungan.in'          => 'Jam kunjungan harus di luar jam istirahat & sesuai jam operasional.',
            'keperluan.required'        => 'Maksud & keperluan kunjungan wajib diisi.',
            'jabatan_ditemui.required'  => 'Jabatan yang ditemui wajib dipilih.',
            'jabatan_ditemui.max'       => 'Jabatan yang ditemui maksimal :max karakter.',
            'orang_ditemui.required'    => 'Nama orang yang ditemui wajib diisi.',
            'orang_ditemui.max'         => 'Nama orang yang ditemui maksimal :max karakter.',
        ]);

        /* =========================================================
           2. SIMPAN BERKAS PENDUKUNG ke DISK PRIVATE (jika ada)
              (storage/app/private — disajikan lewat controller
              ber-auth TamuDocumentController; kolom DB tetap
              bernama `dokumen_zip` — legacy name)
           ========================================================= */
        $dokumen_zip = null;
        
        // Debug: Cek apakah file dikirim
        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            Log::info('[Dokumen] File diterima:', [
                'name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime' => $file->getMimeType(),
                'extension' => $file->getClientOriginalExtension(),
                'isValid' => $file->isValid(),
            ]);
            
            if ($file->isValid()) {
                $dokumen_zip = $file->store('dokumen', 'private');
                Log::info('[Dokumen] File disimpan:', ['path' => $dokumen_zip]);
            } else {
                Log::error('[Dokumen] File tidak valid');
            }
        } else {
            Log::warning('[Dokumen] Tidak ada file yang dikirim');
        }

        /* =========================================================
           3. INSERT DATA — gabungkan tanggal + jam menjadi datetime
           ========================================================= */
        Tamu::create([
            'nik'            => $validated['nik'],
            'nama'           => $validated['nama'],
            'instansi'       => $validated['instansi'],
            'no_hp'          => $validated['no_hp'],
            'email'          => $validated['email'],
            'dokumen_zip'    => $dokumen_zip,
            'tujuan_ditemui' => $validated['tujuan_ditemui'],
            'jabatan_ditemui' => $validated['jabatan_ditemui'],
            'orang_ditemui'  => $validated['orang_ditemui'],
            'jumlah_tamu'    => $validated['jumlah_tamu'],
            'tanggal_kunjungan' => $validated['tanggal_kunjungan'] . ' ' . $validated['jam_kunjungan'],
            'keperluan'      => $validated['keperluan'],
        ]);

        return redirect()
            ->route('layanan.registrasi-tamu')
            ->with('success', 'Pendaftaran tamu berhasil! Silakan menuju front office untuk check-in.');
    }
}
