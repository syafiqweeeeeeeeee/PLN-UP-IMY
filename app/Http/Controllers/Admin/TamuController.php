<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tamu;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * TamuController (Admin) — manajemen buku registrasi pengunjung.
 *
 * index()    : daftar tamu + filter (search, rentang tanggal kunjungan,
 *              status kunjungan) + stats widget.
 * store()    : tambah tamu manual oleh admin (dokumen pendukung opsional).
 * update()   : perubahan data tamu via modal edit (dokumen opsional).
 * verifikasi(): setujui / tolak pendaftaran kunjungan tamu. Setelahnya
 *              admin diarahkan ke WhatsApp tamu (wa.me click-to-chat)
 *              dengan pesan konfirmasi yang sudah terisi otomatis.
 * checkout() : tandai tamu selesai berkunjung (isi checked_out_at).
 * destroy()  : hapus data tamu beserta file dokumennya.
 * export()   : unduh CSV sesuai filter yang sedang aktif.
 * print()    : halaman cetak di bawah tabel (dua gaya: "excel" = look
 *              spreadsheet; "pdf" = laporan formal) via dialog print
 *              browser — mengikuti filter aktif, mengabaikan pagination.
 */
class TamuController extends Controller
{
    public function index(Request $request)
    {
        $query = Tamu::query()
            ->search($request->string('q')->toString())
            ->tanggalAntara($request->input('dari'), $request->input('sampai'))
            ->status($request->string('status')->toString())
            ->latest()
            ->orderByDesc('id');

        $stats = [
            'hari_ini'   => (clone $query)->whereDate('created_at', today())->count(),
            'aktif'      => (clone $query)->whereNull('checked_out_at')->count(),
            'bulan_ini'  => (clone $query)->whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count(),
        ];        $tamus = $query->paginate(15)->withQueryString();

        // Payload ringkas untuk modal detail di sisi klien (per halaman).
        $tamuData = collect($tamus->items())->map(fn (Tamu $t) => [
            'id'        => $t->id,
            'nama'      => $t->nama,
            'nik'       => $t->nik,
            'no_hp'     => $t->no_hp,
            'wa'        => $t->wa_number, // format internasional 62...
            'email'     => $t->email,
            'instansi'  => $t->instansi,
            'tujuan'    => $t->tujuan_ditemui,
            'keperluan' => $t->keperluan,
            'jumlah'    => $t->jumlah_tamu,
            'tanggal'   => $t->tanggal_kunjungan?->format('d M Y, H:i'),
            'daftar'    => $t->created_at->format('d M Y, H:i'),
            'checkin'   => $t->checked_in_at?->format('d M Y, H:i'),
            'checkout'  => $t->checked_out_at?->format('d M Y, H:i'),
            'status'    => $t->verifikasi_label === 'Disetujui'
                ? ($t->checked_out_at ? 'Selesai' : 'Berkunjung')
                : $t->verifikasi_label,
            'verifikasi' => $t->status_verifikasi,
            // Nilai mentah utk <input type="datetime-local"> pada modal edit
            'tanggal_input' => $t->tanggal_kunjungan?->format('Y-m-d\\TH:i'),
            // URL unduh dokumen ZIP (null bila tanpa lampiran)
            'dokumen'   => $t->dokumen_zip_url,
            // Untuk kompatibilitas dengan modal edit (JS mengakses model Carbon)
            'tanggal_kunjungan' => $t->tanggal_kunjungan,
        ])->keyBy('id');

        // Data lengkap untuk JavaScript (sudah diformat, aman untuk @json)
        $tamuFullDataForJs = collect($tamus->items())->map(fn (Tamu $t) => [
            'id' => $t->id,
            'nik' => $t->nik,
            'nama' => $t->nama,
            'instansi' => $t->instansi,
            'no_hp' => $t->no_hp,
            'email' => $t->email,
            'tujuan_ditemui' => $t->tujuan_ditemui,
            'jumlah_tamu' => $t->jumlah_tamu,
            'keperluan' => $t->keperluan,
            'tanggal_input' => $t->tanggal_kunjungan ? $t->tanggal_kunjungan->format('Y-m-d\\TH:i') : null,
            'dokumen_zip_url' => $t->dokumen_zip_url,
        ])->toArray();

        return view('admin.tamu.index', compact('tamus', 'stats', 'tamuData', 'tamuFullDataForJs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => ['required', 'digits:16', 'unique:tamus,nik'],
            'nama' => ['required', 'string', 'max:150'],
            // Selaras form registrasi publik: instansi & email wajib
            'instansi' => ['required', 'string', 'max:150'],
            'no_hp' => ['required', 'string', 'max:25', 'regex:/^[0-9+\-\s()]+$/'],
            'email' => ['required', 'email', 'max:150'],
            // Input manual admin: satu berkas pendukung (opsional) dengan
            // format gabungan — selaras form registrasi publik
            'dokumen' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx,zip,rar,jpg,jpeg,png', 'max:10240'],
            'tujuan_ditemui' => ['required', 'string', 'max:150'],
            'jumlah_tamu' => ['required', 'integer', 'min:1', 'max:100'],
            'tanggal_kunjungan' => ['required', 'date'],
            // Slot jam operasional + blokir double-booking divisi sama
            'jam_kunjungan' => $this->jamRules($request),
            'keperluan' => ['required', 'string', 'max:2000'],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus tepat :digits digit angka.',
            'nik.unique' => 'NIK ini sudah terdaftar sebelumnya.',
            'instansi.required' => 'Perusahaan / instansi wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'no_hp.regex' => 'Format No. WhatsApp / HP tidak valid.',
            'dokumen.mimes' => 'Dokumen harus berformat PDF, DOC, DOCX, XLS, XLSX, ZIP, RAR, JPG, JPEG, atau PNG.',
            'dokumen.max' => 'Ukuran dokumen maksimal :max kilobyte (10MB).',
            'tanggal_kunjungan.required' => 'Tanggal kunjungan wajib diisi.',
            'tanggal_kunjungan.date' => 'Tanggal kunjungan tidak valid.',
            'jam_kunjungan.required' => 'Jam kunjungan wajib dipilih.',
            'jam_kunjungan.in' => 'Jam kunjungan harus di luar jam istirahat & sesuai jam operasional.',
        ]);

        if ($request->hasFile('dokumen')) {
            // Input manual admin: satu berkas pendukung (opsional)
            $validated['dokumen_zip'] = $request->file('dokumen')->store('dokumen', 'private');
        }

        // Tanggal (input date) + jam (dropdown slot) digabung jadi datetime,
        // sama seperti form registrasi publik.
        $validated['tanggal_kunjungan'] =
            \Carbon\Carbon::parse($validated['tanggal_kunjungan'])->format('Y-m-d')
            . ' ' . $validated['jam_kunjungan'];
        unset($validated['jam_kunjungan']);

        $tamu = Tamu::create($validated);

        ActivityLogger::log('create', null, [
            'module' => 'tamu',
            'description' => "menambahkan tamu manual \"{$tamu->nama}\" (NIK {$tamu->nik})",
            'subject' => $tamu,
        ]);

        return redirect()->route('admin.tamu.index')
            ->with('success', "Data tamu \"{$tamu->nama}\" berhasil ditambahkan.");
    }

