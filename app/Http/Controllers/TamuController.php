<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;

/**
 * TamuController — pendaftaran tamu kantor/instansi.
 *
 * create(): tampilkan form registrasi tamu (publik, tanpa auth).
 * store():  validasi input + upload SATU berkas pendukung
 *           (multi-format: ZIP/RAR/PDF/JPG/JPEG/PNG — arsip KTP,
 *           surat permohonan, dsb. disatukan dalam satu berkas,
 *           maks 10MB), simpan ke disk private, lalu insert ke tabel tamus.
 */
class TamuController extends Controller
{
    public function create()
    {
        return view('layanan.form-registrasi-tamu');
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

            'nama'           => ['required', 'string', 'max:150'],
            // Wajib: identitas perusahaan/instansi asal tamu
            'instansi'       => ['required', 'string', 'max:150'],
            'no_hp'          => ['required', 'string', 'max:25', 'regex:/^[0-9+\-\s()]+$/'],
            // Wajib: untuk konfirmasi & komunikasi kunjungan
            'email'          => ['required', 'email', 'max:150'],

            // Berkas pendukung: SATU file wajib (multi-format —
            // ZIP/RAR/PDF/JPG/JPEG/PNG; arsip KTP, surat permohonan,
            // dsb. disatukan oleh tamu) maksimal 10MB
            'dokumen' => [
                'required',
                'file',
                'mimes:zip,rar,pdf,jpg,jpeg,png',
                'max:10240',
            ],

            'tujuan_ditemui' => ['required', 'string', 'max:150'],
            'jumlah_tamu'    => ['required', 'integer', 'min:1', 'max:100'],

            // Tanggal & jam kunjungan: wajib, harus tanggal valid,
            // tidak boleh di masa lalu (paling cepat hari ini jam 00:00).
            'tanggal_kunjungan' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'keperluan'      => ['required', 'string', 'max:2000'],
        ], [
            'nik.required'        => 'NIK / No. KTP wajib diisi.',
            'nik.digits'          => 'NIK harus tepat :digits digit angka.',
            'nik.unique'          => 'NIK ini sudah terdaftar sebelumnya.',
            'nama.required'       => 'Nama lengkap wajib diisi.',
            'nama.max'            => 'Nama lengkap maksimal :max karakter.',
            'instansi.required'   => 'Perusahaan / instansi wajib diisi.',
            'no_hp.required'      => 'No. WhatsApp / HP wajib diisi.',
            'no_hp.regex'         => 'Format No. WhatsApp / HP tidak valid.',
            'email.required'      => 'Email wajib diisi.',
            'email.email'         => 'Format email tidak valid.',
            'dokumen.required' => 'Berkas pendukung wajib diunggah.',
            'dokumen.file'     => 'Berkas pendukung tidak valid.',
            'dokumen.mimes'    => 'Berkas harus berformat ZIP, RAR, PDF, JPG, JPEG, atau PNG.',
            'dokumen.max'      => 'Ukuran berkas maksimal :max kilobyte (10MB).',
            'tujuan_ditemui.required' => 'Orang / divisi yang ditemui wajib diisi.',
            'jumlah_tamu.required'=> 'Jumlah tamu wajib diisi.',
            'jumlah_tamu.min'     => 'Jumlah tamu minimal 1 orang.',
            'tanggal_kunjungan.required' => 'Tanggal kunjungan wajib diisi.',
            'tanggal_kunjungan.date'     => 'Tanggal kunjungan tidak valid.',
            'tanggal_kunjungan.after_or_equal' => 'Tanggal kunjungan tidak boleh di masa lalu.',
            'keperluan.required'  => 'Maksud & keperluan kunjungan wajib diisi.',
        ]);

        /* =========================================================
           2. SIMPAN BERKAS PENDUKUNG ke DISK PRIVATE
              (storage/app/private — tidak bisa diakses via URL
              publik /storage; disajikan lewat controller ber-auth
              TamuDocumentController)
              - input `dokumen` -> disimpan di folder dokumen/;
                kolom DB tetap bernama `dokumen_zip` (legacy name)
           ========================================================= */
        $validated['dokumen_zip'] = $request->file('dokumen')->store('dokumen', 'private');

        /* =========================================================
           3. INSERT DATA
           ========================================================= */
        Tamu::create([
            'nik'            => $validated['nik'],
            'nama'           => $validated['nama'],
            'instansi'       => $validated['instansi'],
            'no_hp'          => $validated['no_hp'],
            'email'          => $validated['email'],
            'dokumen_zip'    => $validated['dokumen_zip'],
            'tujuan_ditemui' => $validated['tujuan_ditemui'],
            'jumlah_tamu'    => $validated['jumlah_tamu'],
            'tanggal_kunjungan' => $validated['tanggal_kunjungan'],
            'keperluan'      => $validated['keperluan'],
        ]);

        return redirect()
            ->route('layanan.registrasi-tamu')
            ->with('success', 'Pendaftaran tamu berhasil! Silakan menuju front office untuk check-in.');
    }
}
