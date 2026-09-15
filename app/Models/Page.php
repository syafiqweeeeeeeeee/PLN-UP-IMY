<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory;

    public const STATUS_DRAFT     = 'draft';
    public const STATUS_PUBLISHED = 'published';

    public const VISIBILITY_PUBLIC    = 'public';
    public const VISIBILITY_ROLE_ONLY = 'role_restricted';

    protected $fillable = [
        'title',
        'slug',
        'status',
        'visibility',
        'show_in_list',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'show_in_list' => 'boolean',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'page_role');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(PageSection::class)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /* =========================================================
       SCOPE
       ========================================================= */

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    public function scopeListing(Builder $query): Builder
    {
        return $query->where('show_in_list', true);
    }

    /**
     * Hanya halaman yang boleh dilihat user ini (untuk daftar halaman).
     * Enforce sesungguhnya ada di middleware/route — scope ini hanya
     * menyaring daftar, bukan pengganti keamanan.
     */
    public function scopeVisibleTo(Builder $query, ?User $user): Builder
    {
        $roleIds = $user ? $user->roles->pluck('id') : collect();

        return $query->where(function (Builder $q) use ($roleIds) {
            $q->where('visibility', self::VISIBILITY_PUBLIC);

            if ($roleIds->isNotEmpty()) {
                $q->orWhere(function (Builder $w) use ($roleIds) {
                    $w->where('visibility', self::VISIBILITY_ROLE_ONLY)
                        ->whereHas('roles', fn (Builder $r) => $r->whereIn('roles.id', $roleIds));
                });
            }
        });
    }

    /* =========================================================
       KEAMANAN — satu sumber kebenaran akses halaman.
       Dipakai middleware page.visible (server-side enforcement).
       ========================================================= */
    public function isAccessibleBy(?User $user): bool
    {
        if ($this->status !== self::STATUS_PUBLISHED) {
            return false; // draft tidak pernah bisa diakses dari route publik
        }

        if ($this->visibility === self::VISIBILITY_PUBLIC) {
            return true;
        }

        // role_restricted: wajib login DAN punya salah satu role terpilih.
        // Jika belum ada role dipilih sama sekali → terkunci (aman by default).
        if (! $user) {
            return false;
        }

        $allowedRoleIds = $this->roles->pluck('id');

        if ($allowedRoleIds->isEmpty()) {
            return false;
        }

        return $user->roles->pluck('id')->intersect($allowedRoleIds)->isNotEmpty();
    }

    /* =========================================================
       SLUG — pola sama dengan News::generateSlug
       ========================================================= */
    public static function generateSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = mb_strtolower(trim(preg_replace('/[^A-Za-z0-9\s-]/', '', $title)));
        $slug = preg_replace('/\s+/', '-', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        $base = $slug;
        $count = 1;
        while (static::where('slug', $slug)->when($ignoreId, fn (Builder $q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $count++;
        }
        return $slug;
    }
}
