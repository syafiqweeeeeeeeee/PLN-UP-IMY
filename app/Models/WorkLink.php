<?php

namespace App\Models;

use App\Models\Scopes\ScopedToUserDepartment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * WorkLink — Manajemen Link Kerja (alat kerja) Portal Karyawan.
 *
 * Kategori:
 * - 'umum'   : tampil untuk semua akun Karyawan.
 * - 'khusus' : tampil hanya untuk Bidang Utama (department) dan
 *              Sub-Bidang (sub_department) target.
 *
 * Label bidang & sub-bidang diambil dari konstanta User::DEPARTMENTS
 * dan User::SUB_DEPARTMENTS agar konsisten dengan Hirarki Organisasi.
 *
 * DATA SCOPING: model ini memakai global scope ScopedToUserDepartment
 * — query otomatis terfilter bidang/sub-bidang milik user login
 * (Admin Bidang & Karyawan; Super Admin/Senior Manager bypass).
 */
class WorkLink extends Model
{
    use HasFactory;

    public const CATEGORY_UMUM = 'umum';
    public const CATEGORY_KHUSUS = 'khusus';

    /** Icon FontAwesome yang dipilih admin — fallback bila kosong. */
    public const DEFAULT_ICON = 'fa-link';

    protected static function booted(): void
    {
        // DATA SCOPING — filter otomatis per bidang (spec RBAC poin 4).
        static::addGlobalScope(new ScopedToUserDepartment);
    }

    /**
     * Kontrak global scope ScopedToUserDepartment: terjemahkan tingkat
     * akses user login menjadi WHERE filter sesuai skema tabel ini.
     *
     * REVISI — unit kerja = bidang + sub-bidang:
     * - Terikat sub (Admin Bidang baru & Karyawan Asmen/Staff) → link
     *   'umum' + link khusus sub-bidangnya SAJA; data level bidang &
     *   sub lain dikelola Super Admin.
     * - Terikat bidang tanpa sub (legacy Admin Bidang / Karyawan
     *   Manager Bidang) → link 'umum' + seluruh link bidangnya.
     * - Super Admin / Senior Manager / tanpa binding → tidak difilter
     *   (scope utama sudah bypass).
     */
    public function applyDataScoping(Builder $query, User $user): void
    {
        $bidang = $user->bidangCode();
        $sub    = $user->subBidangId();

        $query->where(function (Builder $q) use ($bidang, $sub, $user) {
            if ($user->dataScopingLevel() === 'bidang_sub') {
                // Terkunci sub-bidang: link 'umum' + link khusus unit
                // kerjanya SAJA — link khusus level bidang & sub lain
                // tidak ditampilkan.
                $q->where('category', self::CATEGORY_UMUM)
                  ->orWhere(function (Builder $q2) use ($bidang, $sub) {
                      $q2->where('department', $bidang)
                         ->where('sub_department', $sub);
                  });
            } else {
                // Terikat bidang saja:
                // link 'umum' + seluruh link bidangnya (semua sub).
                $q->where('category', self::CATEGORY_UMUM)
                  ->orWhere('department', $bidang);
            }
        });
    }

    /**
     * Route binding TANPA global scope scoping: baris lintas-bidang
     * tetap ditemukan sehingga guard controller
     * (authorizeWorkLinkAccess) dapat menolaknya dengan 403 Forbidden
     * — bukan 404 — sesuai spec "cegah akses lintas bidang via URL
     * direct ID (403)".
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->withoutGlobalScope(ScopedToUserDepartment::class)
            ->where($field ?? $this->getRouteKeyName(), $value)
            ->first();
    }

    /**
     * Class <i> siap pakai untuk ikon link — mendukung nilai DB lama
     * ('fa-link') dan baru ('fa-solid fa-link') sekaligus.
     */
    public function getIconClassAttribute(): string
    {
        $icon = trim((string) $this->icon) ?: self::DEFAULT_ICON;

        return preg_match('/^fa-(solid|regular|brands|light|thin|duotone)(\s|$)/', $icon)
            ? $icon
            : 'fa-solid ' . $icon;
    }

    /**
     * Nama ikon pendek ('fa-link') untuk view portal yang menyuntikkan
     * prefix style sendiri (<i class="fas {{ $icon }}">).
     */
    public function getShortIconAttribute(): string
    {
        return preg_replace(
            '/^fa-(solid|regular|brands|light|thin|duotone)\s+/',
            '',
            trim((string) $this->icon) ?: self::DEFAULT_ICON
        );
    }

    protected $fillable = [
        'title',
        'url',
        'description',
        'icon',
        'category',
        'department',
        'sub_department',
        'is_active',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Label Bidang Utama target (null bila tidak relevan / tidak terdaftar).
     */
    public function getDepartmentLabelAttribute(): ?string
    {
        if ($this->category !== self::CATEGORY_KHUSUS || $this->department === null) {
            return null;
        }

        return User::DEPARTMENTS[$this->department] ?? $this->department;
    }

    /**
     * Label Sub-Bidang target (null bila link level bidang).
     */
    public function getSubDepartmentLabelAttribute(): ?string
    {
        if ($this->category !== self::CATEGORY_KHUSUS || $this->sub_department === null) {
            return null;
        }

        return User::subDepartmentLabel($this->department, $this->sub_department)
            ?? $this->sub_department;
    }

    /**
     * Representasi array untuk kartu Link Kerja di Portal Karyawan —
     * bentuknya sama dengan array workLinks() di PortalContentService
     * agar view portal tidak perlu diubah.
     */
    public function toPortalArray(): array
    {
        $isKhusus = $this->category === self::CATEGORY_KHUSUS;

        return [
            'id'             => (string) $this->id,
            'name'           => $this->title,
            'url'            => $this->url,
            'category'       => $isKhusus ? ($this->department ?? self::CATEGORY_KHUSUS) : self::CATEGORY_UMUM,
            'department'     => $isKhusus ? $this->department : null,
            'sub_department' => $isKhusus ? $this->sub_department : null,
            'icon'           => $this->short_icon,
            'color'          => '#008fa8',
            'description'    => $this->description ?? '',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('category')->orderBy('title');
    }
}
