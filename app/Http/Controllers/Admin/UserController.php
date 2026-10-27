<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Department;
use App\Models\Jabatan;
use App\Models\MasterMenu;
use App\Models\Role;
use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        Gate::authorize('users.view');

        $users = User::with('role')->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Terapkan SCOPING ORGANISASI dari MASTER Bidang & Jabatan.
     *
     * Form Pengguna hanya menyimpan role_id + bidang_id + jabatan_id.
     * Filter data lama tetap membaca users.department / department_id /
     * sub_department / level_jabatan, jadi keempat nilai itu diturunkan
     * otomatis di sini:
     *
     * - department (+ department_id) → Bidang::departmentCode() (kode
     *   legacy bidang induk; sub-bidang mewarisi induknya).
     * - sub_department → Bidang::subDepartmentCode() (NULL bila baris
     *   yang dipilih adalah bidang induk / belum dipetakan).
     * - level_jabatan → User::levelJabatanFromJabatanName() untuk role
     *   Karyawan. Role lain (Admin Bidang, Super Admin, role buatan
     *   admin) TIDAK memperoleh level dari jabatan — mencegah eskalasi
     *   akses global (bypass data) lewat pemilihan jabatan.
     *
     * Senior Manager & Manager Bidang membawahi seluruh sub-bidang,
     * jadi sub_department dikosongkan agar scope memakai level bidang.
     *
     * Public static: dipakai juga oleh pendaftaran akun dari Data
     * Karyawan (DataKaryawanController) supaya aturan penurunan
     * bidang/sub-bidang/level TIDAK diduplikasi dan selalu konsisten
     * dengan form Pengguna.
     */
    public static function applyOrgScoping(array &$data, string $roleName): void
    {
        $bidangId  = self::normalizeIdInput($data['bidang_id'] ?? null);
        $jabatanId = self::normalizeIdInput($data['jabatan_id'] ?? null);

        $bidang  = $bidangId !== null ? Bidang::find($bidangId) : null;
        $jabatan = $jabatanId !== null ? Jabatan::find($jabatanId) : null;

        $departmentCode = $bidang?->departmentCode();
        $subCode        = $bidang?->subDepartmentCode();

        $level = $roleName === 'Karyawan'
            ? User::levelJabatanFromJabatanName($jabatan?->nama)
            : null;

        if (in_array($level, ['senior_manager', 'manager_bidang'], true)) {
            $subCode = null;
        }

        $data['department']     = $departmentCode;
        $data['department_id']  = $departmentCode !== null
            ? Department::byCode($departmentCode)?->id
            : null;
        $data['sub_department'] = $subCode;
        $data['level_jabatan']  = $level;
    }

    /**
     * Validasi & sinkronisasi DIRECT PERMISSION (matriks ID Menu × CRUD)
     * ke tabel user_has_permissions — HANYA untuk role delegasi (Karyawan
     * & Admin Bidang) sebagai hak ekstra di atas baseline role (semantik
     * Spatie: direct permission hanya menambah, tidak pernah memblokir
     * role). Checkbox di luar matriks diabaikan; role lain selalu kosong
     * agar hak akses 100% mengikuti role secara dinamis.
     */
    private function syncDirectPermissions(User $user, Request $request, string $roleName): void
    {
        // Cakupan direct permission:
        // - Admin Bidang → delegasi hak akses per bidang.
        // - KARYAWAN     → akses fitur per ORANG (mis. "Karyawan SDM"
        //                  diberi news.create, "Karyawan Sekuriti"
        //                  diberi tamu.view — role tetap "Karyawan").
        // Role lain (Super Admin / legacy) → bersihkan, tidak ada sisa.
        $directPermissionRoles = [User::DEPARTMENT_ADMIN_ROLE, 'Karyawan'];

        if (! in_array($roleName, $directPermissionRoles, true)) {
            $user->syncPermissions([]);

            return;
        }

        $submitted = array_map('intval', (array) $request->input('permissions', []));

        // Intersect dengan permission matriks — ID injected di luar
        // matriks (mis. roles.assign_permission) ditolak.
        $matrixIds = \App\Models\Permission::whereIn('name', MasterMenu::matrixPermissionNames())
            ->pluck('id')
            ->all();

        $user->syncPermissions(array_values(array_intersect($submitted, $matrixIds)));

        // REAL-TIME RBAC — perubahan direct permission berlaku detik ini
        // juga (flush cache registrasi gate permission).
        \App\Providers\AuthServiceProvider::flushPermissionGateCache();
    }
    /**
     * Daftar MASTER Bidang untuk dropdown form Pengguna — urut nama
     * (pilihan murni dari tabel bidangs, bukan dari konstanta RBAC
     * User::DEPARTMENTS yang tetap dipakai untuk scoping data).
     */
    private static function masterBidangsForForm(): \Illuminate\Support\Collection
    {
        // Hanya bidang yang punya kode legacy (hasil pemetaan migrasi) yang
        // bisa dipakai sebagai unit kerja akun — baris unit induk (mis.
        // "PLTU INDRAMAYU") tanpa kode tidak boleh menghasilkan akun tanpa
        // pengikatan bidang (yang berarti melihat seluruh data).
        // Hasil filter jarang berubah — cache dengan key khusus;
        // invalidasi memakai FlushHook trait Bidang (CRUD Bidang).
        return \Illuminate\Support\Facades\Cache::remember(
            'master.user-form-bidangs',
            now()->addMinutes(10),
            fn () => Bidang::query()
                ->with('parent')
                ->orderBy('nama')
                ->get(['id', 'nama', 'parent_id', 'department_code', 'sub_department_code'])
                ->filter(fn (Bidang $bidang) => $bidang->hasLegacyScope())
                ->values()
        );
    }

    /**
     * Daftar MASTER Jabatan untuk dropdown form Pengguna — mengembalikan
     * [{id, nama, bidang_id}] urut nama. Field `bidang_id` dipakai JS
     * di form untuk dependent dropdown (jabatan mengikuti bidang yang
     * dipilih).
     */
    private static function masterJabatansForForm(): \Illuminate\Support\Collection
    {
        // Daftar master jarang berubah — cache (invalidated saat CRUD Jabatan).
        return Jabatan::cachedList();
    }

    /**
     * Role yang form-nya menampilkan (dan mewajibkan) dropdown MASTER
     * Bidang & Jabatan (tabel bidangs & jabatans).
     *
     * Catatan penting: Jabatan di sini adalah POSISI PEKERJAAN dari
     * master data organisasi — BUKAN role. Hak akses sistem tetap
     * sepenuhnya ditentukan oleh role_id (+ direct permission), tidak
     * pernah oleh jabatan maupun bidang.
     *
     * @return array<int, string>
     */
    private static function masterUnitRequiredRoles(): array
    {
        return [User::DEPARTMENT_ADMIN_ROLE, 'Karyawan'];
    }

    /**
     * Aturan validasi MASTER Bidang & Jabatan (fitur Tambah/Edit
     * Pengguna) — satu-satunya input organisasi pada form; level
     * jabatan, department, dan sub_department diturunkan otomatis
     * oleh applyOrgScoping():
     *
     * - bidang_id  → bila diisi harus merujuk baris di `bidangs`.
     * - jabatan_id → bila diisi WAJIB merujuk baris di `jabatans` DAN
     *                milik bidang yang dipilih (Rule exists dengan where
     *                bidang_id).
     *
     * Sifat WAJIB (role Karyawan & Admin Bidang wajib memilih bidang;
     * jabatan wajib bila bidangnya punya daftar jabatan) ditegakkan
     * terpisah oleh assertMasterUnitComplete() SETELAH nilai dinormalisasi
     * (fallback nilai tersimpan saat field tidak dikirim pada update) —
     * bukan lewat rule 'required', agar update tanpa kedua field tidak
     * salah-gagal validasi.
     *
     * @return array{0: array<string, mixed>, 1: array<string, string>}
     */
    private static function masterUnitRules(?int $bidangId): array
    {
        $rules = [
            'bidang_id' => ['nullable', 'integer', 'exists:bidangs,id'],
            'jabatan_id' => [
                'nullable',
                'integer',
                // Jabatan harus berada di bawah bidang terpilih; tanpa
                // bidang (null) mustahil cocok → otomatis ditolak.
                Rule::exists('jabatans', 'id')->where('bidang_id', $bidangId),
            ],
        ];

        return [
            $rules,
            [
                'bidang_id.integer'   => 'Bidang (master) tidak valid.',
                'bidang_id.exists'    => 'Bidang (master) tidak ditemukan — pilih dari daftar bidang yang tersedia.',
                'jabatan_id.integer'  => 'Jabatan tidak valid.',
                'jabatan_id.exists'   => 'Jabatan tidak valid — pilih jabatan yang berada di bidang yang dipilih.',
            ],
        ];
    }

    /**
     * Pengecekan KEWAJIBAN master bidang/jabatan — dijalankan SETELAH
     * nilai dinormalisasi (jadi field yang tidak dikirim sudah jatuh ke
     * nilai tersimpan / null yang konsisten):
     *
     * - Role Karyawan & Admin Bidang → bidang_id wajib diisi HANYA bila
     *   tabel master bidangs sudah terisi — lingkungan tanpa master data
     *   (install baru / belum di-seed) tetap bisa membuat akun.
     * - Bidang terpilih yang punya daftar jabatan di master →
     *   jabatan_id wajib terisi (bidang tanpa jabatan tidak memaksa).
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    private static function assertMasterUnitComplete(array $data, string $roleName): void
    {
        $bidangId  = self::normalizeIdInput($data['bidang_id'] ?? null);
        $jabatanId = self::normalizeIdInput($data['jabatan_id'] ?? null);

        if (in_array($roleName, self::masterUnitRequiredRoles(), true)
            && $bidangId === null
            && Bidang::query()->exists()) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'bidang_id' => 'Bidang (master) wajib dipilih untuk role ini.',
            ]);
        }

        if ($bidangId !== null
            && $jabatanId === null
            && Jabatan::query()->where('bidang_id', $bidangId)->exists()) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'jabatan_id' => 'Jabatan wajib dipilih — bidang yang dipilih memiliki daftar jabatan.',
            ]);
        }
    }

    /**
     * Rapikan input ID (string form / integer / null) menjadi ?int untuk
     * dipakai dalam Rule exists (null bila kosong/tidak valid).
     */
    private static function normalizeIdInput(mixed $value): ?int
    {
        if ($value === null || $value === '') {
            return null;
        }

        return is_numeric($value) ? (int) $value : null;
    }

    /**
     * Rapikan nilai MASTER Bidang & Jabatan sebelum disimpan:
     * - Super Admin → keduanya dipaksa null (field disembunyikan di form,
     *   nilai kiriman via API diabaikan) — sama seperti hirarki RBAC.
     * - Update dengan field TIDAK dikirim → nilai tersimpan dipertahankan
     *   (kecuali bidang berubah tanpa jabatan ikut dikirim → jabatan
     *   dikosongkan agar tidak menyimpan pasangan tidak konsisten).
     * - Bidang kosong → jabatan ikut dikosongkan (jabatan selalu terikat
     *   satu bidang; konsistensi referensi dijaga server-side).
     * Kedua key dijamin selalu ada (field nullable boleh absen).
     */
    private static function normalizeMasterUnit(array &$data, string $roleName, ?User $current = null): void
    {
        if ($roleName === User::SUPER_ADMIN_ROLE) {
            $data['bidang_id']  = null;
            $data['jabatan_id'] = null;

            return;
        }

        if ($current !== null) {
            $bidangProvided = array_key_exists('bidang_id', $data);

            if (! $bidangProvided) {
                $data['bidang_id'] = $current->bidang_id;
            }

            if (! array_key_exists('jabatan_id', $data)) {
                // Jabatan lama hanya dipertahankan bila bidangnya ikut
                // dipertahankan — kalau bidang berubah, pasangan lama
                // tidak lagi valid.
                $data['jabatan_id'] = ($bidangProvided
                    && (int) $data['bidang_id'] !== (int) $current->bidang_id)
                    ? null
                    : $current->jabatan_id;
            }
        }

        $data['bidang_id']  = $data['bidang_id'] ?? null;
        $data['jabatan_id'] = $data['jabatan_id'] ?? null;

        if ($data['bidang_id'] === null) {
            $data['jabatan_id'] = null;
        }
    }

    /**
     * Aturan payload bersama store() & update(). Password opsional
     * pada update (kosong = tidak diganti).
     */
    private function validationRules(bool $isCreate, ?int $userId = null): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email' . ($isCreate ? '' : ',' . $userId),
            'password' => $isCreate ? 'required|min:8|confirmed' : 'nullable|min:8|confirmed',
            'role_id'  => 'required|integer|exists:roles,id',
            'no_hp'    => 'required|string|max:20',
            'alamat'   => 'required|string|max:500',
        ];
    }

    public function create()
    {
        Gate::authorize('users.create');

        // Dropdown "Role Pengguna" menampilkan SELURUH role aktif.
        // Role yang dibuat admin (di luar 3 role dasar) juga tersedia
        // untuk diberikan ke user. Urutan: role dasar di depan,
        // role buatan admin di belakang (sesuai nama).
        $baseRoles = Role::where('status', true)
            ->whereIn('name', User::ASSIGNABLE_ROLE_NAMES)
            ->get()
            ->sortBy(fn (Role $role) => array_search($role->name, User::ASSIGNABLE_ROLE_NAMES))
            ->values();

        // Role legacy ("Administrator") tidak ditawarkan lagi — akun lama
        // tetap dikenali sistem, tetapi tidak dapat dipilih/diberikan.
        $otherRoles = Role::where('status', true)
            ->whereNotIn('name', array_merge(User::ASSIGNABLE_ROLE_NAMES, User::LEGACY_ROLE_NAMES))
            ->get()
            ->sortBy('name')
            ->values();

        $roles = $baseRoles->merge($otherRoles);

        return view('admin.users.create', [
            'roles'      => $roles,
            'menuMatrix' => MasterMenu::matrixForRoleForm(),
            'bidangs'    => self::masterBidangsForForm(),
            'jabatans'   => self::masterJabatansForForm(),
        ]);
    }

    public function store(Request $request)
    {
        Gate::authorize('users.create');

        $role     = Role::find($request->input('role_id'));
        $roleName = $role?->name ?? '';

        [$masterUnitRules, $masterUnitAttributes] = self::masterUnitRules(
            self::normalizeIdInput($request->input('bidang_id'))
        );

        // Form hanya mengirim role + Master Bidang + Master Jabatan;
        // level/department/sub-bidang diturunkan otomatis (applyOrgScoping).
        $validated = $request->validate(
            array_merge($this->validationRules(true), $masterUnitRules),
            $masterUnitAttributes
        );

        $role = Role::findOrFail($validated['role_id']);

        // Role legacy (mis. "Administrator") tidak boleh diberikan lagi.
        if (in_array($role->name, User::LEGACY_ROLE_NAMES, true)) {
            return back()->withErrors([
                'role_id' => 'Role tersebut sudah tidak dapat dipilih — gunakan Super Admin.',
            ])->withInput();
        }

        // Validasi: role yang dipilih harus aktif.
        // Semua role (termasuk role buatan admin) boleh dipilih.
        if (! $role->status) {
            return back()->withErrors(['role_id' => 'Role yang dipilih sedang dinonaktifkan.'])->withInput();
        }

        // REVISI — binding kuota Super Admin: maksimal 3 akun di database.
        if ($role->name === User::SUPER_ADMIN_ROLE
            && User::superAdminAccountCount() >= User::MAX_SUPER_ADMIN_ACCOUNTS) {
            return back()->withErrors([
                'role_id' => 'Gagal: Jumlah akun Super Admin sudah mencapai batas maksimal (3 akun).',
            ])->withInput();
        }

        self::normalizeMasterUnit($validated, $role->name);
        self::assertMasterUnitComplete($validated, $role->name);
        self::applyOrgScoping($validated, $role->name);

        // REVISI — kuota Level Jabatan "Senior Manager" (role Karyawan):
        // maksimal 3 akun AKTIF di database. Level kini diturunkan dari
        // nama Master Jabatan, bukan dipilih manual di form.
        if ($role->name === 'Karyawan'
            && ($validated['level_jabatan'] ?? null) === 'senior_manager'
            && User::seniorManagerAccountCount() >= User::MAX_SENIOR_MANAGER_ACCOUNTS) {
            return back()->withErrors([
                'jabatan_id' => 'Gagal: Jumlah akun Senior Manager sudah mencapai batas maksimal (3 akun).',
            ])->withInput();
        }

        $validated['password'] = bcrypt($validated['password']);
        $validated['role_id']  = $role->id;
        $validated['role']     = $role->name;

        $user = User::create($validated);

        // Sinkronkan pivot role_user agar sistem permission (@can, middleware
        // permission:) mengenali role user ini, bukan hanya kolom users.role_id.
        $user->roles()->sync([$role->id]);

        // DIRECT PERMISSION — sinkronkan matriks hak akses per akun
        // (Admin Bidang & Karyawan) ke tabel user_has_permissions.
        $this->syncDirectPermissions($user, $request, $role->name);

        ActivityLogger::log('create', null, [
            'module'      => 'pengguna',
            'description' => "menambahkan akun pengguna \"{$user->name}\" ({$user->email})",
            'subject'     => $user,
        ]);

        // Selalu kembali ke Daftar Pengguna dengan notifikasi sukses.
        return redirect()->route('admin.users.index')->with('success', 'Pengguna baru berhasil ditambahkan!');
    }

    public function show(User $user)
    {
        // Data kepegawaian (tabel employee_profiles) ikut dimuat agar
        /// halaman Detail Pengguna langsung menyajikan profil lengkap.
        $user->load(['role', 'employeeProfile']);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Edit Pengguna — bentuk form sama dengan Tambah; Direct Permission
     * tercentang mengikuti hak akses aktif milik user (spec poin 2).
     */
    public function edit(User $user)
    {
        $actor = auth()->user();

        // Cek izin edit:
        // - Super Admin / Admin utama = akses penuh.
        // - Role lain hanya boleh edit profil milik sendiri.
        $roleRaw = ($actor && $actor->role) ? trim((string) $actor->role) : '';
        $roleName = strtolower($roleRaw);
        $isSuperUser = ($roleName === 'super admin' || $roleName === 'admin' || ($actor->role_id ?? null) == 1);

        if ($user->id === $actor?->id) {
            // Pemilik akun tetap bisa edit profil sendiri.
            Gate::authorize('users.edit:self');
        } elseif ($isSuperUser) {
            // Super Admin / Admin utama boleh edit semua.
            Gate::authorize('users.edit:self');
        } else {
            abort(403, 'Anda tidak memiliki akses untuk mengedit pengguna ini.');
        }

        // Dropdown "Role Pengguna" menampilkan SELURUH role aktif.
        // Role yang dibuat admin (di luar 3 role dasar) juga tersedia.
        $baseRoles = Role::where('status', true)
            ->whereIn('name', User::ASSIGNABLE_ROLE_NAMES)
            ->get()
            ->sortBy(fn (Role $role) => array_search($role->name, User::ASSIGNABLE_ROLE_NAMES))
            ->values();

        $otherRoles = Role::where('status', true)
            ->whereNotIn('name', array_merge(User::ASSIGNABLE_ROLE_NAMES, User::LEGACY_ROLE_NAMES))
            ->get()
            ->sortBy('name')
            ->values();

        $roles = $baseRoles->merge($otherRoles);

        return view('admin.users.edit', [
            'user'              => $user,
            'roles'             => $roles,
            'menuMatrix'        => MasterMenu::matrixForRoleForm(),
            'userPermissionIds' => $user->directPermissionIds(),
            'bidangs'           => self::masterBidangsForForm(),
            'jabatans'          => self::masterJabatansForForm(),
        ]);
    }

    /**
     * Update Pengguna — simpan data bidang/sub-bidang ke tabel users
     * DAN sinkronisasi direct permission (user_has_permissions) ke ID
     * User tersebut (spec poin 2: "Saat Form Disimpan").
     */
    public function update(Request $request, User $user)
    {
        $actor = auth()->user();

        // Cek izin update:
        // - Super Admin / Admin utama = akses penuh.
        // - Role lain hanya boleh update profil milik sendiri.
        $roleRaw = ($actor && $actor->role) ? trim((string) $actor->role) : '';
        $roleName = strtolower($roleRaw);
        $isSuperUser = ($roleName === 'super admin' || $roleName === 'admin' || ($actor->role_id ?? null) == 1);

        if ($user->id === $actor?->id) {
            Gate::authorize('users.edit:self');
        } elseif ($isSuperUser) {
            Gate::authorize('users.edit:self');
        } else {
            abort(403, 'Anda tidak memiliki akses untuk mengedit pengguna ini.');
        }

        $actor      = auth()->user();
        $roleNameRaw = ($actor && $actor->role) ? trim((string) $actor->role) : '';
        $actorRoleName = strtolower($roleNameRaw);
        $actorIsSuperUser = ($actorRoleName === 'super admin' || $actorRoleName === 'admin' || ($actor->role_id ?? null) == 1);

        // Batasan update:
        // - Jika yang update BUKAN Super Admin / Admin utama:
        //   role_id, level_jabatan, department, sub_department, dan
        //   permissions TIDAK PERNAH boleh diubah, meski dikirim dari
        //   frontend (mencegah manipulasi via Inspect Element / API).
        $actorMayChangeRole = $actorIsSuperUser;

        $requestedRoleId = (int) ($request->input('role_id', 0) ?: 0);
        $requestedRole = null;

        if ($actorMayChangeRole && $requestedRoleId > 0) {
            $requestedRole = Role::find($requestedRoleId);
        }

        // Jika tidak diizinkan ubah role, paksa role tetap role lama.
        if (! $actorMayChangeRole) {
            $requestedRole = $user->role ? Role::find($user->role_id) : null;
        }

        $role = $requestedRole;
        $roleName = $role?->name ?? (($actorMayChangeRole && $requestedRoleId > 0) ? '' : $user->role);

        // MASTER BIDANG & JABATAN — satu-satunya input organisasi pada
        // form lengkap; untuk self-edit non-super (form compact)
        // nilai lama dipertahankan.
        [$masterUnitRules, $masterUnitAttributes] = self::masterUnitRules(
            self::normalizeIdInput($request->input('bidang_id'))
        );

        $rules = array_merge($this->validationRules(false, $user->id), $masterUnitRules);

        // Jika bukan Super Admin / Admin utama, role_id tidak wajib
        // dikirim dan role lama dipaksa tetap ada.
        if (! $actorMayChangeRole) {
            $rules['role_id'] = 'sometimes|integer|exists:roles,id';
        }

        $validated = $request->validate($rules, $masterUnitAttributes);

        // Jika actor tidak punya hak ubah role, force role & unit lama.
        if (! $actorMayChangeRole) {
            $validated['role_id']        = $user->role_id;
            $validated['role']           = $user->role;
            $validated['department']     = $user->department;
            $validated['department_id']  = $user->department_id;
            $validated['sub_department'] = $user->sub_department;
            $validated['level_jabatan']  = $user->level_jabatan;
            $validated['bidang_id']      = $user->bidang_id;
            $validated['jabatan_id']     = $user->jabatan_id;
        } else {
            // Scoping diturunkan dari MASTER Bidang & Jabatan.
            self::normalizeMasterUnit($validated, $roleName, $user);
            self::assertMasterUnitComplete($validated, $roleName);
            self::applyOrgScoping($validated, $roleName);
        }

        // Validasi: role yang dipilih harus aktif.
        // Dipakai HANYA bila actor diizinkan mengubah role.
        if ($actorMayChangeRole) {
            if (in_array($role->name, User::LEGACY_ROLE_NAMES, true)) {
                return back()->withErrors([
                    'role_id' => 'Role tersebut sudah tidak dapat dipilih — gunakan Super Admin.',
                ])->withInput();
            }

            if (! $role->status) {
                return back()->withErrors(['role_id' => 'Role yang dipilih sedang dinonaktifkan.'])->withInput();
            }

            // Kuota Super Admin: akun yang DIJADIKAN Super Admin dihitung
            // (akun Super Admin existing tidak menggandakan slot-nya sendiri).
            if ($role->name === User::SUPER_ADMIN_ROLE
                && ! $user->isSuperAdmin()
                && User::superAdminAccountCount() >= User::MAX_SUPER_ADMIN_ACCOUNTS) {
                return back()->withErrors([
                    'role_id' => 'Gagal: Jumlah akun Super Admin sudah mencapai batas maksimal (3 akun).',
                ])->withInput();
            }

            // Kuota Senior Manager: sama — yang sudah Senior Manager tidak
            // menggandakan slot kuotanya sendiri.
            if ($role->name === 'Karyawan'
                && ($validated['level_jabatan'] ?? '') === 'senior_manager'
                && $user->level_jabatan !== 'senior_manager'
                && User::seniorManagerAccountCount() >= User::MAX_SENIOR_MANAGER_ACCOUNTS) {
                return back()->withErrors([
                    'jabatan_id' => 'Gagal: Jumlah akun Senior Manager sudah mencapai batas maksimal (3 akun).',
                ])->withInput();
            }
        } else {
            // Actor tidak diizinkan ubah role; pastikan role tetap aktif.
            if ($role && ! $role->status) {
                return back()->withErrors(['role_id' => 'Role akun ini saat ini tidak aktif. Kontak Super Admin.'])->withInput();
            }
        }

        // Password kosong (update) → tidak diganti.
        if (($validated['password'] ?? '') !== '') {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['role_id'] = $role->id;
        $validated['role']    = $role->name;

        $user->update($validated);

        // Pastikan pivot role_user mengikuti perubahan role.
        $user->roles()->sync([$role->id]);

        // DIRECT PERMISSION — sinkronkan matriks hak akses per akun.
        // Hanya Super Admin / Admin utama yang boleh ubah direct permission.
        if ($actorMayChangeRole) {
            $this->syncDirectPermissions($user, $request, $role->name);
        } else {
            // Pemilik biasa / Admin Bidang self-edit tidak boleh ubah hak akses.
            // Pastikan tetap sinkron pada hak akses yang sudah ada.
            $this->syncDirectPermissions($user, $request, $user->role);
        }

        ActivityLogger::log('update', null, [
            'module'      => 'pengguna',
            'description' => "memperbarui akun pengguna \"{$user->name}\" ({$user->email})",
            'subject'     => $user,
        ]);

        $message = 'Data pengguna berhasil diperbarui.';

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => $message]);
        }

        return redirect()->route('admin.users.index')->with('success', $message);
    }

    /**
     * Toggle status akun pengguna (Aktif ⇄ Nonaktif) — shortcut cepat
     * dari Daftar Pengguna. Status dipetakan ke kolom email_verified_at:
     * mengaktifkan = verifikasi email; menonaktifkan = batalkan verifikasi.
     *
     * Menerima fetch AJAX (JSON) maupun submit form biasa (redirect).
     */
    public function toggleStatus(Request $request, User $user)
    {
        // Cegah admin menonaktifkan akunnya sendiri (mencegah terkunci sendiri).
        if ($user->id === $request->user()?->id) {
            $message = 'Anda tidak dapat menonaktifkan akun Anda sendiri.';

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $message], 422);
            }

            return redirect()->route('admin.users.index')->with('error', $message);
        }

        $newStatus = ! $user->email_verified_at;
        $user->update(['email_verified_at' => $newStatus ? now() : null]);

        ActivityLogger::log('update', null, [
            'module'      => 'pengguna',
            'description' => ($newStatus ? 'mengaktifkan' : 'menonaktifkan') . " akun pengguna \"{$user->name}\" ({$user->email})",
            'subject'     => $user,
        ]);

        $message = 'Status pengguna berhasil diperbarui.';

        // AJAX (fetch): balas JSON agar UI menampilkan Toast Notification.
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'status'  => $newStatus ? 'Aktif' : 'Nonaktif',
            ]);
        }

        // Fallback form biasa: kembali ke Daftar Pengguna dengan flash message.
        return redirect()->route('admin.users.index')->with('success', $message);
    }

    /**
     * Reset password akun oleh admin → password sementara sekali pakai.
     *
     * Alur:
     * 1. Sistem membuat password sementara otomatis & acak (12 karakter
     *    alfanumerik, CSPRNG) — tidak dikirim email; admin menyampaikannya
     *    langsung ke user (WA/lisan). Password ditampilkan SEKALI di modal
     *    setelah reset, dengan tombol copy.
     * 2. Akun ditandai must_change_password = true sehingga saat login
     *    user WAJIB mengganti password dulu (middleware must.password).
     * 3. Semua sesi login lama user tersebut di-invalidate.
     *
     * Keamanan: password sementara TIDAK pernah disimpan plaintext di
     * database (cast 'hashed'), TIDAK dicatat di activity log, dan TIDAK
     * ditampilkan pada daftar user — hanya pada response reset ini.
     *
     * Guard keamanan: Super Admin saja tidak boleh me-reset akun
     * Administrator lain (mencegah eskalasi/penurunan hak); admin juga
     * tidak dapat me-reset akunnya sendiri (pakai fitur ganti password).
     * Menerima fetch AJAX (JSON) maupun submit form biasa (redirect).
     */
    public function resetPassword(Request $request, User $user)
    {
        $actor = $request->user();

        $failMessage = null;

        if ($user->id === $actor?->id) {
            $failMessage = 'Anda tidak dapat me-reset password akun Anda sendiri. Gunakan fitur ganti password di profil.';
        } elseif ($actor?->isSuperAdmin() && ! $actor->isDepartmentAdmin()
            && $user->roleNames()->contains(fn ($n) => in_array($n, [User::SUPER_ADMIN_ROLE, 'Administrator'], true))) {
            $failMessage = 'Password akun Administrator lain hanya dapat direset melalui mekanisme Lupa Password (OTP email).';
        }

        if ($failMessage !== null) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $failMessage], 422);
            }

            return redirect()->route('admin.users.index')->with('error', $failMessage);
        }

        // Password sementara dibuat SISTEM — acak & aman (Str::random
        // memakai CSPRNG, alfabet A-Z a-z 0-9), 10 karakter: cukup kuat
        // namun tetap praktis disampaikan via WhatsApp/lisan.
        $plainPassword = \Illuminate\Support\Str::random(10);

        // Simpan TERENKRIPSI (bcrypt via Hash::make) — plaintext tidak
        // pernah masuk database. Cast 'hashed' pada model User
        // mempertahankan hash ini (tidak di-hash dua kali).
        $user->forceFill([
            'password'             => \Illuminate\Support\Facades\Hash::make($plainPassword),
            'must_change_password' => true,
            'remember_token'       => \Illuminate\Support\Str::random(60),
        ])->save();

        // Invalidate seluruh sesi login lama target: hapus baris di tabel
        // `sessions` milik user terkait. Session driver database (lihat
        // config/session.php) memvalidasi setiap request terhadap baris ini;
        // tanpa baris, middleware Authenticate akan memaksa login ulang.
        \Illuminate\Support\Facades\DB::table('sessions')
            ->where('user_id', $user->id)
            ->delete();

        ActivityLogger::log('reset_password', $actor, [
            'module'      => 'pengguna',
            'description' => "me-reset password akun \"{$user->name}\" ({$user->email}) — password sementara acak dibuat oleh sistem",
            'subject'     => $user,
        ]);

        $message = "Password akun \"{$user->name}\" berhasil direset. "
            . 'Sampaikan password sementara tersebut kepada pengguna; saat login ia akan diminta mengganti password.';

        if ($request->expectsJson()) {
            // temporary_password dikembalikan HANYA di sini agar admin dapat
            // menyalin & menyampaikannya; tidak pernah tersimpan / dilog.
            return response()->json([
                'success'            => true,
                'message'            => $message,
                'temporary_password' => $plainPassword,
            ]);
        }

        // Submit form biasa (tanpa JS): kembali ke halaman Detail Pengguna
        // dan bawa password sementara (PLAINTEXT — hanya untuk ditampilkan
        // SEKALI di modal hasil reset) lewat session flash; view langsung
        // membuka modal #successResetModal otomatis dari data flash ini.
        return redirect()->back()
            ->with('success_reset', 'Password berhasil direset')
            ->with('temporaryPassword', $plainPassword);
    }

    public function destroy(User $user)
    {
        ActivityLogger::log('delete', null, [
            'module'      => 'pengguna',
            'description' => "menghapus akun pengguna \"{$user->name}\" ({$user->email})",
            'subject'     => $user,
        ]);

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
