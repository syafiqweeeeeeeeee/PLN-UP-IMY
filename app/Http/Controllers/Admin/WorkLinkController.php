<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\ScopesToDepartment;
use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Jabatan;
use App\Models\User;
use App\Models\WorkLink;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;

/**
 * Manajemen Link Kerja — CRUD tautan alat kerja yang tampil
 * di Portal Karyawan (tab Link & dashboard).
 *
 * Kategori:
 * - 'umum'   → tampil otomatis di semua akun Karyawan.
 * - 'khusus' → tampil sesuai Bidang target dari MASTER BIDANG (tabel
 *              bidangs). Kolom legacy department/sub_department diturunkan
 *              dari baris Bidang terpilih agar scoping & Portal Karyawan
 *              tetap konsisten.
 */
class WorkLinkController extends Controller
{
    use ScopesToDepartment;

    public function index(Request $request)
    {
        // Read: Admin Bidang dapat MELIHAT seluruh link (transparansi
        // katalog), tetapi tulis (tambah/edit/hapus) dibatasi ke link
        // 'umum' + 'khusus' milik bidangnya — dijaga di view (flag
        // data-can-edit) dan di guard controller.
        $query = WorkLink::query()->with(['bidang.parent', 'jabatan']);

        if (in_array($request->query('kategori'), [WorkLink::CATEGORY_UMUM, WorkLink::CATEGORY_KHUSUS], true)) {
            $query->where('category', $request->query('kategori'));
        }

        if (in_array($request->query('status'), ['aktif', 'nonaktif'], true)) {
            $query->where('is_active', $request->query('status') === 'aktif');
        }

        if ($search = trim((string) $request->query('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('url', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $links = $query->orderBy('category')->orderBy('title')->paginate(15)->withQueryString();

        return view('admin.work_links.index', array_merge(
            compact('links'),
            $this->bidangOptionsForUser()
        ));
    }

    public function create()
    {
        return view('admin.work_links.form', $this->formContext(null));
    }

    public function store(Request $request)
    {
        $validated = $this->validatePayload($request);

        // Target Bidang divalidasi ulang & dipaksa ke unit kerja Admin
        // Bidang (anti manipulasi) — sekaligus menurunkan department /
        // sub_department legacy dari baris Master Bidang terpilih.
        $validated = $this->applyTargetScope($validated);

        $link = WorkLink::create($validated);

        ActivityLogger::log('create', null, [
            'module'      => 'link_kerja',
            'description' => "menambahkan link kerja \"{$link->title}\"",
            'subject'     => $link,
        ]);

        return redirect()->route('admin.work-links.index')
            ->with('success', 'Link Kerja berhasil ditambahkan.');
    }

    public function edit(WorkLink $work_link)
    {
        // Delete/Edit Guard: tolak data milik bidang lain (URL direct access).
        // Link 'umum' boleh dikelola semua Admin Bidang; 'khusus' hanya milik
        // bidangnya sendiri.
        $this->authorizeWorkLinkAccess($work_link);

        return view('admin.work_links.form', $this->formContext($work_link));
    }

    public function update(Request $request, WorkLink $work_link)
    {
        $this->authorizeWorkLinkAccess($work_link);

        $validated = $this->validatePayload($request);

        // Admin Bidang tidak boleh memindahkan data ke bidang lain —
        // bidang target di luar unit kerjanya dikembalikan ke unit sendiri.
        $validated = $this->applyTargetScope($validated, $work_link);

        $work_link->update($validated);

        ActivityLogger::log('update', null, [
            'module'      => 'link_kerja',
            'description' => "mengubah link kerja \"{$work_link->title}\"",
            'subject'     => $work_link,
        ]);

        // AJAX (modal edit inline) → JSON berisi data terbaru agar
        // baris tabel di halaman index bisa diperbarui tanpa reload.
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Link Kerja berhasil diperbarui.',
                'link'    => $this->linkPayload($work_link->fresh()),
            ]);
        }

        return redirect()->route('admin.work-links.index')
            ->with('success', 'Link Kerja berhasil diperbarui.');
    }

