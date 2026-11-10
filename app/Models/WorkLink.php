<?php

namespace App\Models;

use App\Models\Scopes\ScopedToUserDepartment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * WorkLink — Manajemen Link Kerja (alat kerja) Portal Karyawan.
 *
 * Kategori:
 * - 'umum'   : tampil untuk semua akun Karyawan.
 * - 'khusus' : tampil hanya untuk Bidang target (tabel master bidangs).
 *
 * Integrasi Master Bidang: kolom `bidang_id` menunjuk baris `bidangs`
 * yang dipilih di form. Kolom legacy `department` / `sub_department`
 * DITURUNKAN dari baris master tersebut (Bidang::departmentCode() /
 * subDepartmentCode()) agar filter data lama & Portal Karyawan tetap
 * bekerja. Label tampilan memakai `bidangs.nama`.
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
        // KONSISTENSI RELASI BIDANG — apa pun jalur penulisannya
        // (controller, seeder, tinker), kode legacy selalu diturunkan
        // dari baris Master Bidang yang dipilih.
        static::saving(function (WorkLink $link) {
            if ($link->category !== self::CATEGORY_KHUSUS) {
                $link->jabatan_id = null;

                return;
            }

            // Target Sub-Bidang berasal dari Master Jabatan: pastikan
            // pasangan Bidang ↔ Jabatan selalu konsisten (bidang link = bidang
            // tempat jabatan itu berada).
            if ($link->jabatan_id !== null) {
                $jabatan = Jabatan::query()->find($link->jabatan_id);

                if ($jabatan !== null) {
                    $link->bidang_id = (int) $jabatan->bidang_id;
                } else {
                    $link->jabatan_id = null;
                }
            }

            if ($link->bidang_id === null) {
                return;
            }

            $bidang = Bidang::query()->find($link->bidang_id);

            if ($bidang !== null) {
                $link->department     = $bidang->departmentCode();
                $link->sub_department = $bidang->subDepartmentCode();
            }
        });

        // DATA SCOPING — filter otomatis per bidang (spec RBAC poin 4).
        static::addGlobalScope(new ScopedToUserDepartment);
    }

    /**
     * Kontrak global scope ScopedToUserDepartment: terjemahkan tingkat
     * akses user login menjadi WHERE filter sesuai skema tabel ini.
     *
     * REVISI — Kategori Khusus dengan target Bidang & Sub-Bidang:
     * - Target JABATAN (`jabatan_id` terisi, dari Master Jabatan): link
     *   tampil untuk jabatan itu beserta seluruh bawahannya mengikuti
     *   relasi `parent_id` Master Jabatan (mis. ASSISTANT MANAGER
     *   KEUANGAN → JUNIOR OFFICER KEUANGAN), sekaligus atasan pada jalur
     *   struktur yang sama.
     * - Target BIDANG (`jabatan_id` NULL): link tampil untuk seluruh
     *   pegawai yang berada di Bidang itu / sub-bidang di bawahnya,
     *   beserta atasan pada jalur struktur tersebut.
     * - Link legacy tanpa `bidang_id` tetap memakai aturan kode lama
     *   (`department` / `sub_department`).
     * - Super Admin / Senior Manager / tanpa binding → tidak difilter
     *   (scope utama sudah bypass).
     *
     * OTOMATISASI: admin cukup memilih satu Bidang / Sub-Bidang — tidak
     * ada pemilihan pegawai satu per satu.
     */
    public function applyDataScoping(Builder $query, User $user): void
    {
        $bidang          = $user->bidangCode();
        $sub             = $user->subBidangId();
        $masterBidangId  = $user->bidang_id !== null ? (int) $user->bidang_id : null;
        $masterJabatanId = $user->jabatan_id !== null ? (int) $user->jabatan_id : null;
        $level           = $user->dataScopingLevel();

        // Jalur struktur user: atasan → unit → bawahan.
        $bidangScopeIds  = self::bidangScopeIds($masterBidangId);
        $jabatanScopeIds = $masterJabatanId !== null
            ? Jabatan::query()->find($masterJabatanId)?->accessScopeIds() ?? [$masterJabatanId]
            : [];

        $query->where(function (Builder $q) use ($bidang, $sub, $level, $bidangScopeIds, $jabatanScopeIds) {
            // Link 'umum' selalu tampil untuk semua akun.
            $q->where('category', self::CATEGORY_UMUM);

            // === 1) Target JABATAN / Sub-Bidang (Master Jabatan) ===
            if ($jabatanScopeIds !== []) {
                $q->orWhere(function (Builder $q2) use ($jabatanScopeIds) {
                    $q2->whereNotNull('jabatan_id')
                       ->whereIn('jabatan_id', $jabatanScopeIds);
                });
            }

            // === 2) Target BIDANG (seluruh pegawai di bidang tersebut) ===
            $q->orWhere(function (Builder $q2) use ($bidang, $sub, $level, $bidangScopeIds) {
                // Link ber-target jabatan tidak ikut aturan bidang.
                $q2->whereNull('jabatan_id');

                if ($bidangScopeIds !== []) {
                    $q2->where(function (Builder $q3) use ($bidang, $sub, $level, $bidangScopeIds) {
                        $q3->whereIn('bidang_id', $bidangScopeIds);

                        // Data legacy yang belum terpetakan ke Master Bidang.
                        if ($level === 'bidang_sub') {
                            $q3->orWhere(function (Builder $q4) use ($bidang, $sub) {
                                $q4->whereNull('bidang_id')
                                   ->where('department', $bidang)
                                   ->where('sub_department', $sub);
                            });
                        } elseif ($bidang !== null) {
                            $q3->orWhere(function (Builder $q4) use ($bidang) {
                                $q4->whereNull('bidang_id')->where('department', $bidang);
                            });
                        }
                    });
                } elseif ($level === 'bidang_sub') {
                    $q2->where('department', $bidang)->where('sub_department', $sub);
                } elseif ($bidang !== null) {
                    $q2->where('department', $bidang);
                } else {
                    // Tanpa pengikatan apa pun — jangan bocorkan link khusus.
                    $q2->whereRaw('1 = 0');
                }
            });
        });
    }

    /**
     * ID Bidang pada jalur struktur user (atasan + unit + bawahan).
     *
     * @return array<int, int>
     */
    private static function bidangScopeIds(?int $bidangId): array
    {
        if ($bidangId === null) {
            return [];
        }

        $row = Bidang::query()->find($bidangId);

        return $row !== null ? $row->accessScopeIds() : [$bidangId];
    }

    /** Bidang target link (master organisasi; NULL untuk link 'umum'). */
    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }

    /**
     * Sub-Bidang target link — baris Master Jabatan (koordinator/
     * manajerial). NULL berarti link berlaku untuk seluruh Bidang.
     */
    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
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
        'bidang_id',
        'jabatan_id',
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
        if ($this->category !== self::CATEGORY_KHUSUS) {
            return null;
        }

        // Nama baris Master Bidang terpilih — fallback label kode legacy
        // untuk data lama yang belum terpetakan.
        if ($this->bidang_id !== null) {
            return $this->bidang?->nama;
        }

        if ($this->department === null) {
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
            'bidang_id'      => $isKhusus && $this->bidang_id !== null ? (int) $this->bidang_id : null,
            'jabatan_id'     => $isKhusus && $this->jabatan_id !== null ? (int) $this->jabatan_id : null,
            'jabatan_label'  => $isKhusus && $this->jabatan !== null
                ? Jabatan::subBidangLabel($this->jabatan->nama)
                : null,
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
