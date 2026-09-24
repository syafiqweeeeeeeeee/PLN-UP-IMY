<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * TamuDocumentController — penyaji dokumen sensitif tamu (foto KTP &
 * surat permohonan PDF) dari disk PRIVAT.
 *
 * File TIDAK bisa diakses via URL publik /storage. Semua permintaan
 * melewati middleware auth + permission (didefinisikan pada route),
 * lalu controller meng-stream file dari storage/app/private/documents.
 *
 * Response diberi header no-store karena berisi data pribadi
 * (KTP = data pribadi spesifik, lihat UU PDP).
 */
class TamuDocumentController extends Controller
{
    /**
     * Tampilkan foto KTP (inline) — dipakai <img> thumbnail & modal.
     */
    public function ktp(Tamu $tamu): StreamedResponse
    {
        abort_unless($tamu->foto_ktp, 404, 'Tamu tidak memiliki lampiran KTP.');

        return $this->serve($tamu->foto_ktp);
    }

    /**
     * Tampilkan surat permohonan PDF (inline, bisa dibuka di tab baru).
     */
    public function surat(Tamu $tamu): StreamedResponse
    {
        abort_unless($tamu->surat_jalan, 404, 'Tamu tidak memiliki lampiran surat.');

        return $this->serve($tamu->surat_jalan);
    }

    /**
     * Stream file dari disk 'private' dengan header keamanan.
     */
    private function serve(string $path): StreamedResponse
    {
        abort_unless(Storage::disk('private')->exists($path), 404, 'File dokumen tidak ditemukan.');

        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('private');

        return $disk->response($path, null, [
            'Cache-Control' => 'private, no-store, max-age=0',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
