<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\ScopesToDepartment;
use App\Http\Controllers\Controller;
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
 * - 'khusus' → tampil sesuai Bidang Utama (+ Sub-Bidang bila dipilih).
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
        $query = WorkLink::query();

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

        return view('admin.work_links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.work_links.form', $this->formContext(null));
    }

    public function store(Request $request)
    {
        $validated = $this->validatePayload($request);

        // Admin Bidang: department dipaksa ke bidangnya — input form diabaikan.
        // Akun terkunci sub-bidang: sub-bidang juga dipaksa ke unit kerjanya.
        $validated['department'] = $this->forcedDepartmentForCreate($validated['department'] ?? null);
        $validated['sub_department'] = $this->forcedSubDepartmentForCreate($validated['sub_department'] ?? null);

        $validated = $this->normalizeTargets($validated);

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

        $validated = $this->normalizeTargets($validated);

        // Admin Bidang tidak boleh memindahkan data ke bidang lain.
        $validated['department'] = $this->forcedDepartmentForCreate($validated['department'] ?? null) ?? $work_link->department;

        // Akun terkunci sub-bidang: sub-bidang dipaksa ke unit kerjanya
        // (anti manipulasi — tidak bisa memindah data ke sub lain).
        $validated['sub_department'] = $this->forcedSubDepartmentForCreate($validated['sub_department'] ?? null) ?? $work_link->sub_department;

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
     * Konteks view form create/edit: daftar bidang & sub-bidang,
     * plus flag kunci untuk Admin Bidang (Bidang Utama terisi otomatis
     * dan read-only sesuai bidang admin yang login).
     */
    private function formContext(?WorkLink $link): array
    {
        $bound = $this->scopedDepartment();

        $departments = $bound !== null
            ? array_intersect_key(User::DEPARTMENTS, [$bound => true])
            : User::DEPARTMENTS;

        $subDepartments = $bound !== null
            ? array_intersect_key(User::SUB_DEPARTMENTS, [$bound => true])
            : User::SUB_DEPARTMENTS;

        return [
            'link'            => $link,
            'departments'     => $departments,
            'subDepartments'  => $subDepartments,
            'lockedDepartment' => $bound,
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
            'department'  => ['nullable', 'in:' . $departments],
            'sub_department' => ['nullable', 'in:' . implode(',', array_merge($subCodes, ['']))],
            'is_active'   => ['nullable', 'boolean'],
        ], [
            'title.required'   => 'Nama Link wajib diisi.',
            'url.required'     => 'URL Tujuan wajib diisi.',
            'category.required' => 'Kategori link wajib dipilih.',
            'category.in'      => 'Kategori link tidak valid.',
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
     * Rapikan target sesuai kategori:
     * - 'umum'   → department & sub_department dikosongkan.
     * - 'khusus' → department wajib; sub_department hanya boleh
     *              terisi bila termasuk dalam bidang yang dipilih.
     */
    private function normalizeTargets(array $validated): array
    {
        if (($validated['category'] ?? '') === WorkLink::CATEGORY_UMUM) {
            $validated['department']     = null;
            $validated['sub_department'] = null;

            return $validated;
        }

        $department = $validated['department'] ?? null;

        if ($department === null || ! isset(User::DEPARTMENTS[$department])) {
            // Khusus tanpa bidang yang valid → anggap kembali umum.
            $validated['category']       = WorkLink::CATEGORY_UMUM;
            $validated['department']     = null;
            $validated['sub_department'] = null;

            return $validated;
        }

        $subs   = User::SUB_DEPARTMENTS[$department] ?? [];
        $sub    = $validated['sub_department'] ?? null;
        $valid  = $sub !== null && $sub !== '' && isset($subs[$sub]);

        $validated['sub_department'] = $valid ? $sub : null;

        return $validated;
    }
}
