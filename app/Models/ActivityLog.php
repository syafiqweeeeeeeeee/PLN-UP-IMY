<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Model legacy tabel activity_logs.
 *
 * Log aktivitas RUNTIME sudah dipindahkan ke file JSONL lewat
 * App\Services\ActivityLogger. Model ini hanya dipakai oleh command
 * `logs:migrate-db-to-file` untuk memindahkan baris lama dari database
 * ke file, sehingga helper tampilan lama (record/label/warna/scope)
 * tidak lagi diperlukan.
 */
class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_name',
        'user_role',
        'module',
        'action',
        'description',
        'subject_type',
        'subject_id',
        'ip_address',
        'user_agent',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subject(): MorphTo
    {
        return $this->morphTo();
    }
}
