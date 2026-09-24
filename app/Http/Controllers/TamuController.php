<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * TamuController — pendaftaran tamu kantor/instansi.
 *
 * create(): tampilkan form registrasi tamu (publik, tanpa auth).
 * store():  validasi input + upload foto KTP (maks 2MB, jpg/png),
 *           simpan file ke storage/app/public/ktp, lalu insert ke tabel tamus.
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

            // Foto KTP: wajib, gambar jpg/png, maksimal 2MB (2048 kilobyte)
            'foto_ktp' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
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

            // Surat permohonan/undangan resmi dari perusahaan: opsional,
            // namun bila diunggah harus PDF maks 5MB
            'surat_jalan' => [
                'nullable',
                'file',
                'mimes:pdf',
                'max:5120',
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
            'surat_jalan.mimes'    => 'File surat harus berformat PDF.',
            'surat_jalan.max'      => 'Ukuran file surat maksimal :max kilobyte (5MB).',
            'foto_ktp.required'   => 'Foto KTP wajib diunggah.',
            'foto_ktp.image'      => 'File harus berupa gambar.',
            'foto_ktp.mimes'      => 'Foto KTP harus berformat JPG atau PNG.',
            'foto_ktp.max'        => 'Ukuran foto KTP maksimal :max kilobyte (2MB).',
            'tujuan_ditemui.required' => 'Orang / divisi yang ditemui wajib diisi.',
            'jumlah_tamu.required'=> 'Jumlah tamu wajib diisi.',
            'jumlah_tamu.min'     => 'Jumlah tamu minimal 1 orang.',
            'tanggal_kunjungan.required' => 'Tanggal kunjungan wajib diisi.',
            'tanggal_kunjungan.date'     => 'Tanggal kunjungan tidak valid.',
            'tanggal_kunjungan.after_or_equal' => 'Tanggal kunjungan tidak boleh di masa lalu.',
            'keperluan.required'  => 'Maksud & keperluan kunjungan wajib diisi.',
        ]);

        /* =========================================================
           2. SIMPAN FILE KTP & SURAT ke DISK PRIVATE
              (storage/app/private/documents — tidak bisa diakses
              via URL publik /storage; disajikan lewat controller
              ber-auth TamuDocumentController)
              - KTP   -> ktp/   (gambar jpg/png)
              - Surat -> surat/ (PDF, wajib)
           ========================================================= */
        $path      = $request->file('foto_ktp')->store('ktp', 'private');
        $pathSurat = $request->hasFile('surat_jalan')
            ? $request->file('surat_jalan')->store('surat', 'private')
            : null;

        /* =========================================================
           3. INSERT DATA
           ========================================================= */
        Tamu::create([
            'nik'            => $validated['nik'],
            'nama'           => $validated['nama'],
            'instansi'       => $validated['instansi'],
            'no_hp'          => $validated['no_hp'],
            'email'          => $validated['email'],
            'foto_ktp'       => $path,
            'surat_jalan'    => $pathSurat, // null bila tanpa surat
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
