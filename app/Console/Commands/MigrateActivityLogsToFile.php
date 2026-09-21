<?php

namespace App\Console\Commands;

use App\Models\ActivityLog;
use App\Services\ActivityLogger;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * Migrasi satu arah: tabel activity_logs → file JSONL harian
 * (activity-YYYY-MM-DD.jsonl) sesuai created_at tiap baris, dengan
 * tetap menjaga batas maksimal baris per file (chunking otomatis).
 *
 * Pemakaian:
 *   php artisan logs:migrate-db-to-file
 *   php artisan logs:migrate-db-to-file --delete   (hapus tabel setelah sukses)
 */
class MigrateActivityLogsToFile extends Command
{
    protected $signature = 'logs:migrate-db-to-file {--delete : Hapus seluruh baris tabel setelah migrasi berhasil}';

    protected $description = 'Memindahkan log aktivitas dari tabel activity_logs ke file JSONL harian (storage/logs/activity-YYYY-MM-DD.jsonl)';

    public function handle(): int
    {
        $total = ActivityLog::count();

        if ($total === 0) {
            $this->info('Tidak ada log di database — tidak ada yang perlu dimigrasi.');

            return self::SUCCESS;
        }

        $this->info("Memigrasi {$total} log aktivitas dari database ke file JSONL...");
        $bar = $this->output->createProgressBar($total);
        $bar->start();

        $migrated = 0;
        $byDate = [];

        ActivityLog::query()
            ->orderBy('created_at')
            ->orderBy('id')
            ->chunkById(500, function ($logs) use (&$migrated, &$byDate, $bar) {
                foreach ($logs as $log) {
                    ActivityLogger::appendEntry(
                        ActivityLogger::filePathFor(Carbon::parse($log->created_at)),
                        [
                            'id'         => $log->id ? (string) $log->id : (string) \Illuminate\Support\Str::uuid(),
                            // Gunakan timestamp asli (ISO 8601 UTC) agar
                            // log lama tetap muncul di tanggal asalnya.
                            'timestamp'  => $log->created_at
                                ? Carbon::parse($log->created_at)->setTimezone('UTC')->toISOString()
                                : Carbon::now('UTC')->toISOString(),
                            'event_type' => $log->action ?? 'update',
                            'module'     => $log->module ?? 'sistem',
                            'actor'      => [
                                'id'    => $log->user_id,
                                'name'  => $log->user_name ?? 'Sistem',
                                'email' => $log->user?->email,
                                'role'  => $log->user_role,
                            ],
                            'context'    => [
                                'ip'         => $log->ip_address,
                                'user_agent' => $log->user_agent,
                            ],
                            'payload'    => [
                                'description'  => $log->description ?? '',
                                'module_label' => ActivityLogger::moduleLabel($log->module ?? 'sistem'),
                                'subject_type' => $log->subject_type,
                                'subject_id'   => $log->subject_id,
                            ],
                        ]
                    );

                    $byDate[Carbon::parse($log->created_at)->format('Y-m-d')] = ($byDate[Carbon::parse($log->created_at)->format('Y-m-d')] ?? 0) + 1;
                    $migrated++;
                    $bar->advance();
                }
            });

        $bar->finish();
        $this->newLine(2);

        foreach (collect($byDate)->sortKeys() as $date => $count) {
            $this->line("  {$date}: {$count} entri → activity-{$date}.jsonl (+ chunk partN bila > " . ActivityLogger::MAX_LINES . ' baris)');
        }

        $this->newLine();
        $this->info("Selesai: {$migrated}/{$total} log dimigrasi.");

        if ($this->option('delete')) {
            ActivityLog::query()->delete();
            $this->warn('Tabel activity_logs dikosongkan (--delete).');
        } else {
            $this->line('Tabel activity_logs TIDAK diubah. Jalankan dengan --delete untuk mengosongkannya setelah verifikasi.');
        }

        // Verifikasi cepat: pastikan file benar-benar terbaca.
        $readable = count(Storage::disk(ActivityLogger::DISK)->files('/'));
        $this->line("File log aktivitas di storage/logs: {$readable}");

        return self::SUCCESS;
    }
}
