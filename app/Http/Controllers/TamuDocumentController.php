<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * TamuDocumentController — penyaji dokumen sensitif tamu (berkas pendukung:
 * arsip ZIP/RAR, PDF, atau gambar berisi KTP, surat permohonan, dll.)
 * dari disk PRIVAT.
 *
 * File TIDAK bisa diakses via URL publik /storage. Semua permintaan
 * melewati middleware auth + permission (didefinisikan pada route),
 * lalu controller meng-stream file dari storage/app/private/dokumen.
 *
 * Response diberi header no-store karena berisi data pribadi
 * (KTP = data pribadi spesifik, lihat UU PDP).
 */
class TamuDocumentController extends Controller
{
    /**
     * Unduh arsip dokumen ZIP tamu (attachment).
     */
    public function dokumen(Tamu $tamu): StreamedResponse
    {
        abort_unless($tamu->dokumen_zip, 404, 'Tamu tidak memiliki lampiran dokumen.');

        return $this->serve($tamu->dokumen_zip);
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
