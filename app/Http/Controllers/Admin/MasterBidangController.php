<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Jabatan;
use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

/**
 * MASTER BIDANG — CRUD bidang berhirarki di panel admin.
 *
 * Otorisasi: middleware `permission:master_bidang.*` per aksi route
 * (permission terdaftar di PermissionSeeder — di luar matriks admin,
 * pola sama dengan `karyawan_data.*`; tidak ada sistem otorisasi baru).
 *
 * Validasi relasi (semua server-side):
 * - parent_id HANYA ke bidangs.id (Rule exists pada tabel bidangs).
 * - parent boleh NULL (bidang tingkat teratas).
 * - diri sendiri tidak boleh jadi parent; siklus multi-tingkat ditolak.
 * - penghapusan ditolak bila masih punya child, masih dipakai jabatan,
 *   atau masih dipakai data karyawan (kolom string karyawans.bidang —
 *   DIBACA saja, tidak pernah diubah).
 */
class MasterBidangController extends Controller
{
    /** Daftar tabel berjenjang: akar dulu, lalu child-nya (indent). */
    public function index()
    {
        $rows = Bidang::treeOrdered(Bidang::withCount('children'), ['parent']);

        return view('admin.master.bidang.index', [
            'rows'  => $rows,
            'total' => $rows->count(),
            'roots' => $rows->where('depth', 0)->count(),
        ]);
    }

    public function show(Bidang $bidang)
    {
        $children = $bidang->children()->orderBy('nama')->get();
        $jabatans = $bidang->jabatans()->orderBy('nama')->get();

        return view('admin.master.bidang.show', [
            'bidang'        => $bidang,
            'parent'        => $bidang->parent,
            'children'      => $children,
            'jabatans'      => $jabatans,
            'karyawanUsage' => $bidang->karyawanUsage(),
        ]);
    }