    /**
     * Perbarui data tamu (dipakai modal edit).
     * NIK unik diabaikan untuk data tamu ini sendiri; dokumen pendukung hanya
     * diganti bila admin mengunggah file baru.
     */
    public function update(Request $request, Tamu $tamu)
    {
        $validated = $request->validate([
            'nik' => ['required', 'digits:16', 'unique:tamus,nik,' . $tamu->id],
            'nama' => ['required', 'string', 'max:150'],
            // Selaras form registrasi publik: instansi & email wajib
            'instansi' => ['required', 'string', 'max:150'],
            'no_hp' => ['required', 'string', 'max:25', 'regex:/^[0-9+\-\s()]+$/'],
            'email' => ['required', 'email', 'max:150'],
            'dokumen' => ['nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx,zip,rar,jpg,jpeg,png', 'max:10240'],
            'tujuan_ditemui' => ['required', 'string', 'max:150'],
            'jumlah_tamu' => ['required', 'integer', 'min:1', 'max:100'],
            'tanggal_kunjungan' => ['required', 'date'],
            // Blokir slot divisi sama — kunjungan INI sendiri dikecualikan,
            // dan jam lamanya (meski di luar slot) tetap boleh dipertahankan
            'jam_kunjungan' => $this->jamRules($request, $tamu->id, $tamu->tanggal_kunjungan?->format('H:i')),
            'keperluan' => ['required', 'string', 'max:2000'],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus tepat :digits digit angka.',
            'nik.unique' => 'NIK ini sudah terdaftar sebelumnya.',
            'instansi.required' => 'Perusahaan / instansi wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'no_hp.regex' => 'Format No. WhatsApp / HP tidak valid.',
            'dokumen.mimes' => 'Dokumen harus berformat PDF, DOC, DOCX, XLS, XLSX, ZIP, RAR, JPG, JPEG, atau PNG.',
            'dokumen.max' => 'Ukuran dokumen maksimal :max kilobyte (10MB).',
            'tanggal_kunjungan.required' => 'Tanggal kunjungan wajib diisi.',
            'tanggal_kunjungan.date' => 'Tanggal kunjungan tidak valid.',
            'jam_kunjungan.required' => 'Jam kunjungan wajib dipilih.',
        ]);

        if ($request->hasFile('dokumen')) {
            // Hapus file lama agar tidak menumpuk; unggahan baru
            // menggantikan dokumen tamu ini.
            if ($tamu->dokumen_zip) {
                Storage::disk('private')->delete($tamu->dokumen_zip);
            }
            $validated['dokumen_zip'] = $request->file('dokumen')->store('dokumen', 'private');
        }

        // Tanggal (input date) + jam (dropdown slot) digabung jadi datetime
        $validated['tanggal_kunjungan'] =
            \Carbon\Carbon::parse($validated['tanggal_kunjungan'])->format('Y-m-d')
            . ' ' . $validated['jam_kunjungan'];
        unset($validated['jam_kunjungan']);

        $tamu->update($validated);

        ActivityLogger::log('update', null, [
            'module' => 'tamu',
            'description' => "mengubah data tamu \"{$tamu->nama}\" (NIK {$tamu->nik})",
            'subject' => $tamu,
        ]);

        return redirect()->route('admin.tamu.index')
            ->with('success', "Data tamu \"{$tamu->nama}\" berhasil diperbarui.");
    }

