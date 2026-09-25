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
 * store()    : tambah tamu manual oleh admin (foto KTP opsional).
 * update()   : perubahan data tamu via modal edit (foto KTP opsional).
 * checkout() : tandai tamu selesai berkunjung (isi checked_out_at).
 * destroy()  : hapus data tamu beserta file KTP-nya.
 * export()   : unduh CSV sesuai filter yang sedang aktif.
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
        ];

        $tamus = $query->paginate(15)->withQueryString();

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
            'status'    => $t->checked_out_at ? 'Selesai' : 'Berkunjung',
            // Nilai mentah utk <input type="datetime-local"> pada modal edit
            'tanggal_input' => $t->tanggal_kunjungan?->format('Y-m-d\\TH:i'),
            'ktp'       => $t->foto_ktp ? $t->foto_ktp_url : null,
            'surat'     => $t->surat_jalan_url,
        ])->keyBy('id');

        return view('admin.tamu.index', compact('tamus', 'stats', 'tamuData'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => ['required', 'digits:16', 'unique:tamus,nik'],
            'nama' => ['required', 'string', 'max:150'],
            'instansi' => ['nullable', 'string', 'max:150'],
            'no_hp' => ['required', 'string', 'max:25', 'regex:/^[0-9+\-\s()]+$/'],
            'email' => ['nullable', 'email', 'max:150'],
            // Untuk input manual, unggah KTP tidak diwajibkan
            'foto_ktp' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'tujuan_ditemui' => ['required', 'string', 'max:150'],
            'jumlah_tamu' => ['required', 'integer', 'min:1', 'max:100'],
            'tanggal_kunjungan' => ['required', 'date'],
            'keperluan' => ['required', 'string', 'max:2000'],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus tepat :digits digit angka.',
            'nik.unique' => 'NIK ini sudah terdaftar sebelumnya.',
            'no_hp.regex' => 'Format No. WhatsApp / HP tidak valid.',
        ]);

        if ($request->hasFile('foto_ktp')) {
            $validated['foto_ktp'] = $request->file('foto_ktp')->store('ktp', 'private');
        }

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
     * NIK unik diabaikan untuk data tamu ini sendiri; foto KTP hanya
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
            'foto_ktp' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'surat_jalan' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
            'tujuan_ditemui' => ['required', 'string', 'max:150'],
            'jumlah_tamu' => ['required', 'integer', 'min:1', 'max:100'],
            'tanggal_kunjungan' => ['required', 'date'],
            'keperluan' => ['required', 'string', 'max:2000'],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus tepat :digits digit angka.',
            'nik.unique' => 'NIK ini sudah terdaftar sebelumnya.',
            'no_hp.regex' => 'Format No. WhatsApp / HP tidak valid.',
            'surat_jalan.mimes' => 'File surat harus berformat PDF.',
            'surat_jalan.max' => 'Ukuran file surat maksimal :max kilobyte (5MB).',
        ]);

        if ($request->hasFile('foto_ktp')) {
            // Hapus file KTP lama agar tidak menumpuk
            if ($tamu->foto_ktp) {
                Storage::disk('private')->delete($tamu->foto_ktp);
            }
            $validated['foto_ktp'] = $request->file('foto_ktp')->store('ktp', 'private');
        }

        if ($request->hasFile('surat_jalan')) {
            // Hapus file surat lama agar tidak menumpuk
            if ($tamu->surat_jalan) {
                Storage::disk('private')->delete($tamu->surat_jalan);
            }
            $validated['surat_jalan'] = $request->file('surat_jalan')->store('surat', 'private');
        }

        $tamu->update($validated);

        ActivityLogger::log('update', null, [
            'module' => 'tamu',
            'description' => "mengubah data tamu \"{$tamu->nama}\" (NIK {$tamu->nik})",
            'subject' => $tamu,
        ]);

        return redirect()->route('admin.tamu.index')
            ->with('success', "Data tamu \"{$tamu->nama}\" berhasil diperbarui.");
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

        if ($tamu->foto_ktp) {
            Storage::disk('private')->delete($tamu->foto_ktp);
        }

        if ($tamu->surat_jalan) {
            Storage::disk('private')->delete($tamu->surat_jalan);
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
     * Export CSV (dapat dibuka Excel) sesuai filter aktif —
     * streaming agar hemat memori untuk data besar.
     */
    public function export(Request $request): StreamedResponse
    {
        $filename = 'data-tamu-' . now()->format('Ymd-His') . '.csv';

        $query = Tamu::query()
            ->search($request->string('q')->toString())
            ->tanggalAntara($request->input('dari'), $request->input('sampai'))
            ->status($request->string('status')->toString())
            ->latest()
            ->orderByDesc('id');

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