    public function create()
    {
        return view('admin.master.bidang.form', [
            'bidang'  => null,
            'parents' => Bidang::cachedTreeOrdered(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validatePayload($request);

        $bidang = Bidang::create($validated);

        ActivityLogger::log('create', null, [
            'module'      => 'master_bidang',
            'description' => "menambahkan bidang \"{$bidang->nama}\"",
            'subject'     => $bidang,
        ]);

        return redirect()->route('admin.master_bidang.index')
            ->with('success', 'Bidang berhasil ditambahkan.');
    }

    public function edit(Bidang $bidang)
    {
        // Opsi parent di form: kecualikan diri sendiri + seluruh
        // keturunan (supaya siklus tak bisa dipilih dari UI; server
        // tetap memvalidasi ulang).
        $excluded = array_merge([(int) $bidang->id], $bidang->descendantIds());
        $parents = Bidang::cachedTreeOrdered()
            ->reject(fn (array $row) => in_array((int) $row['node']->id, $excluded, true))
            ->values();

        return view('admin.master.bidang.form', compact('bidang', 'parents'));
    }

    public function update(Request $request, Bidang $bidang)
    {
        $validated = $this->validatePayload($request, $bidang);

        $bidang->update($validated);

        ActivityLogger::log('update', null, [
            'module'      => 'master_bidang',
            'description' => "mengubah bidang \"{$bidang->nama}\"",
            'subject'     => $bidang,
        ]);

        return redirect()->route('admin.master_bidang.index')
            ->with('success', 'Bidang berhasil diperbarui.');
    }

    public function destroy(Bidang $bidang)
    {
        // Proteksi hapus — pesan jelas, data tidak disentuh sama sekali.
        $childCount = $bidang->children()->count();

        if ($childCount > 0) {
            return redirect()->route('admin.master_bidang.index')->withErrors([
                'delete' => "Bidang \"{$bidang->nama}\" tidak dapat dihapus karena masih memiliki {$childCount} sub-bidang. "
                    . 'Pindahkan atau hapus sub-bidang tersebut terlebih dahulu.',
            ]);
        }

        $jabatanCount = $bidang->jabatans()->count();

        if ($jabatanCount > 0) {
            return redirect()->route('admin.master_bidang.index')->withErrors([
                'delete' => "Bidang \"{$bidang->nama}\" tidak dapat dihapus karena masih menjadi induk dari {$jabatanCount} jabatan. "
                    . 'Hapus atau pindahkan jabatan tersebut terlebih dahulu.',
            ]);
        }

        $karyawanUsage = $bidang->karyawanUsage();

        if ($karyawanUsage > 0) {
            return redirect()->route('admin.master_bidang.index')->withErrors([
                'delete' => "Bidang \"{$bidang->nama}\" tidak dapat dihapus karena masih digunakan oleh {$karyawanUsage} data karyawan. "
                    . 'Data karyawan tidak diubah otomatis — sesuaikan manual bila memang bidang sudah tidak berlaku.',
            ]);
        }

        // Akun pengguna (tabel users) yang terikat bidang ini lewat
        // users.bidang_id (form Tambah/Edit Pengguna) — relasi FK
        // restrictOnDelete juga melindungi di level database.
        $userUsage = $bidang->userUsage();

        if ($userUsage > 0) {
            return redirect()->route('admin.master_bidang.index')->withErrors([
                'delete' => "Bidang \"{$bidang->nama}\" tidak dapat dihapus karena masih digunakan oleh {$userUsage} akun pengguna. "
                    . 'Data akun tidak diubah otomatis — pindahkan atau longgarkan terikatan akun tersebut terlebih dahulu.',
            ]);
        }

        // Link Kerja yang menargetkan bidang ini (kolom work_links.bidang_id).
        // Menghapus bidang akan melepas target link — relasi harus tetap
        // konsisten, jadi penghapusan ditolak sampai link dipindahkan/
        // dihapus. FK restrictOnDelete juga menjaga di level database.
        $workLinkUsage = $bidang->workLinks()->count();

        if ($workLinkUsage > 0) {
            return redirect()->route('admin.master_bidang.index')->withErrors([
                'delete' => "Bidang \"{$bidang->nama}\" tidak dapat dihapus karena masih menjadi target {$workLinkUsage} Link Kerja. "
                    . 'Pindahkan atau hapus link tersebut terlebih dahulu.',
            ]);
        }

        $nama = $bidang->nama;
        $bidang->delete();

        ActivityLogger::log('delete', null, [
            'module'      => 'master_bidang',
            'description' => "menghapus bidang \"{$nama}\"",
        ]);

        return redirect()->route('admin.master_bidang.index')
            ->with('success', 'Bidang berhasil dihapus.');
    }

    /**
     * Aturan validasi bersama store() & update() — termasuk pengecekan
     * parent (diri sendiri & siklus hierarki) di sisi server.
     *
     * KODE LEGACY (opsional): jembatan antara baris Master Bidang dan
     * scoping data lama — dropdown Link Kerja / form Pengguna serta
     * visibilitas Portal Karyawan. Nilai kosong dinormalisasi jadi NULL
     * dan HANYA kode legacy yang sah (User::DEPARTMENTS /
     * User::SUB_DEPARTMENTS) yang diterima supaya tidak lahir kode yang
     * tidak pernah bisa dicocokkan.
     *
     * @return array{nama: string, parent_id: ?int, department_code?: ?string, sub_department_code?: ?string}
     */
    private function validatePayload(Request $request, ?Bidang $bidang = null): array
    {
        $departmentCodes = implode(',', array_keys(User::DEPARTMENTS));
        $subCodes        = implode(',', array_merge(...array_map('array_keys', array_values(User::SUB_DEPARTMENTS))));

        // Rapikan input dulu: pilihan kosong ('') → NULL SEBELUM validasi,
        // supaya aturan `in:` tidak menolak nilai kosong (kasus bila
        // middleware konversi string kosong tidak aktif). Field yang
        // TIDAK dikirim tidak disentuh — update tidak menimpa kode lama.
        foreach (['department_code', 'sub_department_code'] as $legacyField) {
            if ($request->has($legacyField)) {
                $request->merge([$legacyField => trim((string) $request->input($legacyField)) ?: null]);
            }
        }

        $validated = $request->validate([
            'nama'      => ['required', 'string', 'max:100'],
            'parent_id' => ['nullable', 'integer', 'exists:bidangs,id'],
            'department_code'     => ['nullable', 'string', 'max:50', 'in:' . $departmentCodes],
            'sub_department_code' => ['nullable', 'string', 'max:50', 'in:' . $subCodes],
        ], [
            'nama.required'      => 'Nama bidang wajib diisi.',
            'nama.max'           => 'Nama bidang maksimal 100 karakter.',
            'parent_id.integer'  => 'Parent bidang tidak valid.',
            'parent_id.exists'   => 'Parent bidang tidak ditemukan — pilih dari daftar bidang yang tersedia.',
            'department_code.in'     => 'Kode Bidang Utama tidak valid — pilih dari daftar kode legacy yang tersedia.',
            'sub_department_code.in' => 'Kode Sub-Bidang tidak valid — pilih dari daftar kode legacy yang tersedia.',
        ]);

        // Field nullable yang tidak dikirim bisa tidak ikut masuk $validated.
        $parentId = ! empty($validated['parent_id']) ? (int) $validated['parent_id'] : null;

        if ($bidang !== null && $bidang->createsCycle($parentId)) {
            throw ValidationException::withMessages([
                'parent_id' => $parentId === (int) $bidang->id
                    ? 'Tidak boleh memilih bidang itu sendiri sebagai parent.'
                    : 'Parent tidak valid — pilihan itu adalah keturunan dari bidang ini dan akan membentuk siklus hierarki.',
            ]);
        }

        $validated['parent_id'] = $parentId;

        return $validated;
    }

    /* ==========================================================
       FITUR "PETAKAN KODE LEGACY" — pemetaan massal via UI
       ------------------------------------------------------------
       Baris Master Bidang yang dibuat lewat form admin TIDAK punya
       `department_code` / `sub_department_code` (form lama tidak punya
       field itu, dan migrasi pemetaan hanya jalan sekali di awal).
       Akibatnya dropdown Link Kerja & form Pengguna menyaring baris
       itu keluar dan link khusus tidak terfilter ke akun karyawan.

       Dua endpoint di halaman daftar (pola "Petakan ke Master" Data
       Karyawan):
       - GET  → JSON pratinjau: berapa baris yang Akan diubah + daftar
         barisnya. TIDAK menulis apa pun.
       - POST → menerapkan rencana yang sama dalam SATU transaksi,
         mencatat aktivitas, lalu kembali dengan ringkasan.

       Aturan per baris (aman dijalankan berulang / idempoten):
       - Kode yang SUDAH ada tidak pernah ditimpa.
       - `department_code` hanya diisi bila baris tidak punya kode DAN
         tidak mewarisi dari induknya — pemetaan nama persis
         (Bidang::LEGACY_NAME_CODES) dulu, lalu pencocokan terhadap
         daftar kode legacy (hanya bila hasilnya TUNGGAL, tidak menebak).
       - `sub_department_code` hanya dari pemetaan nama persis dan hanya
         bila kode bidangnya (milik sendiri / warisan) sudah dikenal.
       - Baris yang tidak cocok TIDAK diubah — dilaporkan agar bisa
         diisi manual lewat form Edit Bidang.
       ========================================================== */

    /** Pratinjau pemetaan kode legacy — JSON, tanpa menulis data. */
    public function mapLegacyCodesPreview(): JsonResponse
    {
        Gate::authorize('master_bidang.edit');

        return response()->json($this->legacyCodeMappingPlan());
    }

    /** Terapkan pemetaan kode legacy — satu transaksi + log aktivitas. */
    public function mapLegacyCodes(): RedirectResponse
    {
        Gate::authorize('master_bidang.edit');

        $plan = $this->legacyCodeMappingPlan();

        if ($plan['updates'] !== []) {
            // Lewat MODEL (bukan query builder) supaya event `saved`
            // terpicu → cache daftar master (termasuk dropdown form
            // Pengguna `master.user-form-bidangs`) ikut terbuang.
            DB::transaction(function () use ($plan): void {
                foreach ($plan['updates'] as $id => $data) {
                    Bidang::query()->find($id)?->update($data);
                }
            });
        }

        ActivityLogger::log('update', null, [
            'module'      => 'master_bidang',
            'description' => "memetakan kode legacy master bidang ("
                . $plan['rows_updated'] . ' baris diperbarui, '
                . $plan['dept_filled'] . ' kode bidang & '
                . $plan['sub_filled'] . ' kode sub-bidang)',
        ]);

        if ($plan['rows_updated'] === 0) {
            $message = 'Tidak ada perubahan — semua kode legacy master bidang sudah terisi.';
        } else {
            $message = "Pemetaan kode legacy selesai: {$plan['rows_updated']} baris diperbarui ("
                . "{$plan['dept_filled']} kode bidang & {$plan['sub_filled']} kode sub-bidang terisi).";
        }

        if ($plan['no_code_total'] > 0) {
            $message .= " Masih ada {$plan['no_code_total']} baris tanpa kode bidang — "
                . 'isi manual lewat form Edit Bidang bila baris itu perlu jadi target link / unit akun.';
        }

        return redirect()->route('admin.master_bidang.index')
            ->with('success', $message)
            ->with('map_summary', [
                'rows'            => $plan['rows'],
                'rows_updated'    => $plan['rows_updated'],
                'dept_filled'     => $plan['dept_filled'],
                'sub_filled'      => $plan['sub_filled'],
                'already_coded'   => $plan['already_coded'],
                'inherited'       => $plan['inherited'],
                'root_no_code'    => $plan['root_no_code'],
                'no_code_total'   => $plan['no_code_total'],
            ]);
    }

    /**
     * Rencana pemetaan kode legacy — dihitung ulang tiap panggilan
     * (pratinjau maupun penerapan), sehingga preview dan hasil apply
     * tidak mungkin beda.
     *
     * @return array<string, mixed>
     */
    private function legacyCodeMappingPlan(): array
    {
        // treeOrdered = induk lebih dulu → kode induk tersedia saat
        // anaknya diproses (meniru cara Bidang::departmentCode()).
        $rows = Bidang::treeOrdered(Bidang::query()->with('parent'), ['parent']);

        $plan = [
            'rows'            => $rows->count(),
            'rows_updated'    => 0,
            'dept_filled'     => 0,
            'sub_filled'      => 0,
            'already_coded'   => 0,
            'inherited'       => 0,
            'root_no_code'    => 0,
            'no_code_total'   => 0,
            'no_code'         => [],
            'items'           => [],
            'updates'         => [],
        ];

        /** @var array<int, string|null> $effective Kode bidang efektif per id (usulan termasuk). */
        $effective = [];

        foreach ($rows as $row) {
            $bidang         = $row['node'];
            $parentEffective = $bidang->parent_id !== null ? ($effective[(int) $bidang->parent_id] ?? null) : null;
            $ownDept        = trim((string) $bidang->department_code) !== '' ? $bidang->department_code : null;
            $ownSub         = trim((string) $bidang->sub_department_code) !== '' ? $bidang->sub_department_code : null;
            $map            = Bidang::LEGACY_NAME_CODES[$bidang->nama] ?? null;

            $data = [];

            // 1) department_code — hanya bila baris butuh kode SENDIRI
            //    (tidak punya kode & tidak mewarisi dari induk).
            if ($ownDept === null && $parentEffective === null) {
                // Pemetaan nama menang (null = baris itu sengaja tanpa
                // kode, mis. induk umum); baru kemudian pencocokan nama.
                $guess = $map !== null
                    ? $map[0]
                    : $this->guessDepartmentCode((string) $bidang->nama);

                if ($guess !== null) {
                    $data['department_code'] = $guess;
                    $ownDept                 = $guess;
                }
            }

            $dept = $ownDept ?? $parentEffective;

            // 2) sub_department_code — hanya pemetaan nama persis & hanya
            //    bila kode bidangnya sudah dikenal (kata sandi pencocokan
            //    portal memakai pasangan department:sub_department).
            if ($ownSub === null && $map !== null && $map[1] !== null && $dept !== null) {
                $data['sub_department_code'] = $map[1];
                $ownSub                      = $map[1];
            }

            $effective[(int) $bidang->id] = $dept;

            if ($data !== []) {
                $plan['updates'][(int) $bidang->id] = $data;
                $plan['rows_updated']++;

                if (isset($data['department_code'])) {
                    $plan['dept_filled']++;
                }
                if (isset($data['sub_department_code'])) {
                    $plan['sub_filled']++;
                }

                if (count($plan['items']) < 15) {
                    $plan['items'][] = [
                        'nama'               => $bidang->nama,
                        'department_code'    => $data['department_code'] ?? null,
                        'sub_department_code' => $data['sub_department_code'] ?? null,
                    ];
                }
            } elseif ($ownDept !== null) {
                $plan['already_coded']++;
            } elseif ($dept !== null) {
                $plan['inherited']++;
            } elseif ($map !== null && $map[0] === null && $bidang->parent_id === null) {
                // Induk umum (mis. "PLTU INDRAMAYU") — sengaja tanpa kode,
                // bukan kegagalan pemetaan.
                $plan['root_no_code']++;
            } else {
                $plan['no_code_total']++;

                if (count($plan['no_code']) < 15) {
                    $plan['no_code'][] = $bidang->nama;
                }
            }
        }

        return $plan;
    }

    /**
     * Tebak `department_code` dari nama baris — HANYA bila hasilnya
     * TUNGGAL di antara kode legacy (User::DEPARTMENTS). Tidak pernah
     * menebak saat kosong maupun bermakna lebih dari satu; baris yang
     * gagal dilaporkan agar bisa diisi manual.
     */
    private function guessDepartmentCode(string $nama): ?string
    {
        $target = $this->normalizeLegacyName($nama);

        if ($target === '') {
            return null;
        }

        $candidates = [];

        foreach (User::DEPARTMENTS as $code => $label) {
            $candidates[(string) $code] = $this->normalizeLegacyName((string) $label);
        }

        // 1) Identik ("BIDANG LINGKUNGAN" → "lingkungan").
        $exact = array_keys(array_filter($candidates, fn (string $v): bool => $v === $target));

        if (count($exact) === 1) {
            return (string) $exact[0];
        }

        // 2) Salah satu mengandung yang lain ("K3" → "K3 & KAM").
        if (mb_strlen($target) >= 3) {
            $contains = array_keys(array_filter(
                $candidates,
                fn (string $v): bool => str_contains($v, $target) || str_contains($target, $v)
            ));

            if (count($contains) === 1) {
                return (string) $contains[0];
            }
        }

        // 3) Selisih ketikan kecil ("BUSINES SUPPORT" → "BUSINESS SUPPORT").
        if (mb_strlen($target) >= 5) {
            $close = [];

            foreach ($candidates as $code => $v) {
                $distance = levenshtein($target, $v);

                if ($distance !== false && $distance <= 2) {
                    $close[] = $code;
                }
            }

            if (count($close) === 1) {
                return (string) $close[0];
            }
        }

        return null;
    }

    /**
     * Normalisasi nama untuk pencocokan: huruf kecil, buang prefiks
     * berulang "sub"/"bidang", sisanya hanya alfanumerik + spasi.
     */
    private function normalizeLegacyName(string $value): string
    {
        $value = mb_strtolower(trim($value));
        $value = preg_replace('/^(?:sub\s+|bidang\s+)+/u', '', $value) ?? $value;
        $value = preg_replace('/[^a-z0-9]+/u', ' ', $value) ?? $value;

        return trim(preg_replace('/\s+/u', ' ', $value) ?? '');
    }
}