    /**
     * Rule validasi "Jam Kunjungan" — selaras form registrasi publik:
     * wajib salah satu slot operasional, dan belum DISETUJUI untuk
     * divisi + tanggal yang sama (anti double-booking).
     *
     * @param  int|null  $kecualiId  ID kunjungan yang dikecualikan saat edit,
     *                               supaya tidak memblokir dirinya sendiri.
     * @param  string|null  $jamLama  Jam lama milik rekornya sendiri — masih
     *                               diterima saat edit agar data lama yang
     *                               di luar slot operasional tetap bisa disimpan.
     * @return array<int, mixed>
     */
    private function jamRules(Request $request, ?int $kecualiId = null, ?string $jamLama = null): array
    {
        return [
            'required',
            'date_format:H:i',
            function (string $attribute, mixed $value, \Closure $fail) use ($request, $kecualiId, $jamLama) {
                $divisi  = (string) $request->input('tujuan_ditemui');
                $tanggal = (string) $request->input('tanggal_kunjungan');

                if ($divisi === '' || $tanggal === '') {
                    return; // biarkan rule required yang menolak
                }

                try {
                    $tanggal = \Carbon\Carbon::parse($tanggal)->format('Y-m-d');
                } catch (\Throwable) {
                    return; // biarkan rule date yang menolak
                }

                // Harus slot operasional — kecuali tidak berubah dari nilai lama
                if (! in_array($value, Tamu::SLOT_JAM, true) && $value !== $jamLama) {
                    $fail('Jam kunjungan harus di luar jam istirahat & sesuai jam operasional.');

                    return;
                }

                if (Tamu::isJamTerblokir($tanggal, $value, $divisi, $kecualiId)) {
                    $fail("Jam {$value} sudah di-approve untuk divisi \"{$divisi}\" "
                        . "pada tanggal {$tanggal}. Silakan pilih jam lain.");
                }
            },
        ];
    }

    /**
     * Keputusan verifikasi kunjungan: "setuju" atau "tolak".
     *
     * Status disimpan, lalu admin diarahkan ke WhatsApp tamu (wa.me
     * click-to-chat) dengan pesan konfirmasi yang sudah terisi — admin
     * cukup menekan tombol kirim di aplikasi WA-nya.
     */
    public function verifikasi(Request $request, Tamu $tamu)
    {
        $validated = $request->validate([
            'keputusan' => ['required', 'in:setuju,tolak'],
        ], [
            'keputusan.required' => 'Pilih keputusan verifikasi terlebih dahulu.',
            'keputusan.in'       => 'Keputusan verifikasi tidak valid.',
        ]);

        $setuju = $validated['keputusan'] === 'setuju';

        $tamu->update([
            'status_verifikasi' => $setuju ? Tamu::STATUS_DISETUJUI : Tamu::STATUS_DITOLAK,
            'verified_at'       => now(),
            'verified_by'       => $request->user()->id,
        ]);

        ActivityLogger::log($setuju ? 'approve' : 'reject', null, [
            'module' => 'tamu',
            'description' => ($setuju ? 'menyetujui' : 'menolak') . " pendaftaran tamu \"{$tamu->nama}\" (NIK {$tamu->nik})",
            'subject' => $tamu,
        ]);

        $statusLabel = $setuju ? 'disetujui' : 'ditolak';

        // Flash data untuk pop-up "kirim konfirmasi WA" di halaman index:
        // memuat URL wa.me dengan pesan yang sudah terisi sesuai keputusan.
        return redirect()->route('admin.tamu.index')->with('wa_konfirmasi', [
            'nama'   => $tamu->nama,
            'no_wa'  => $tamu->wa_number,
            'status' => $statusLabel,
            'wa_url' => $setuju ? $tamu->wa_approve_url : $tamu->wa_reject_url,
        ])->with('success', "Pendaftaran tamu \"{$tamu->nama}\" {$statusLabel}.");
    }

