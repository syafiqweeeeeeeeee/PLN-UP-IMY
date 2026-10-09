<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * TamuController — pendaftaran tamu kantor/instansi.
 *
 * create()      : tampilkan form registrasi tamu (publik, tanpa auth).
 * bookedSlots() : API JSON daftar jam kunjungan yang TERBLOKIR untuk
 *                 satu divisi pada satu tanggal (dipakai dropdown jam
 *                 di form untuk menandai slot merah yang tak bisa
 *                 dipilih).
 * store()       : validasi input + upload SATU berkas pendukung
 *                 (multi-format: ZIP/RAR/PDF/JPG/JPEG/PNG — arsip KTP,
 *                 surat permohonan, dsb. disatukan dalam satu berkas,
 *                 maks 10MB), simpan ke disk private, lalu insert ke
 *                 tabel tamus. Validasi juga mencegah double booking
 *                 divisi yang sama pada rentang jam yang sudah
 *                 disetujui admin.
 */
class TamuController extends Controller
{
    public function create()
    {
        return view('layanan.form-registrasi-tamu');
    }

    /**
     * API slot terblokir — GET /api/booked-slots?divisi=...&tanggal=...
     *
     * Kunjungan berstatus "disetujui" untuk divisi yang sama memblokir
     * rentang DURASI_KUNJUNGAN_JAM sejak jam mulainya; response berisi
     * daftar jam slot (HH:MM) yang jatuh di dalam rentang tersebut.
     */
    public function bookedSlots(Request $request): JsonResponse
    {
        $data = $request->validate([
            'divisi'  => ['required', 'string', 'max:150'],
            'tanggal' => ['required', 'date'],
        ]);

        $terblokir = Tamu::jamTerblokir($data['tanggal'], $data['divisi']);

        return response()->json([
            'divisi'        => $data['divisi'],
            'tanggal'       => $data['tanggal'],
            'jam_terblokir' => $terblokir,
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
            // PDF, DOC/DOCX, XLS/XLSX, ZIP, RAR) maksimal 10MB
            'dokumen' => [
                'required',
                'file',
                'mimes:pdf,doc,docx,xls,xlsx,zip,rar',
                'max:10240',
            ],

            'tujuan_ditemui' => ['required', 'string', 'max:150'],
            'jumlah_tamu'    => ['required', 'integer', 'min:1', 'max:100'],

            // Penjadwalan: tanggal & jam dikirim terpisah dari form.
            // Jam harus salah satu slot operasional (sesi pagi/siang),
            // dan tidak boleh jatuh pada rentang yang sudah DISETUJUI
            // untuk divisi yang sama (double booking diblokir server).
            'tanggal_kunjungan' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
            'jam_kunjungan' => [
                'required',
                'date_format:H:i',
                'in:' . implode(',', Tamu::SLOT_JAM),
                function (string $attribute, mixed $value, \Closure $fail) use ($request) {
                    $divisi  = (string) $request->input('tujuan_ditemui');
                    $tanggal = (string) $request->input('tanggal_kunjungan');

                    if ($divisi === '' || $tanggal === '') {
                        return; // biarkan rule required yang menolak
                    }

                    if (Tamu::isJamTerblokir($tanggal, $value, $divisi)) {
                        $fail("Jam {$value} sudah penuh untuk divisi \"{$divisi}\" "
                            . "pada tanggal {$tanggal} (rentang 3 jam sudah di-approve). "
                            . 'Silakan pilih jam lain.');
                    }
                },
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
            'dokumen.mimes'             => 'Berkas harus berformat PDF, DOC, DOCX, XLS, XLSX, ZIP, atau RAR.',
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
            'jumlah_tamu'    => $validated['jumlah_tamu'],
            'tanggal_kunjungan' => $validated['tanggal_kunjungan'] . ' ' . $validated['jam_kunjungan'],
            'keperluan'      => $validated['keperluan'],
        ]);

        return redirect()
            ->route('layanan.registrasi-tamu')
            ->with('success', 'Pendaftaran tamu berhasil! Silakan menuju front office untuk check-in.');
    }
}