    /**
     * Representasi JSON satu link kerja untuk pembaruan baris tabel
     * index tanpa reload (modal edit AJAX).
     */
    private function linkPayload(WorkLink $link): array
    {
        return [
            'id'           => $link->id,
            'title'        => $link->title,
            'url'          => $link->url,
            'description'  => $link->description ?? '',
            'icon'         => $link->icon ?: WorkLink::DEFAULT_ICON,
            'category'     => $link->category,
            'bidang_id'    => $link->bidang_id,
            'bidang_label' => $link->department_label,
            'jabatan_id'   => $link->jabatan_id,
            'jabatan_label' => $link->jabatan !== null
                ? Jabatan::subBidangLabel($link->jabatan->nama)
                : null,
            'bidang_parent_label' => $link->bidang?->parent?->nama,
            'department'   => $link->department,
            'sub_department' => $link->sub_department,
            'is_active'    => $link->is_active,
        ];
    }

    /**
     * Toggle status Aktif/Nonaktif — link nonaktif disembunyikan
     * dari Portal Karyawan tanpa dihapus.
     */
    public function toggleStatus(Request $request, WorkLink $work_link)
    {
        $this->authorizeWorkLinkAccess($work_link);

        $work_link->update(['is_active' => ! $work_link->is_active]);

        $aktif = $work_link->is_active;

        ActivityLogger::log($aktif ? 'publish' : 'unpublish', null, [
            'module'      => 'link_kerja',
            'description' => ($aktif ? 'mengaktifkan' : 'menonaktifkan') . " link kerja \"{$work_link->title}\"",
            'subject'     => $work_link,
        ]);

        $message = $aktif ? 'Link Kerja berhasil diaktifkan.' : 'Link Kerja berhasil dinonaktifkan.';

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => $message, 'is_active' => $aktif]);
        }

        return back()->with('success', $message);
    }

    public function destroy(WorkLink $work_link)
    {
        $this->authorizeWorkLinkAccess($work_link);

        ActivityLogger::log('delete', null, [
            'module'      => 'link_kerja',
            'description' => "menghapus link kerja \"{$work_link->title}\"",
            'subject'     => $work_link,
        ]);

        $work_link->delete();

        return redirect()->route('admin.work-links.index')
            ->with('success', 'Link Kerja berhasil dihapus.');
    }

    /**
     * Konteks view form create/edit: pilihan **Bidang** dan
     * **Sub-Bidang** LANGSUNG dari tabel master `bidangs` (berjenjang).
     *
     * - Super Admin / Senior Manager: semua bidang.
     * - Admin Bidang terikat baris Master Bidang: hanya baris unitnya +
     *   seluruh sub-bidang di bawahnya (tidak bisa memilih bidang lain).
     * - Akun legacy tanpa `users.bidang_id`: opsi disaring lewat kode
     *   bidang lama (`users.department`).
     *
     * Pemilihan Sub-Bidang bersifat OPSIONAL: kosong berarti link berlaku
     * untuk seluruh pegawai di Bidang terpilih (termasuk sub-bidang di
     * bawahnya). Sub-Bidang diambil dari MASTER JABATAN yang berelasi
     * dengan Bidang tersebut (jabatan koordinator/manajerial).
     * `$lockedBidangId` (akun terkunci sub-bidang) membuat kedua select
     * read-only dan server tetap memaksa baris unitnya.
     */
    private function formContext(?WorkLink $link): array
    {
        $context = $this->bidangOptionsForUser();

        // Target tersimpan: bidang_id, atau hasil pemetaan kode legacy
        // (link lama belum terpetakan) supaya form Edit tidak kehilangan
        // target saat admin menyimpan ulang.
        $defaultBidangId = $link?->bidang_id
            ?? $this->bidangIdFromLegacyCodes($link?->department, $link?->sub_department);

        $defaultJabatanId = $link?->jabatan_id;

        if ($context['lockedBidangId'] !== null) {
            // Akun terkunci sub-bidang: Bidang unitnya read-only, Sub-Bidang
            // (jabatan) tidak bisa dipilih — server memaksa baris unitnya.
            // Abaikan old() saat validasi gagal.
            $selectedBidangId  = $context['lockedBidangId'];
            $selectedJabatanId = null;
        } else {
            $selectedBidangId = old('bidang_id');
            if ($selectedBidangId === null || $selectedBidangId === '') {
                $selectedBidangId = $defaultBidangId;
            }

            $selectedJabatanId = old('jabatan_id');
            if ($selectedJabatanId === null) {
                $selectedJabatanId = $defaultJabatanId;
            }
        }

        return array_merge($context, [
            'link'              => $link,
            'selectedBidangId'  => $selectedBidangId !== null ? (int) $selectedBidangId : null,
            'selectedJabatanId' => $selectedJabatanId !== null && $selectedJabatanId !== ''
                ? (int) $selectedJabatanId
                : null,
        ]);
    }

    /**
     * Opsi Bidang untuk form & modal edit — sumber tunggal MASTER BIDANG.
     *
     * FIX (dropdown kosong): dulu tiap baris wajib `hasLegacyScope()`
     * (punya kode legacy `department_code`). Baris Master Bidang yang
     * dibuat lewat form admin TIDAK punya kode sama sekali (form tidak
     * punya field itu) → seluruh opsi terbuang dan panel menampilkan
     * "Tidak ada pilihan". Target link disimpan sebagai `bidang_id`
     * (bukan kode legacy), jadi pemilihan TIDAK boleh bergantung pada
     * kode — sekarang semua baris master tampil. Kode legacy tetap
     * diisi lewat Master Bidang (field manual / tombol "Petakan Kode
     * Legacy") supaya visibilitas Portal Karyawan ikut terpetakan.
     *
     * @return array{bidangOptions: \Illuminate\Support\Collection, subBidangOptions: \Illuminate\Support\Collection, lockedBidangId: ?int, lockedBidangLabel: ?string}
     */
    private function bidangOptionsForUser(): array
    {
        $user   = auth()->user();
        $scoped = $user !== null && ! $user->bypassesDataScoping();
        $bound  = $this->scopedDepartment();

        $ownBidang = $scoped && $user->bidang_id !== null
            ? Bidang::query()->find($user->bidang_id)
            : null;

        $rows = Bidang::treeOrdered(Bidang::query()->with('parent'), ['parent']);

        if ($ownBidang !== null) {
            // Sertakan leluhur agar pasangan Bidang → Sub-Bidang tetap
            // tampil utuh (akun terkunci sub-bidang melihat Bidang induk
            // & unitnya). Penulisan tetap dibatasi allowedBidangIds().
            $allowedIds = $ownBidang->accessScopeIds();
            $rows = $rows->filter(
                fn (array $row) => in_array((int) $row['node']->id, $allowedIds, true)
            );
        } elseif ($bound !== null) {
            $rows = $rows->filter(
                fn (array $row) => $row['node']->departmentCode() === $bound
            );
        }

        $allOptions = $rows->map(fn (array $row) => [
            'id'        => (int) $row['node']->id,
            'nama'      => $row['node']->nama,
            'depth'     => (int) $row['depth'],
            'parent_id' => $row['node']->parent_id !== null ? (int) $row['node']->parent_id : null,
        ])->values();

        $lockedBidangId = $scoped && $user->dataScopingLevel() === 'bidang_sub'
            ? ($ownBidang?->id)
            : null;

        // Semua baris Master Bidang yang boleh dipilih (induk & sub-bidang)
        // tetap ditampilkan — perilaku dropdown Bidang tidak berubah.
        $bidangOptions = $allOptions;
        $bidangIds     = $bidangOptions->pluck('id')->all();

        // Sub-Bidang = jabatan KOORDINATOR/MANAJERIAL dari MASTER JABATAN
        // yang berelasi dengan Bidang di atas (jabatans.bidang_id). Label
        // tampilan sudah dibersihkan dari prefix gelar jabatan.
        $subBidangOptions = Jabatan::query()
            ->forSubBidang()
            ->orderBy('nama')
            ->get(['id', 'nama', 'bidang_id'])
            ->filter(fn (Jabatan $jabatan) => in_array((int) $jabatan->bidang_id, $bidangIds, true))
            ->map(fn (Jabatan $jabatan) => [
                'id'        => (int) $jabatan->id,
                'nama'      => Jabatan::subBidangLabel($jabatan->nama),
                'parent_id' => (int) $jabatan->bidang_id,
            ])
            ->values();

        return [
            'bidangOptions'     => $bidangOptions,
            'subBidangOptions'  => $subBidangOptions,
            'lockedBidangId'    => $lockedBidangId,
            'lockedBidangLabel' => $lockedBidangId !== null ? $ownBidang?->nama : null,
        ];
    }

    /**
     * Aturan validasi bersama store() & update().
     */
    private function validatePayload(Request $request): array
    {
        $departments = implode(',', array_keys(User::DEPARTMENTS));
        $subCodes    = array_merge(...array_map('array_keys', array_values(User::SUB_DEPARTMENTS)));

        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'url'         => ['required', 'string', 'max:500'],
            'description' => ['nullable', 'string', 'max:1000'],
            'icon'        => ['nullable', 'string', 'max:60'],
            'category'    => ['required', 'in:' . WorkLink::CATEGORY_UMUM . ',' . WorkLink::CATEGORY_KHUSUS],
            // Bidang target dari MASTER BIDANG (form baru).
            'bidang_id'   => ['nullable', 'integer', 'exists:bidangs,id'],
            // Sub-Bidang target (opsional) — baris MASTER JABATAN yang
            // berelasi dengan Bidang terpilih (jabatan manajerial).
            'jabatan_id'  => ['nullable', 'integer', 'exists:jabatans,id'],
            // Kode legacy tetap diterima (API lama / data yang belum
            // terpetakan); nilainya diturunkan ulang dari bidang_id bila ada.
            'department'  => ['nullable', 'in:' . $departments],
            'sub_department' => ['nullable', 'in:' . implode(',', array_merge($subCodes, ['']))],
            'is_active'   => ['nullable', 'boolean'],
        ], [
            'title.required'   => 'Nama Link wajib diisi.',
            'url.required'     => 'URL Tujuan wajib diisi.',
            'category.required' => 'Kategori link wajib dipilih.',
            'category.in'      => 'Kategori link tidak valid.',
            'bidang_id.integer' => 'Bidang target tidak valid.',
            'bidang_id.exists' => 'Bidang target tidak ditemukan — pilih dari daftar bidang yang tersedia.',
            'jabatan_id.integer' => 'Sub-Bidang target tidak valid.',
            'jabatan_id.exists' => 'Sub-Bidang target tidak ditemukan — pilih dari daftar sub-bidang yang tersedia.',
            'department.in'    => 'Bidang Utama target tidak valid.',
            'sub_department.in' => 'Sub-Bidang target tidak valid.',
        ]);

        $validated['is_active'] = ! empty($validated['is_active']);

        // Normalisasi URL: tanpa skema → https:// otomatis.
        $url = trim($validated['url']);
        if (! preg_match('#^https?://#i', $url) && ! preg_match('#^[/\\#]#', $url)) {
            $url = 'https://' . $url;
        }
        $validated['url'] = $url;

        return $validated;
    }

    /**
     * Tentukan target akhir link (bidang_id + kode legacy) sesuai
     * kategori dan hak unit kerja user yang login.
     *
     * Aturan:
     * - 'umum'   → seluruh kolom target dikosongkan.
     * - 'khusus' → target Bidang (`bidang_id`) + Sub-Bidang opsional
     *              (`jabatan_id`, baris Master Jabatan yang berelasi dengan
     *              Bidang itu). Tanpa Sub-Bidang → seluruh pegawai di
     *              Bidang tersebut; dengan Sub-Bidang → jabatan itu dan
     *              seluruh bawahannya (parent_id Master Jabatan).
     *              Kode legacy diturunkan dari baris Bidang. Bila bidang_id
     *              kosong, kode legacy dipetakan balik ke baris master
     *              (kompatibel API lama). Kode tidak valid → kembali umum.
     * - Admin Bidang (bukan bypass): target di luar unit kerjanya dipaksa
     *   ke unit sendiri — akun terkunci sub-bidang SELALU persis baris
     *   unitnya. Super Admin / tanpa master → perilaku lama dipertahankan.
     */
    private function applyTargetScope(array $validated, ?WorkLink $existing = null): array
    {
        // Sub-Bidang (Master Jabatan) hanya menentukan target jabatan —
        // kolom DB-nya `jabatan_id`, bukan turunan kode legacy.
        $hasJabatanField = array_key_exists('jabatan_id', $validated);
        $jabatanId       = $this->normalizeIdInput($validated['jabatan_id'] ?? null);
        unset($validated['jabatan_id']);

        if (($validated['category'] ?? '') === WorkLink::CATEGORY_UMUM) {
            return array_merge($validated, [
                'bidang_id'      => null,
                'jabatan_id'     => null,
                'department'     => null,
                'sub_department' => null,
            ]);
        }

        $user   = auth()->user();
        $scoped = $user !== null && ! $user->bypassesDataScoping();
        $level  = $scoped ? $user->dataScopingLevel() : 'bypass';
        $ownBidangId = $scoped && $user->bidang_id !== null ? (int) $user->bidang_id : null;

        $bidangId = $this->normalizeIdInput($validated['bidang_id'] ?? null);

        // Update yang tidak mengirim field target sama sekali → pertahankan
        // target tersimpan (pola fallback nilai lama).
        if ($bidangId === null && $existing !== null
            && ! array_key_exists('bidang_id', $validated)
            && ! array_key_exists('department', $validated)
            && ! array_key_exists('sub_department', $validated)) {
            $bidangId = $existing->bidang_id !== null ? (int) $existing->bidang_id : null;
        }

        // Kompatibilitas data/API lama: petakan kode legacy ke baris master.
        if ($bidangId === null) {
            $bidangId = $this->bidangIdFromLegacyCodes(
                $validated['department'] ?? $existing?->department,
                $validated['sub_department'] ?? $existing?->sub_department
            );
        }

        if ($scoped && $ownBidangId !== null) {
            $allowed = $this->allowedBidangIds($user, $ownBidangId);

            if ($bidangId === null || ! in_array($bidangId, $allowed, true)) {
                $bidangId = $ownBidangId;
            }
        }

        $bidang = $bidangId !== null ? Bidang::query()->find($bidangId) : null;

        // Akun legacy ter-scope TANPA pengikatan master (users.bidang_id
        // kosong): bidang kiriman hanya boleh yang ber-kode bidangnya.
        // Selain itu jatuh ke fallback kode legacy yang memaksa bidangnya.
        $boundDepartment = $this->scopedDepartment();

        if ($scoped && $ownBidangId === null && $boundDepartment !== null
            && $bidang !== null && $bidang->departmentCode() !== $boundDepartment) {
            $bidang   = null;
            $bidangId = null;
        }

        if ($bidang !== null) {
            // Jabatan target harus benar-benar berelasi dengan Bidang yang
            // dipilih ("Master Jabatan → Bidang yang dipilih"). Bila tidak,
            // link tetap aman menjadi target level Bidang.
            $jabatan = $jabatanId !== null ? Jabatan::query()->find($jabatanId) : null;
            $finalJabatanId = null;

            if ($jabatan !== null && (int) $jabatan->bidang_id === (int) $bidang->id) {
                $finalJabatanId = (int) $jabatan->id;
            } elseif (! $hasJabatanField && $existing?->jabatan_id !== null
                && (int) $existing->bidang_id === (int) $bidang->id) {
                // Update yang tidak mengirim field Sub-Bidang sama sekali →
                // pertahankan jabatan tersimpan.
                $finalJabatanId = (int) $existing->jabatan_id;
            }

            return array_merge($validated, [
                'bidang_id'      => (int) $bidang->id,
                'jabatan_id'     => $finalJabatanId,
                'department'     => $bidang->departmentCode(),
                'sub_department' => $bidang->subDepartmentCode(),
            ]);
        }

        // === Fallback kode legacy (master bidang kosong / akun legacy) ===
        $department = $validated['department'] ?? $existing?->department;

        if ($scoped) {
            $department = $this->scopedDepartment() ?? $department;
        }

        if ($department === null || ! isset(User::DEPARTMENTS[$department])) {
            // Khusus tanpa bidang yang valid → anggap kembali umum.
            return array_merge($validated, [
                'category'       => WorkLink::CATEGORY_UMUM,
                'bidang_id'      => null,
                'jabatan_id'     => null,
                'department'     => null,
                'sub_department' => null,
            ]);
        }

        $sub = $level === 'bidang_sub'
            ? $user->subBidangId()
            : ($validated['sub_department'] ?? $existing?->sub_department);

        $subs     = User::SUB_DEPARTMENTS[$department] ?? [];
        $validSub = $sub !== null && $sub !== '' && isset($subs[$sub]);
        $finalSub = $validSub ? $sub : null;

        // Lengkapi relasi Bidang bila master tersedia — kode legacy dan
        // bidang_id selalu sepasang agar konsisten saat data dibuat/diedit.
        $resolvedBidangId = $this->bidangIdFromLegacyCodes($department, $finalSub);

        return array_merge($validated, [
            'bidang_id'      => $resolvedBidangId,
            'jabatan_id'     => null,
            'department'     => $department,
            'sub_department' => $finalSub,
        ]);
    }

    /**
     * ID baris Master Bidang yang boleh dipilih akun ter-scope:
     * akun terkunci sub-bidang → barisnya saja; level bidang → barisnya
     * beserta seluruh sub-bidang turunannya.
     *
     * @return array<int, int>
     */
    private function allowedBidangIds(User $user, int $ownBidangId): array
    {
        if ($user->dataScopingLevel() === 'bidang_sub') {
            return [$ownBidangId];
        }

        $own = Bidang::query()->find($ownBidangId);

        return array_values(array_unique(array_merge(
            [$ownBidangId],
            $own?->descendantIds() ?? []
        )));
    }

    /**
     * Cari baris Master Bidang yang cocok dengan kode legacy
     * (department + sub_department). Prioritas bidang induk bila link
     * tidak menargetkan sub-bidang.
     */
    private function bidangIdFromLegacyCodes(?string $department, ?string $sub): ?int
    {
        if ($department === null || $department === '') {
            return null;
        }

        $query = Bidang::query()->where('department_code', $department);

        if ($sub !== null && $sub !== '') {
            $query->where('sub_department_code', $sub);
        } else {
            $query->whereNull('sub_department_code');
        }

        $id = (clone $query)->whereNull('parent_id')->orderBy('id')->value('id')
            ?? (clone $query)->orderBy('id')->value('id');

        return $id !== null ? (int) $id : null;
    }

    /**
     * Rapikan input ID (string form / integer / null) menjadi ?int.
     */
    private function normalizeIdInput(mixed $value): ?int
    {
        if ($value === null || $value === '') {
            return null;
        }

        return is_numeric($value) ? (int) $value : null;
    }
}