    public function checkout(Tamu $tamu)
    {
        if ($tamu->checked_out_at !== null) {
            return redirect()->route('admin.tamu.index')
                ->with('error', "Tamu \"{$tamu->nama}\" sudah check-out sebelumnya.");
        }

        $tamu->update(['checked_out_at' => now()]);

        ActivityLogger::log('checkout', null, [
            'module' => 'tamu',
            'description' => "check-out tamu \"{$tamu->nama}\" (NIK {$tamu->nik})",
            'subject' => $tamu,
        ]);

        return redirect()->route('admin.tamu.index')
            ->with('success', "Tamu \"{$tamu->nama}\" ditandai selesai berkunjung.");
    }

    public function destroy(Tamu $tamu)
    {
        $nama = $tamu->nama;

        // Hapus file dokumen ZIP milik tamu ini
        if ($tamu->dokumen_zip) {
            Storage::disk('private')->delete($tamu->dokumen_zip);
        }

        $tamu->delete();

        ActivityLogger::log('delete', null, [
            'module' => 'tamu',
            'description' => "menghapus data tamu \"{$nama}\"",
        ]);

        return redirect()->route('admin.tamu.index')
            ->with('success', "Data tamu \"{$nama}\" berhasil dihapus.");
    }

    /**
     * Bangun query daftar tamu sesuai filter aktif (dipakai index,
     * export & print agar perilakunya konsisten).
     */
    private function filteredQuery(Request $request): \Illuminate\Database\Eloquent\Builder
    {
        return Tamu::query()
            ->search($request->string('q')->toString())
            ->tanggalAntara($request->input('dari'), $request->input('sampai'))
            ->status($request->string('status')->toString())
            ->latest()
            ->orderByDesc('id');
    }

    /**
     * Halaman cetak daftar tamu (dibuka di tab baru, lalu memicu
     * dialog print browser — bisa disimpan sebagai PDF). Dua gaya:
     * "excel" (tampilan spreadsheet) dan "pdf" (laporan formal).
     */
    public function print(Request $request, string $style = 'excel')
    {
        $style = in_array($style, ['excel', 'pdf'], true) ? $style : 'excel';

        $tamus = $this->filteredQuery($request)->get();

        ActivityLogger::log('print', null, [
            'module'      => 'tamu',
            'description' => "mencetak data tamu gaya {$style} (" . $tamus->count() . ' baris)',
        ]);

        return view('admin.tamu.print', [
            'tamus'  => $tamus,
            'style'  => $style,
            'filter' => [
                'q'      => $request->string('q')->toString(),
                'dari'   => $request->input('dari'),
                'sampai' => $request->input('sampai'),
                'status' => $request->string('status')->toString(),
            ],
        ]);
    }

    /**
     * Export CSV (dapat dibuka Excel) sesuai filter aktif —
     * streaming agar hemat memori untuk data besar.
     */
    public function export(Request $request): StreamedResponse
    {
        $filename = 'data-tamu-' . now()->format('Ymd-His') . '.csv';

        $query = $this->filteredQuery($request);

        ActivityLogger::log('export', null, [
            'module' => 'tamu',
            'description' => 'mengekspor data tamu ke CSV',
        ]);

        return response()->streamDownload(function () use ($query) {
            $out = fopen('php://output', 'w');

            // BOM UTF-8 agar Excel membaca karakter dengan benar
            fwrite($out, "\xEF\xBB\xBF");

            fputcsv($out, [
                'No', 'Waktu Daftar', 'Tanggal Kunjungan', 'Nama', 'NIK', 'No. HP', 'Email',
                'Instansi', 'Tujuan Ditemui', 'Jumlah Tamu', 'Keperluan',
                'Check-In', 'Check-Out', 'Status',
            ]);

            $query->chunk(500, function ($rows) use ($out) {
                $i = 0;
                foreach ($rows as $t) {
                    fputcsv($out, [
                        ++$i,
                        $t->created_at?->format('d/m/Y H:i'),
                        $t->tanggal_kunjungan?->format('d/m/Y H:i'),
                        $t->nama,
                        $t->nik,
                        $t->no_hp,
                        $t->email,
                        $t->instansi,
                        $t->tujuan_ditemui,
                        $t->jumlah_tamu,
                        $t->keperluan,
                        $t->checked_in_at?->format('d/m/Y H:i'),
                        $t->checked_out_at?->format('d/m/Y H:i'),
                        $t->checked_out_at ? 'Selesai' : 'Berkunjung',
                    ]);
                }
            });

            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
