<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

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

    /* =========================================================
       HELPER PENCATATAN — dipakai controller: satu baris per aksi
       ActivityLog::record('berita', 'create', 'membuat berita "...', $news);
       ========================================================= */
    public static function record(string $module, string $action, string $description, ?Model $subject = null): ?self
    {
        $user = auth()->user();

        try {
            return static::create([
                'user_id'      => $user?->id,
                'user_name'    => $user?->name,
                'user_role'    => $user?->role,
                'module'       => $module,
                'action'       => $action,
                'description'  => $description,
                'subject_type' => $subject ? $subject::class : null,
                'subject_id'   => $subject?->id,
                'ip_address'   => request()?->ip(),
                'user_agent'   => Str::limit((string) request()?->userAgent(), 500, ''),
            ]);
        } catch (\Throwable $e) {
            // Logging tidak boleh menggagalkan alur utama (mis. login).
            // Catat ke error log, lalu lanjutkan.
            report($e);

            return null;
        }
    }

    /* =========================================================
       LABEL & TAMPILAN (dipakai view admin)
       ========================================================= */

    public static function actionLabels(): array
    {
        return [
            'create'    => 'Tambah',
            'update'    => 'Ubah',
            'delete'    => 'Hapus',
            'publish'   => 'Publikasi',
            'unpublish' => 'Tarik Publikasi',
            'login'     => 'Login',
            'logout'    => 'Logout',
            'clear'     => 'Bersihkan Log',
        ];
    }

    public static function actionColors(): array
    {
        return [
            'create'    => ['color' => '#16a34a', 'icon' => 'fa-plus'],
            'update'    => ['color' => '#d97706', 'icon' => 'fa-pen'],
            'delete'    => ['color' => '#dc2626', 'icon' => 'fa-trash'],
            'publish'   => ['color' => '#0284c7', 'icon' => 'fa-eye'],
            'unpublish' => ['color' => '#64748b', 'icon' => 'fa-eye-slash'],
            'login'     => ['color' => '#7c3aed', 'icon' => 'fa-right-to-bracket'],
            'logout'    => ['color' => '#475569', 'icon' => 'fa-right-from-bracket'],
            'clear'     => ['color' => '#b91c1c', 'icon' => 'fa-broom'],
        ];
    }

    public static function moduleLabels(): array
    {
        return [
            'berita'      => 'Berita',
            'pengumuman'  => 'Pengumuman',
            'galeri'      => 'Galeri',
            'pengguna'    => 'Pengguna',
            'role'        => 'Role & Hak Akses',
            'autentikasi' => 'Autentikasi',
            'log'         => 'Log Aktivitas',
        ];
    }

    public function getActionLabelAttribute(): string
    {
        return static::actionLabels()[$this->action] ?? ucfirst($this->action);
    }

    public function getActionColorAttribute(): string
    {
        return static::actionColors()[$this->action]['color'] ?? '#64748b';
    }

    public function getActionIconAttribute(): string
    {
        return static::actionColors()[$this->action]['icon'] ?? 'fa-circle-info';
    }

    public function getModuleLabelAttribute(): string
    {
        return static::moduleLabels()[$this->module] ?? ucfirst($this->module);
    }

    /* =========================================================
       SCOPE FILTER (dipakai halaman admin — tahap 3)
       ========================================================= */
    public function scopeFilter(Builder $query, ?string $module, ?string $action, ?string $search): Builder
    {
        return $query
            ->when($module, fn (Builder $q) => $q->where('module', $module))
            ->when($action, fn (Builder $q) => $q->where('action', $action))
            ->when($search, function (Builder $q) use ($search) {
                $q->where(function (Builder $q) use ($search) {
                    $q->where('description', 'like', "%{$search}%")
                        ->orWhere('user_name', 'like', "%{$search}%");
                });
            });
    }
}
