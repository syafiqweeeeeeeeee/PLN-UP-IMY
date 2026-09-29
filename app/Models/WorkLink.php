<?php

namespace App\Models;

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
 */
class WorkLink extends Model
{
    use HasFactory;

    public const CATEGORY_UMUM = 'umum';
    public const CATEGORY_KHUSUS = 'khusus';

    /** Icon FontAwesome yang dipilih admin — fallback bila kosong. */
    public const DEFAULT_ICON = 'fa-link';

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
            'icon'           => $this->icon ?: self::DEFAULT_ICON,
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
