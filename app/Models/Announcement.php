<?php

namespace App\Models;

use App\Models\Scopes\ScopedToUserDepartment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    use HasFactory;

    /** Target publikasi konten. */
    public const TARGETS = ['public', 'portal', 'all'];

    protected $fillable = [
        'title',
        'slug',
        'category',
        'target_publication',
        'excerpt',
        'content',
        'is_published',
        'published_at',
        'author_user_id',
        'department_id',
    ];

    protected $casts = [
        'is_published'  => 'boolean',
        'target_publication' => 'string',
        'department_id' => 'integer',
        'published_at'  => 'datetime',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];

    public function departmentRef(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function authorUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_user_id');
    }

    protected static function booted(): void
    {
        // DATA SCOPING — filter otomatis per bidang (spec RBAC poin 4).
        static::addGlobalScope(new ScopedToUserDepartment);
    }

    /**
     * Kontrak global scope ScopedToUserDepartment: pengumuman dengan
     * department_id NULL bersifat GLOBAL (target pembaca "Semua
     * Karyawan (Umum)") — terlihat semua bidang. Selain itu hanya
     * pengumuman milik bidang user login.
     *
     * Super Admin / Senior Manager / tanpa binding → tidak difilter
     * (scope utama sudah bypass).
     */
    public function applyDataScoping(Builder $query, User $user): void
    {
        $query->where(function (Builder $q) use ($user) {
            $q->whereNull('department_id')
              ->orWhere('department_id', $user->bidangId());
        });
    }

    /**
     * Route binding TANPA global scope scoping: pengumuman milik
     * bidang lain tetap ditemukan sehingga guard controller
     * (authorizeAnnouncementAccess) menolaknya dengan 403 Forbidden —
     * bukan 404 — sesuai spec "cegah akses lintas bidang via URL
     * direct ID (403)".
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->withoutGlobalScope(ScopedToUserDepartment::class)
            ->where($field ?? $this->getRouteKeyName(), $value)
            ->first();
    }

    /**
     * Scope konten yang tampil di landing page website publik
     * (target 'public' atau 'all').
     */
    public function scopeForPublic($query)
    {
        return $query->whereIn('target_publication', ['public', 'all']);
    }

    /**
     * Scope konten yang tampil di Portal Karyawan
     * (target 'portal' atau 'all').
     */
    public function scopeForPortal($query)
    {
        return $query->whereIn('target_publication', ['portal', 'all']);
    }

    public static function generateSlug(string $title): string
    {
        $slug = mb_strtolower(trim(preg_replace('/[^A-Za-z0-9\s-]/', '', $title)));
        $slug = preg_replace('/\s+/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        $base = $slug;
        $count = 1;

        // Uniqueness slug dicek GLOBAL (tanpa data scoping) — slug dipakai
        // routing publik; dua Admin Bidang beda bidang tidak boleh
        // menghasilkan slug sama.
        while (static::withoutGlobalScope(ScopedToUserDepartment::class)
            ->where('slug', $slug)->exists()) {
            $slug = $base . '-' . $count++;
        }

        return $slug;
    }
}
