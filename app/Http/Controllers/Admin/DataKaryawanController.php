<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\EmployeeProfile;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Role;
use App\Models\User;
use App\Services\ActivityLogger;
use App\Services\MasterOrgMatcher;
use App\Services\XlsxReader;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

/**
 * DATA KARYAWAN — CRUD + impor/ekspor CSV dari PANEL ADMIN.
 *
 * Otorisasi memakai RBAC yang sudah ada (permission karyawan_data.*,
 * terdaftar di PermissionSeeder): route dijaga middleware
 * `permission:` dan setiap aksi juga `Gate::authorize` (defense in
 * depth, pola sama dengan controller admin lain).
 *
 * Impor menerima CSV/TXT ATAU Excel (.xlsx) — keduanya dibaca tanpa
 * paket eksternal: CSV lewat fgetcsv, XLSX lewat service
 * `App\Services\XlsxReader` (parsing ZIP+XML native, tanpa ext-zip).
 * Header 24 kolom dipetakan lewat `mapHeaderRow()` yang DIPAKAI
 * BERSAMA kedua jalur. Ekspor tetap CSV (Excel membukanya langsung).
 * Seluruh kolom mengikuti 24 kolom spesifikasi di
 * Karyawan::COLUMNS_LABELS.
 *
 * RELASI MASTER BIDANG/JABATAN (opsional): kolom teks `BIDANG` dan
 * `JABATAN` tetap menjadi format impor/ekspor & sumber tampilan. Saat
 * impor, nama dicocokkan ke `bidangs`/`jabatans` lewat
 * MasterOrgMatcher dan hasilnya mengisi `bidang_id`/`jabatan_id` bila
 * AMAN (tepat satu kandidat, jabatan berada di bidang yang sama). Nama
 * yang tidak ditemukan/ambigu dibiarkan NULL tanpa membuat master baru
 * dan dilaporkan di ringkasan impor.
 */
class DataKaryawanController extends Controller
{
    /** Baris per halaman default (bisa diubah via ?per_page=50). */
    private const PER_PAGE = 25;

    private const PER_PAGE_OPTIONS = [25, 50, 100];

    /**
     * Filter daftar/ekspor yang masih berlaku — PENCARIAN TERBATAS:
     * NID/NAMA (parameter `q`) + BIDANG saja.
     *
     * Filter JABATAN, GRADE, GENDER, STATUS KAWIN, dan UNIT sudah
     * dihapus dari halaman ini; parameter lama yang dikirim lewat URL
     * diabaikan sepenuhnya sehingga tidak ada "parameter tersembunyi"
     * yang masih memengaruhi hasil (lihat filteredQuery()).
     *
     * @var array<int, string>
     */
    private const INDEX_FILTERS = ['bidang'];

    /* =========================================================
       DAFTAR — pencarian NID/NAMA + filter BIDANG, pagination
       ========================================================= */

    public function index(Request $request)
    {
        Gate::authorize('karyawan_data.view');

        $filters = $request->only(self::INDEX_FILTERS);

        $perPage = (int) $request->input('per_page', self::PER_PAGE);
        if (! in_array($perPage, self::PER_PAGE_OPTIONS, true)) {
            $perPage = self::PER_PAGE;
        }

        $karyawans = $this->filteredQuery($request)
            ->orderBy('nama')
            ->paginate($perPage)
            ->withQueryString();

        return view('admin.data-karyawan.index', [
            'karyawans' => $karyawans,
            'filters' => $filters,
            // Halaman daftar hanya punya pencarian NID/NAMA + BIDANG,
            // jadi hanya itu yang di-query (dropdown grade/gender/unit/
            // status kawin & master jabatan tidak lagi dimuat di sini).
            'master' => $this->masterFilterOptions(),
            'totalAll' => Karyawan::query()->count(),
            'perPage' => $perPage,
            'perPageOptions' => self::PER_PAGE_OPTIONS,
            'akunByKaryawanId' => $this->accountsFor($karyawans),
        ]);
    }

    /**
     * Peta akun pengguna untuk baris yang sedang tampil: [karyawan_id => User].
     *
     * Sumber relasi: tabel `employee_profiles` (user_id unik, karyawan_id
     * soft-link ke master HR). Cadangan: pencocokan NID untuk profil lama
     * yang sudah berisi NID tetapi belum sempat menautkan karyawan_id —
     * NID adalah identitas karyawan pada mekanisme relasi yang ada.
     *
     * @return array<int, User>
     */
    private function accountsFor($karyawans): array
    {
        $ids = $karyawans->pluck('id')->all();
        $nids = $karyawans->pluck('nid')->filter()->unique()->all();

        $profiles = EmployeeProfile::query()
            ->with('user')
            ->where(function ($query) use ($ids, $nids): void {
                $query->whereIn('karyawan_id', $ids);

                if ($nids !== []) {
                    $query->orWhereIn('nid', $nids);
                }
            })
            ->get()
            ->filter(fn (EmployeeProfile $profile) => $profile->user !== null);

        $byKaryawanId = $profiles->whereNotNull('karyawan_id')->keyBy('karyawan_id');
        $byNid = $profiles->whereNotNull('nid')->keyBy('nid');

        $accounts = [];

        foreach ($karyawans as $karyawan) {
            $profile = $byKaryawanId->get($karyawan->id) ?? $byNid->get($karyawan->nid);
            $accounts[$karyawan->id] = $profile?->user;
        }

        return $accounts;
    }

    /**
     * Query dasar untuk daftar & ekspor — SATU sumber kebenaran supaya
     * ekspor selalu mengikuti filter yang sedang aktif di halaman daftar.
     */
    private function filteredQuery(Request $request)
    {
        return Karyawan::query()
            ->search($request->input('q'))
            ->filtered($request->only(self::INDEX_FILTERS));
    }

    /* =========================================================
       DETAIL
       ========================================================= */

    public function show(Karyawan $karyawan)
    {
        Gate::authorize('karyawan_data.view');

        return view('admin.data-karyawan.show', compact('karyawan'));
    }

    /* =========================================================
       TAMBAH & EDIT — form berkelompok 5 bagian
       ========================================================= */

    public function create()
    {
        Gate::authorize('karyawan_data.create');

        return view('admin.data-karyawan.form', [
            'karyawan' => null,
            'genders' => Karyawan::GENDERS,
            'statusesKawin' => Karyawan::STATUSES_KAWIN,
            'filterOptions' => Karyawan::filterOptions(),
            'master' => $this->masterOptions(),
        ]);
    }

    public function store(Request $request)
    {
        Gate::authorize('karyawan_data.create');

        $karyawan = Karyawan::create($this->validated($request));

        ActivityLogger::log('create', null, [
            'module' => 'karyawan',
            'description' => "menambahkan data karyawan \"{$karyawan->nama}\" (NID {$karyawan->nid})",
            'subject' => $karyawan,
        ]);

        return redirect()->route('admin.karyawan_data.index')
            ->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    public function edit(Karyawan $karyawan)
    {
        Gate::authorize('karyawan_data.edit');

        return view('admin.data-karyawan.form', [
            'karyawan' => $karyawan,
            'genders' => Karyawan::GENDERS,
            'statusesKawin' => Karyawan::STATUSES_KAWIN,
            'filterOptions' => Karyawan::filterOptions(),
            'master' => $this->masterOptions(),
        ]);
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        Gate::authorize('karyawan_data.edit');

        $karyawan->update($this->validated($request, $karyawan));

        ActivityLogger::log('update', null, [
            'module' => 'karyawan',
            'description' => "mengubah data karyawan \"{$karyawan->nama}\" (NID {$karyawan->nid})",
            'subject' => $karyawan,
        ]);

        return redirect()->route('admin.karyawan_data.index')
            ->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function destroy(Karyawan $karyawan)
    {
        Gate::authorize('karyawan_data.delete');

        ActivityLogger::log('delete', null, [
            'module' => 'karyawan',
            'description' => "menghapus data karyawan \"{$karyawan->nama}\" (NID {$karyawan->nid})",
            'subject' => $karyawan,
        ]);

        $karyawan->delete();

        return redirect()->route('admin.karyawan_data.index')
            ->with('success', 'Data karyawan berhasil dihapus.');
    }

    /* =========================================================
       PENDAFTARAN AKUN PENGGUNA DARI DATA KARYAWAN
       ------------------------------------------------------------
       Admin TIDAK mengisi ulang data: nama, email, kontak, bidang, dan
       jabatan diambil dari baris karyawans yang dipilih. Akun dibuat
       dengan role "Karyawan" (baseline role yang sudah ada), ditautkan
       ke master lewat employee_profiles (NID + karyawan_id), dan diberi
       kata sandi sementara acak SEKALI PAKAI + penanda
       must_change_password sehingga middleware must.password memaksa
       penggantian sebelum masuk portal.
       ========================================================= */

    public function registerAccount(Request $request, Karyawan $karyawan)
    {
        // Otorisasi backend: hanya pemegang permission pengelolaan akun
        // (users.create) yang boleh mendaftarkan akun. Route juga dijaga
        // middleware permission:users.create (defense in depth).
        Gate::authorize('users.create');

        $email = trim((string) $karyawan->email);

        if ($email === '' || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return back()->withErrors([
                'akun' => "Akun tidak dapat didaftarkan: email karyawan \"{$karyawan->nama}\" kosong atau formatnya tidak valid. Perbaiki email lewat tombol Edit terlebih dahulu.",
            ]);
        }

        $role = Role::query()
            ->where('name', 'Karyawan')
            ->where('status', true)
            ->first();

        if ($role === null) {
            return back()->withErrors([
                'akun' => 'Role "Karyawan" tidak tersedia atau tidak aktif — hubungi Super Admin.',
            ]);
        }

        // Kata sandi sementara: Str::random memakai CSPRNG (huruf+angka,
        // 12 karakter) — cukup kuat dan praktis disampaikan sekali.
        $plainPassword = Str::random(12);

        try {
            // Seluruh penulisan (akun, role pivot, profil kepegawaian)
            // dalam SATU transaksi: gagal di tengah jalan = tidak ada akun
            // atau relasi setengah jadi.
            $user = DB::transaction(function () use ($karyawan, $email, $role, $plainPassword): User {
                // Kunci baris master agar dua klik beruntun tidak membuat
                // dua akun untuk karyawan yang sama.
                $karyawan = Karyawan::query()->lockForUpdate()->findOrFail($karyawan->id);

                $sudahTerdaftar = EmployeeProfile::query()
                    ->where('karyawan_id', $karyawan->id)
                    ->when($karyawan->nid, fn ($query) => $query->orWhere('nid', $karyawan->nid))
                    ->exists();

                if ($sudahTerdaftar) {
                    throw ValidationException::withMessages([
                        'akun' => "Karyawan \"{$karyawan->nama}\" (NID {$karyawan->nid}) sudah memiliki akun pengguna.",
                    ]);
                }

                if (User::query()->where('email', $email)->exists()) {
                    throw ValidationException::withMessages([
                        'akun' => "Email \"{$email}\" sudah digunakan akun pengguna lain. Perbarui email karyawan terlebih dahulu.",
                    ]);
                }

                $data = [
                    'name' => $karyawan->nama,
                    'email' => $email,
                    'no_hp' => $karyawan->hp,
                    // Hash::make → kata sandi asli tidak pernah tersimpan.
                    'password' => Hash::make($plainPassword),
                    'must_change_password' => true,
                    'role' => $role->name,
                    'role_id' => $role->id,
                    'bidang_id' => $karyawan->bidang_id,
                    'jabatan_id' => $karyawan->jabatan_id,
                ];

                // Aturan yang SAMA dengan form Pengguna: department /
                // sub_department / level_jabatan diturunkan dari master
                // bidang & jabatan (tanpa memberi role admin apa pun).
                UserController::applyOrgScoping($data, $role->name);

                $user = User::create($data);

                // Pivot role_user: @can, middleware permission:, dan
                // pembatasan bidang membaca role aktif dari sini.
                $user->roles()->sync([$role->id]);

                // Tautan resmi karyawan ↔ akun lewat employee_profiles
                // (NID sebagai identitas + karyawan_id sebagai soft-link).
                $user->employeeProfile()->create($this->employeeProfileData($karyawan, $email));

                return $user;
            });
        } catch (ValidationException $e) {
            throw $e;
        } catch (Throwable $e) {
            report($e);

            return back()->withErrors([
                'akun' => "Akun untuk \"{$karyawan->nama}\" gagal dibuat. Tidak ada data yang tersimpan — silakan coba lagi.",
            ]);
        }

        ActivityLogger::log('create', null, [
            'module' => 'pengguna',
            'description' => "mendaftarkan akun pengguna role Karyawan untuk \"{$user->name}\" (NID {$karyawan->nid}) dari Data Karyawan",
            'subject' => $user,
        ]);

        // Kata sandi sementara HANYA dikirim lewat session flash sekali
        // tampil — tidak masuk URL, log aplikasi, maupun activity log.
        return redirect()->route('admin.karyawan_data.index')
            ->with('success', "Akun pengguna untuk \"{$user->name}\" berhasil dibuat dengan role Karyawan.")
            ->with('new_account_credentials', [
                'name' => $user->name,
                'email' => $user->email,
                'password' => $plainPassword,
            ]);
    }

    /**
     * Salinan data kepegawaian master → employee_profiles. Kolom mengikuti
     * 24 kolom spesifikasi; tidak ada data yang perlu diisi ulang admin.
     *
     * @return array<string, mixed>
     */
    private function employeeProfileData(Karyawan $karyawan, string $email): array
    {
        return [
            'karyawan_id' => $karyawan->id,
            'nid' => $karyawan->nid,
            'nama' => $karyawan->nama,
            'unit' => $karyawan->unit,
            'bidang' => $karyawan->bidangLabel(),
            'jabatan' => $karyawan->jabatanLabel(),
            'jenjang_jabatan' => $karyawan->jenjang_jabatan,
            'grade' => $karyawan->grade,
            'organik' => $karyawan->organik,
            'institusi' => $karyawan->institusi,
            'fte' => $karyawan->fte,
            'mims' => $karyawan->mims,
            'service_date' => $karyawan->service_date?->format('Y-m-d'),
            'hire_date' => $karyawan->hire_date?->format('Y-m-d'),
            'retire_date' => $karyawan->retire_date?->format('Y-m-d'),
            'grade_date' => $karyawan->grade_date?->format('Y-m-d'),
            'tgl_jab' => $karyawan->tgl_jab?->format('Y-m-d'),
            'tanggal_lahir' => $karyawan->tanggal_lahir?->format('Y-m-d'),
            'telp' => $karyawan->telp,
            'hp' => $karyawan->hp,
            'email' => $email,
            'tempat_lahir' => $karyawan->tempat_lahir,
            'agama' => $karyawan->agama,
            'gender' => $karyawan->gender,
            'status_kawin' => $karyawan->status_kawin,
        ];
    }

    /**
     * Validasi form tambah/edit — server-side. Hanya NID (unik) &
     * NAMA yang wajib; tanggal divalidasi format tanggal; EMAIL format
     * email; FTE numerik desimal; GENDER/STATUS KAWIN dari daftar.
     *
     * Bidang/jabatan memakai dua masukan:
     * - `bidang_id` / `jabatan_id`: nilai select — id master numerik,
     *   `legacy` (pertahankan teks lama), `clear` (kosongkan), atau ''.
     * - `bidang_text` / `jabatan_text`: teks lama yang dibawa form agar
     *   data yang belum terpetakan tidak hilang saat diedit.
     *
     * Teks kolom `bidang`/`jabatan` SELALU diturunkan dari master saat
     * id dipilih (tidak pernah mempercayai teks kiriman), sehingga
     * pasangan id ↔ nama tidak bisa bertentangan. Jabatan master wajib
     * berada di bawah bidang master yang dipilih.
     */
    private function validated(Request $request, ?Karyawan $karyawan = null): array
    {
        $dates = collect(Karyawan::DATE_COLUMNS)
            ->mapWithKeys(fn ($column) => [$column => ['nullable', 'date']])
            ->all();

        $validator = Validator::make($request->all(), array_merge([
            'nid' => ['required', 'string', 'max:30', Rule::unique('karyawans', 'nid')->ignore($karyawan?->id)],
            'nama' => ['required', 'string', 'max:150'],

            'bidang_id' => ['nullable', 'string', 'max:20'],
            'jabatan_id' => ['nullable', 'string', 'max:20'],
            'bidang_text' => ['nullable', 'string', 'max:100'],
            'jabatan_text' => ['nullable', 'string', 'max:100'],

            'jenjang_jabatan' => ['nullable', 'string', 'max:50'],
            'grade' => ['nullable', 'string', 'max:30'],
            'institusi' => ['nullable', 'string', 'max:100'],
            'organik' => ['nullable', 'string', 'max:100'],
            'unit' => ['nullable', 'string', 'max:100'],

            'telp' => ['nullable', 'string', 'max:50'],
            'hp' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:150'],
            'fte' => ['nullable', 'numeric', 'min:0', 'max:99'],
            'mims' => ['nullable', 'string', 'max:50'],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'agama' => ['nullable', 'string', 'max:30'],
            'gender' => ['nullable', 'in:'.implode(',', array_keys(Karyawan::GENDERS))],
            'status_kawin' => ['nullable', 'in:'.implode(',', array_keys(Karyawan::STATUSES_KAWIN))],
        ], $dates), [], [
            'nid' => 'NID',
            'nama' => 'NAMA',
        ]);

        // Relasi master: keberadaan id & konsistensi bidang ↔ jabatan.
        $validator->after(function ($validator) use ($request): void {
            $bidangId = $this->numericChoice($request->input('bidang_id'));

            if ($bidangId !== null && ! Bidang::query()->whereKey($bidangId)->exists()) {
                $validator->errors()->add('bidang_id', 'Bidang yang dipilih tidak ditemukan di master.');

                return;
            }

            $jabatanId = $this->numericChoice($request->input('jabatan_id'));

            if ($jabatanId === null) {
                return;
            }

            $jabatan = Jabatan::query()->find($jabatanId);

            if ($jabatan === null) {
                $validator->errors()->add('jabatan_id', 'Jabatan yang dipilih tidak ditemukan di master.');

                return;
            }

            if ($bidangId === null) {
                $validator->errors()->add('jabatan_id', 'Pilih bidang master terlebih dahulu sebelum memilih jabatan master.');

                return;
            }

            if ((int) $jabatan->bidang_id !== $bidangId) {
                $validator->errors()->add(
                    'jabatan_id',
                    "Jabatan \"{$jabatan->nama}\" bukan bagian dari bidang yang dipilih. Pilih jabatan dari bidang tersebut."
                );
            }
        });

        $validated = $validator->validate();

        [$validated['bidang_id'], $validated['bidang']] = $this->resolveMasterChoice(
            $validated['bidang_id'] ?? null,
            $validated['bidang_text'] ?? null,
            Bidang::class,
        );

        [$validated['jabatan_id'], $validated['jabatan']] = $this->resolveMasterChoice(
            $validated['jabatan_id'] ?? null,
            $validated['jabatan_text'] ?? null,
            Jabatan::class,
        );

        unset($validated['bidang_text'], $validated['jabatan_text']);

        return $validated;
    }

    /**
     * Terjemahkan pilihan select master menjadi pasangan (id, teks).
     *
     * - id numerik → id master + nama master (teks lama ditimpa nama
     *   master supaya nama tidak bertentangan dengan relasi).
     * - `legacy` → id NULL + teks lama yang dikirim form (dipertahankan).
     * - `clear` / kosong → id NULL + teks NULL.
     *
     * @param  class-string<Bidang|Jabatan>  $modelClass
     * @return array{0: int|null, 1: string|null}
     */
    private function resolveMasterChoice(mixed $choice, mixed $legacyText, string $modelClass): array
    {
        $choice = is_string($choice) ? trim($choice) : '';
        $legacyText = trim((string) $legacyText);

        if ($choice === 'legacy') {
            return [null, $legacyText === '' ? null : $legacyText];
        }

        if ($choice === '' || $choice === 'clear') {
            return [null, null];
        }

        $id = (int) $choice;
        $nama = $modelClass::query()->whereKey($id)->value('nama');

        if ($nama === null) {
            return [null, $legacyText === '' ? null : $legacyText];
        }

        return [$id, $nama];
    }

    /** Nilai select menjadi id numerik; `null` untuk legacy/clear/kosong. */
    private function numericChoice(mixed $value): ?int
    {
        $value = trim((string) $value);

        return ctype_digit($value) ? (int) $value : null;
    }

    /* =========================================================
       OPSI MASTER & NILAI LAMA — dipakai form & filter
       ========================================================= */

    /**
     * Opsi master untuk form & halaman daftar, plus nilai teks lama yang
     * BELUM punya padanan di master (tetap bisa dipilih/difilter).
     *
     * @return array{bidangRows: Collection, jabatans: Collection, legacyBidang: array<int, string>, legacyJabatan: array<int, string>}
     */
    private function masterOptions(): array
    {
        return [
            // Daftar master jarang berubah — baca dari cache (TTL 10 menit,
            // dibuang otomatis saat CRUD master). Sebelumnya setiap render
            // halaman menjalankan 2 query master di sini.
            'bidangRows' => Bidang::cachedTreeOrdered(),
            'jabatans' => Jabatan::cachedList(),
            'legacyBidang' => $this->legacyValues('bidang', Bidang::query()->pluck('nama')->all()),
            'legacyJabatan' => $this->legacyValues('jabatan', Jabatan::query()->pluck('nama')->all()),
        ];
    }

    /**
     * Master untuk halaman DAFTAR — hanya BIDANG (dropdown pencarian
     * satu-satunya di halaman ini, selain input NID/NAMA). Master
     * jabatan beserta nilai teks lamanya tidak ikut di-query.
     *
     * @return array{bidangRows: Collection, legacyBidang: array<int, string>}
     */
    private function masterFilterOptions(): array
    {
        return [
            'bidangRows' => Bidang::treeOrdered(),
            'legacyBidang' => $this->legacyValues('bidang', Bidang::query()->pluck('nama')->all()),
        ];
    }

    /**
     * Nilai teks unik pada kolom karyawans yang tidak ada padanannya di
     * master (dinormalisasi sama seperti impor).
     *
     * @param  array<int, string>  $masterNames
     * @return array<int, string>
     */
    private function legacyValues(string $column, array $masterNames): array
    {
        $masterKeys = array_flip(array_map(
            fn (string $nama) => MasterOrgMatcher::normalize($nama),
            $masterNames,
        ));

        return Karyawan::query()
            ->whereNotNull($column)
            ->where($column, '!=', '')
            ->distinct()
            ->orderBy($column)
            ->pluck($column)
            ->reject(fn ($value) => isset($masterKeys[MasterOrgMatcher::normalize((string) $value)]))
            ->values()
            ->all();
    }

    /* =========================================================
       TEMPLATE — unduh kerangka CSV 24 kolom
       ========================================================= */

    public function template(): StreamedResponse
    {
        Gate::authorize('karyawan_data.create');

        return response()->streamDownload(function () {
            $out = fopen('php://output', 'w');

            // BOM UTF-8 agar Excel membaca karakter dengan benar.
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, array_values(Karyawan::COLUMNS_LABELS));

            fclose($out);
        }, 'template-data-karyawan.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    /* =========================================================
       IMPOR — CSV/TXT/XLSX, validasi per baris, ringkasan, transaksi
       ========================================================= */

    public function import(Request $request)
    {
        Gate::authorize('karyawan_data.create');

        $request->validate([
            'file' => [
                'required',
                'bail',
                'file',
                'max:5120',
                // Validasi EKSTENSI, bukan `mimes:xlsx`: file .xlsx
                // (dari Excel maupun hasil uji) terdeteksi fileinfo
                // sebagai application/zip, sehingga aturan mimes
                // akan menolak file yang sebenarnya benar.
                function (string $attribute, mixed $value, \Closure $fail): void {
                    $extension = $value instanceof UploadedFile
                        ? strtolower($value->getClientOriginalExtension())
                        : '';

                    if (! in_array($extension, ['csv', 'txt', 'xlsx'], true)) {
                        $fail('Format file harus CSV (.csv/.txt) atau Excel (.xlsx).');
                    }
                },
            ],
            'mode' => ['required', 'in:skip'], // hanya mode aman: lewati duplikat (tanpa timpa)
        ], [
            'file.required' => 'File CSV atau XLSX wajib diunggah.',
            'file.max' => 'Ukuran file maksimal 5MB.',
        ]);

        $file = $request->file('file');
        $source = strtolower($file->getClientOriginalExtension()) === 'xlsx' ? 'XLSX' : 'CSV';

        $parsed = $source === 'XLSX'
            ? $this->readXlsxFile($file->getRealPath())
            : $this->readCsvFile($file->getRealPath());

        if ($parsed['error'] !== null) {
            // Format file tidak sesuai spesifikasi — ditolak dengan pesan
            // jelas SEBELUM baris apa pun divalidasi.
            return redirect()->route('admin.karyawan_data.index')
                ->with('warning', $parsed['error']);
        }

        $rows = $parsed['rows'];

        if ($rows === []) {
            return redirect()->route('admin.karyawan_data.index')
                ->with('warning', "File {$source} kosong atau hanya berisi baris header.");
        }

        // --- Tahap 1: parse & validasi SEMUA baris di memori dulu.
        //     Tidak ada tulis DB sama sekali sampai seluruh baris
        //     dinilai — baris valid disiapkan, baris gagal dicatat
        //     beserta baris & penyebabnya. Duplikat (NID sudah ada di
        //     DB / dobel dalam file) DIHITUNG TERPISAH dan TIDAK
        //     menimpa data lama.
        $validRows = [];
        $failedRows = [];
        $duplicateRows = [];
        $seenNids = [];
        $existingNids = Karyawan::query()->pluck('nid')->flip();

        // Pemetaan nama BIDANG/JABATAN → master. Katalog dimuat sekali
        // untuk seluruh file; status per kolom dihitung agar ringkasan
        // impor bisa melaporkan mana yang aman, belum terpetakan, atau
        // perlu diperiksa. Tidak ada master yang dibuat otomatis.
        $matcher = new MasterOrgMatcher;
        $mapping = [
            'bidang' => [
                MasterOrgMatcher::MATCHED => 0,
                MasterOrgMatcher::UNMAPPED => 0,
                MasterOrgMatcher::AMBIGUOUS => 0,
            ],
            'jabatan' => [
                MasterOrgMatcher::MATCHED => 0,
                MasterOrgMatcher::UNMAPPED => 0,
                MasterOrgMatcher::AMBIGUOUS => 0,
            ],
        ];
        $mappingNotes = [];

        foreach ($rows as $entry) {
            $lineNumber = $entry['line']; // nomor baris asli di file (1 = header)

            // Baris dengan jumlah kolom tidak sesuai header — nilai bisa
            // meleset ke kolom sebelah, jadi ditolak dengan pesan jelas
            // (bukan diam-diam terbaca salah).
            if ($entry['format_error'] !== null) {
                $failedRows[] = ['line' => $lineNumber, 'errors' => [$entry['format_error']]];

                continue;
            }

            [$data, $errors] = $this->parseRow($entry['data']);

            $nid = $data['nid'] ?? '';

            if ($errors === []) {
                // Baris valid — cek duplikat NID (dalam file & di DB).
                if ($nid !== '' && isset($seenNids[$nid])) {
                    $duplicateRows[] = [
                        'line' => $lineNumber,
                        'errors' => ["NID \"{$nid}\" dobel di dalam file (baris awal: {$seenNids[$nid]})."],
                    ];

                    continue;
                }

                if ($nid !== '' && isset($existingNids[$nid])) {
                    $duplicateRows[] = [
                        'line' => $lineNumber,
                        'errors' => ["NID \"{$nid}\" sudah ada di database — tidak menimpa data lama."],
                    ];

                    continue;
                }

                if ($nid !== '' && $nid !== null) {
                    $seenNids[$nid] = $lineNumber;
                }

                // Petakan ke master secara konservatif (tidak pernah
                // menebak saat nama tidak ada / ambigu).
                $match = $matcher->match($data['bidang'] ?? null, $data['jabatan'] ?? null);
                $data['bidang_id'] = $match['bidang_id'];
                $data['jabatan_id'] = $match['jabatan_id'];

                foreach (['bidang', 'jabatan'] as $field) {
                    $status = $match[$field.'_status'];

                    if (isset($mapping[$field][$status])) {
                        $mapping[$field][$status]++;
                    }
                }

                if ($match['notes'] !== []) {
                    $mappingNotes[] = ['line' => $lineNumber, 'notes' => $match['notes']];
                }

                $validRows[] = $data;

                continue;
            }

            // Baris gagal validasi (error lain di luar duplikat).
            $failedRows[] = ['line' => $lineNumber, 'errors' => $errors];
        }

        // --- Tahap 2: simpan baris valid dalam SATU transaksi.
        //     Bila gagal di tengah jalan, seluruh batch dibatalkan
        //     (tidak ada data setengah tersimpan).
        $inserted = 0;

        if ($validRows !== []) {
            DB::transaction(function () use ($validRows, &$inserted) {
                foreach ($validRows as $data) {
                    Karyawan::create($data);
                    $inserted++;
                }
            });
        }

        ActivityLogger::log('create', null, [
            'module' => 'karyawan',
            'description' => "mengimpor {$inserted} data karyawan dari file {$source} ("
                .count($failedRows).' baris gagal, '
                .count($duplicateRows).' duplikat dilewati)',
        ]);

        $skipped = count($duplicateRows);

        $perluDiperiksa = $mapping['bidang'][MasterOrgMatcher::AMBIGUOUS]
            + $mapping['jabatan'][MasterOrgMatcher::AMBIGUOUS];
        $belumTerpetakan = $mapping['bidang'][MasterOrgMatcher::UNMAPPED]
            + $mapping['jabatan'][MasterOrgMatcher::UNMAPPED];

        $message = "Impor selesai: {$inserted} baris berhasil disimpan"
            .($skipped > 0 ? ", {$skipped} baris duplikat dilewati" : '')
            .($failedRows !== [] ? ', '.count($failedRows).' baris gagal validasi' : '')
            .'.';

        if ($belumTerpetakan > 0 || $perluDiperiksa > 0) {
            $message .= ' Sebagian nama bidang/jabatan belum terpetakan ke master — lihat ringkasan pemetaan di bawah.';
        }

        return redirect()->route('admin.karyawan_data.index')
            ->with('success', $message)
            ->with('import_summary', [
                'total' => count($rows),
                'inserted' => $inserted,
                'skipped' => $skipped,
                'failed' => count($failedRows),
                'errors' => array_slice($failedRows, 0, 50), // tampilkan maks 50 baris error
                'duplicates' => array_slice($duplicateRows, 0, 50),
                'mapping' => $mapping,
                'mapping_notes' => array_slice($mappingNotes, 0, 50),
            ]);
    }

    /**
     * Baca file CSV menjadi baris data memakai baris pertama sebagai
     * header, dan Kembalikan ['error' => ?string, 'rows' => array].
     *
     * - BOM UTF-8 dibuang agar header "NID" tidak terbaca
     *   "\xEF\xBB\xBF" (template resmi & Excel UTF-8 selalu memberi BOM
     *   di awal file — ini penyebab "NID wajib diisi" di semua baris).
     * - Delimiter (koma / titik koma / tab / pipe) dideteksi dari isi
     *   file: kandidat yang menghasilkan header paling banyak cocok
     *   dengan label spesifikasi yang dipakai — bukan asumsi koma.
     * - Header dinormalisasi: trim spasi awal/akhir, spasi ganda
     *   dijadikan satu, huruf besar/kecil bebas; dikenali dari LABEL
     *   spesifikasi ("NID", "TGL LAHIR") ATAU nama kolom database
     *   ("nid", "tanggal_lahir").
     * - Header harus memuat tepat 24 kolom yang dikenali; jika tidak,
     *   pesan kesalahan format yang jelas dikembalikan SEBELUM baris
     *   apa pun divalidasi (pemetaan header bersama dengan jalur XLSX
     *   lewat mapHeaderRow()).
     * - Baris data dengan jumlah kolom LEBIH BANYAK dari header (nilai
     *   berisi delimiter tanpa kutip → kolom bergeser) ditandai
     *   format_error, bukan dipetakan keliru.
     * - Tiap baris membawa `line` (nomor baris asli di file) untuk
     *   laporan error.
     *
     * @return array{error: string|null, rows: array<int, array{line: int, data: array<string, string|null>, format_error: string|null}>}
     */
    private function readCsvFile(string $path): array
    {
        $raw = file_get_contents($path);

        if ($raw === false || trim($raw) === '') {
            return ['error' => null, 'rows' => []];
        }

        // BOM UTF-8 di awal file (Excel "CSV UTF-8" & template resmi
        // memakainya) — buang agar kolom pertama tidak salah terbaca.
        if (str_starts_with($raw, "\xEF\xBB\xBF")) {
            $raw = substr($raw, 3);
        }

        $handle = fopen('php://temp', 'r+');
        fwrite($handle, $raw);
        rewind($handle);

        // Deteksi delimiter dari isi baris header: kandidat yang paling
        // banyak menghasilkan kolom dikenali yang dipakai.
        $firstLine = (string) fgets($handle);
        $delimiter = $this->detectDelimiter($firstLine);
        rewind($handle);

        $header = fgetcsv($handle, 0, $delimiter);
        if ($header === false || trim(implode('', array_map('strval', $header))) === '') {
            fclose($handle);

            return ['error' => null, 'rows' => []];
        }

        // Petakan header file → nama kolom database + validasi 24 kolom
        // — DIPAKAI BERSAMA dengan jalur XLSX (lihat mapHeaderRow).
        $mapped = $this->mapHeaderRow($header, 'CSV');

        if ($mapped['error'] !== null) {
            fclose($handle);

            return ['error' => $mapped['error'], 'rows' => []];
        }

        $columns = $mapped['columns'];

        $rows = [];
        $rowNumber = 1; // baris 1 = header

        while (($line = fgetcsv($handle, 0, $delimiter)) !== false) {
            $rowNumber++;
            // Lewati baris kosong sepenuhnya.
            if (implode('', array_map(fn ($v) => trim((string) $v), $line)) === '') {
                continue;
            }

            // Kolom LEBIH BANYAK dari header → kemungkinan ada nilai
            // berisi delimiter tanpa kutip sehingga nilai berikutnya
            // bergeser. Tolak baris ini dengan pesan jelas, jangan
            // petakan keliru ke kolom sebelah.
            if (count($line) > count($header)) {
                $rows[] = [
                    'line' => $rowNumber,
                    'data' => [],
                    'format_error' => 'Jumlah kolom tidak sesuai dengan header (ditemukan '.count($line).' kolom) — pastikan nilai berisi delimiter digunakan tanda kutip.',
                ];

                continue;
            }

            $row = [];
            foreach ($columns as $index => $column) {
                $value = trim((string) ($line[$index] ?? ''));
                $row[$column] = $value === '' ? null : $value;
            }

            $rows[] = ['line' => $rowNumber, 'data' => $row, 'format_error' => null];
        }

        fclose($handle);

        return ['error' => null, 'rows' => $rows];
    }

    /**
     * Baca file Excel (.xlsx) menjadi struktur baris yang SAMA dengan
     * jalur CSV — memakai service XlsxReader (parsing ZIP+XML native,
     * tanpa ekstensi zip) untuk mendapatkan sel per baris, lalu header
     * dipetakan lewat mapHeaderRow() yang dipakai bersama.
     *
     * - Baris kosong dilewati; nomor baris tetap nomor baris asli di
     *   lembar Excel (bukan nomor urut setelah difilter).
     * - Sel angka bergaya tanggal sudah diubah XlsxReader menjadi
     *   Y-m-d; serial mentah tetap ditangani parseDate() nanti.
     * - Baris dengan isi melebihi kolom header ditandai format_error
     *   (nilai bisa saja bergeser kolom) — bukan dipetakan keliru.
     *
     * @return array{error: string|null, rows: array<int, array{line: int, data: array<string, string|null>, format_error: string|null}>}
     */
    private function readXlsxFile(string $path): array
    {
        $sheet = (new XlsxReader)->read($path);

        if ($sheet['error'] !== null) {
            return ['error' => $sheet['error'], 'rows' => []];
        }

        $rows = $sheet['rows'];

        if ($rows === []) {
            return ['error' => null, 'rows' => []];
        }

        // Baris pertama yang berisi = header (baris judul/kosong di
        // atasnya dilewati — umum pada file Excel hasil ekspor sistem).
        $headerIndex = null;

        foreach ($rows as $index => $entry) {
            if ($this->hasCellContent($entry['cells'])) {
                $headerIndex = $index;

                break;
            }
        }

        if ($headerIndex === null) {
            return ['error' => null, 'rows' => []];
        }

        $header = $rows[$headerIndex]['cells'];
        $mapped = $this->mapHeaderRow($header, 'XLSX');

        if ($mapped['error'] !== null) {
            return ['error' => $mapped['error'], 'rows' => []];
        }

        $columns = $mapped['columns'];
        $headerCount = count($header);
        $data = [];

        foreach (array_slice($rows, $headerIndex + 1) as $entry) {
            $cells = $entry['cells'];

            if (! $this->hasCellContent($cells)) {
                continue;
            }

            // Indeks kolom terakhir yang BERISI — sel kosong bergaya
            // (tanpa nilai) di ujung tidak dihitung sebagai kolom.
            $lastContent = -1;
            foreach ($cells as $index => $value) {
                if (trim((string) $value) !== '') {
                    $lastContent = $index;
                }
            }

            if ($lastContent >= $headerCount) {
                $data[] = [
                    'line' => $entry['row'],
                    'data' => [],
                    'format_error' => 'Jumlah kolom tidak sesuai dengan header (ditemukan '.($lastContent + 1).' kolom) — baris melebihi kolom pada header.',
                ];

                continue;
            }

            $row = [];
            foreach ($columns as $index => $column) {
                $value = trim((string) ($cells[$index] ?? ''));
                $row[$column] = $value === '' ? null : $value;
            }

            $data[] = ['line' => $entry['row'], 'data' => $row, 'format_error' => null];
        }

        return ['error' => null, 'rows' => $data];
    }

    /** Apakah sebuah baris sel memuat minimal satu nilai non-kosong. */
    private function hasCellContent(array $cells): bool
    {
        foreach ($cells as $value) {
            if (trim((string) $value) !== '') {
                return true;
            }
        }

        return false;
    }

    /**
     * Deteksi delimiter file: koma, titik koma, tab, atau pipe —
     * kandidat yang menghasilkan header paling banyak dikenali (cocok
     * dengan label spesifikasi) yang dipakai.
     */
    private function detectDelimiter(string $line): string
    {
        $labels = $this->headerLabelMap();
        $line = rtrim($line, "\r\n");

        $best = ',';
        $bestScore = 0;

        foreach ([',', ';', "\t", '|'] as $candidate) {
            $cells = str_getcsv($line, $candidate);
            $score = count(array_filter(
                $cells,
                fn ($cell) => isset($labels[$this->normalizeHeaderCell((string) $cell)])
            ));

            if ($score > $bestScore) {
                $bestScore = $score;
                $best = $candidate;
            }
        }

        return $best;
    }

    /**
     * PETA HEADER BERSAMA — dipakai jalur CSV maupun XLSX: petakan
     * sel header → nama kolom database + validasi tepat 24 kolom.
     *
     * Baris header dikenali dari LABEL spesifikasi ("NID", "TGL LAHIR")
     * ATAU nama kolom database ("nid", "tanggal_lahir"), huruf besar/
     * kecil bebas. Bila ada kolom tak dikenal / jumlahnya bukan 24,
     * kembalikan pesan format yang jelas SEBELUM baris data divalidasi.
     *
     * @param  array<int, mixed>  $header
     * @param  string  $source  label jenis berkas di pesan (CSV|XLSX)
     * @return array{error: string|null, columns: array<int, string>}
     */
    private function mapHeaderRow(array $header, string $source): array
    {
        $labelToColumn = $this->headerLabelMap();
        $columns = [];
        $unknown = [];

        foreach ($header as $index => $title) {
            $key = $this->normalizeHeaderCell((string) $title);

            if ($key === '') {
                continue;
            }

            if (! isset($labelToColumn[$key])) {
                $unknown[] = trim((string) $title);

                continue;
            }

            $columns[$index] = $labelToColumn[$key];
        }

        $expected = count(Karyawan::COLUMNS_LABELS);
        $found = count($columns);

        if ($found !== $expected || $unknown !== []) {
            $mapped = array_values($columns);
            $missing = array_diff(array_keys(Karyawan::COLUMNS_LABELS), $mapped);

            $parts = ["Format file {$source} tidak sesuai: header harus memuat tepat {$expected} kolom sesuai template (ditemukan {$found} kolom yang dikenali)."];

            if ($unknown !== []) {
                $parts[] = 'Kolom tidak dikenal: '.implode(', ', $unknown).'.';
            }
            if ($missing !== []) {
                $parts[] = 'Kolom hilang: '.implode(', ', array_map(fn ($c) => Karyawan::COLUMNS_LABELS[$c], array_values($missing))).'.';
            }
            $parts[] = 'Unduh template resmi dan jangan mengubah nama/kolom header.';

            return ['error' => implode(' ', $parts), 'columns' => []];
        }

        return ['error' => null, 'columns' => $columns];
    }

    /**
     * Peta nama header → kolom database: label spesifikasi ATAU nama
     * kolom, huruf besar/kecil bebas.
     *
     * @return array<string, string>
     */
    private function headerLabelMap(): array
    {
        $map = [];

        foreach (Karyawan::COLUMNS_LABELS as $column => $label) {
            $map[mb_strtolower(trim($label))] = $column;
            $map[mb_strtolower(trim($column))] = $column;
        }

        return $map;
    }

    /**
     * Normalisasi satu sel header: buang BOM yang tersisa, rapikan
     * spasi (awal/akhir & ganda), huruf besar/kecil bebas.
     */
    private function normalizeHeaderCell(string $title): string
    {
        $title = str_replace("\xEF\xBB\xBF", '', $title);
        $title = preg_replace('/\s+/u', ' ', $title) ?? $title;

        return mb_strtolower(trim($title));
    }

    /**
     * Validasi & normalisasi SATU baris hasil impor.
     *
     * @return array{0: array<string, mixed>, 1: array<int, string>}
     */
    private function parseRow(array $row): array
    {
        $errors = [];
        $data = [];

        // NID & NAMA wajib.
        $nid = $row['nid'] ?? null;
        $nama = $row['nama'] ?? null;

        if ($nid === null) {
            $errors[] = 'NID wajib diisi.';
        } elseif (mb_strlen($nid) > 30) {
            $errors[] = 'NID maksimal 30 karakter.';
        }
        $data['nid'] = $nid;

        if ($nama === null) {
            $errors[] = 'NAMA wajib diisi.';
        } elseif (mb_strlen($nama) > 150) {
            $errors[] = 'NAMA maksimal 150 karakter.';
        }
        $data['nama'] = $nama;

        // Kolom teks biasa — cukup panjang maksimal.
        $textLimits = [
            'bidang' => 100, 'jabatan' => 100, 'jenjang_jabatan' => 50,
            'grade' => 30, 'institusi' => 100, 'organik' => 100, 'unit' => 100,
            'telp' => 50, 'hp' => 50, 'mims' => 50, 'tempat_lahir' => 100,
            'agama' => 30,
        ];
        foreach ($textLimits as $column => $limit) {
            $value = $row[$column] ?? null;
            if ($value !== null && mb_strlen($value) > $limit) {
                $errors[] = strtoupper(Karyawan::COLUMNS_LABELS[$column])." maksimal {$limit} karakter.";
            }
            $data[$column] = $value;
        }

        // EMAIL — format email bila diisi.
        $email = $row['email'] ?? null;
        if ($email !== null && filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = "EMAIL \"{$email}\" bukan format email yang valid.";
        }
        $data['email'] = $email;

        // FTE — angka desimal bila diisi. Nilai non-angka dari data
        // historis (mis. "PJS") DIABAIKAN jadi kosong, bukan membatalkan
        // seluruh baris — kolom FTE bertipe desimal di database.
        $fte = $row['fte'] ?? null;
        if ($fte !== null && ! is_numeric($fte)) {
            $fte = null;
        } elseif ($fte !== null && (float) $fte < 0) {
            $errors[] = 'FTE tidak boleh negatif.';
        }
        $data['fte'] = $fte === null ? null : (float) $fte;

        // Tanggal — terima Y-m-d, d/m/Y, d-m-Y, atau serial Excel.
        foreach (Karyawan::DATE_COLUMNS as $column) {
            $value = $row[$column] ?? null;

            // Placeholder tanggal dari sistem lama ("00/00/0000",
            // "0000-00-00", "00000000") = "tidak ada tanggal" —
            // dianggap KOSONG, bukan tanggal rusak.
            if ($value !== null && $this->isPlaceholderDate($value)) {
                $value = null;
            }

            $parsed = $value === null ? null : $this->parseDate($value);

            if ($value !== null && $parsed === null) {
                $errors[] = strtoupper(Karyawan::COLUMNS_LABELS[$column])
                    ." \"{$value}\" bukan tanggal yang valid (pakai YYYY-MM-DD atau DD/MM/YYYY).";
            }

            $data[$column] = $parsed?->format('Y-m-d');
        }

        // GENDER — normalisasi ke L/P (terima "Laki-laki"/"Perempuan").
        $gender = $row['gender'] ?? null;
        if ($gender !== null) {
            $normalized = $this->normalizeGender($gender);
            if ($normalized === null) {
                $errors[] = "GENDER \"{$gender}\" tidak dikenal (gunakan L atau P).";
            }
            $data['gender'] = $normalized;
        } else {
            $data['gender'] = null;
        }

        // STATUS KAWIN — normalisasi ke TK/K (terima teks panjang).
        $status = $row['status_kawin'] ?? null;
        if ($status !== null) {
            $normalized = $this->normalizeStatusKawin($status);
            if ($normalized === null) {
                $errors[] = "STATUS KAWIN \"{$status}\" tidak dikenal (gunakan TK atau K).";
            }
            $data['status_kawin'] = $normalized;
        } else {
            $data['status_kawin'] = null;
        }

        return [$data, $errors];
    }

    /**
     * Parse tanggal fleksibel: Y-m-d, d/m/Y, d-m-Y, "d M Y", atau
     * serial Excel. Validasi memakai checkdate() — input seperti
     * 99/99/9999 DITOLAK (bukan di-rollover seperti
     * DateTime::createFromFormat).
     */
    private function parseDate(string $value): ?Carbon
    {
        $value = trim($value);

        // Serial tanggal Excel (angka > 20000 ≈ tahun 1954 ke atas).
        if (ctype_digit($value) && (int) $value > 20000) {
            return Carbon::createFromTimestamp(((int) $value - 25569) * 86400, 'UTC')->startOfDay();
        }

        // Pecah manual + checkdate agar tanggal tidak valid (99/99/9999)
        // ditolak, bukan di-rollover.
        foreach (['/', '-'] as $separator) {
            $parts = explode($separator, $value);

            if (count($parts) !== 3 || count(array_filter($parts, 'ctype_digit')) !== 3) {
                continue;
            }

            [$a, $b, $c] = array_map('intval', $parts);

            // Urutan YYYY-MM-DD (tahun di depan): [tahun, bulan, hari].
            if (strlen($parts[0]) === 4) {
                return checkdate($b, $c, $a) ? Carbon::create($a, $b, $c)->startOfDay() : null;
            }

            // Urutan DD/MM/YYYY (hari di depan): [hari, bulan, tahun].
            if (strlen($parts[2]) === 4) {
                return checkdate($b, $a, $c) ? Carbon::create($c, $b, $a)->startOfDay() : null;
            }
        }

        // Format teks bulan ("14 Mar 1985") — dari hasil ekspor.
        foreach (['d M Y', 'd F Y'] as $format) {
            try {
                $date = Carbon::createFromFormat($format, $value)->startOfDay();

                if (strcasecmp($date->format($format), $value) === 0) {
                    return $date;
                }
            } catch (Throwable) {
                continue;
            }
        }

        return null;
    }

    private function normalizeGender(string $value): ?string
    {
        $key = mb_strtoupper(trim($value));

        return match ($key) {
            'L', 'LAKI-LAKI', 'LAKI', 'MALE', 'LK' => 'L',
            'P', 'PEREMPUAN', 'WANITA', 'FEMALE', 'PR' => 'P',
            default => null,
        };
    }

    private function normalizeStatusKawin(string $value): ?string
    {
        $key = mb_strtoupper(trim($value));

        return match ($key) {
            'TK', 'TIDAK KAWIN', 'BELUM KAWIN', 'BELUM MENIKAH', 'TDK KAWIN', 'SINGLE' => 'TK',
            'K', 'KAWIN', 'MENIKAH', 'MARRIED' => 'K',
            default => null,
        };
    }

    /**
     * Placeholder tanggal dari ekspor sistem lama — "00/00/0000",
     * "0000-00-00", "00000000", "00" — semuanya hanya nol dan
     * pemisah, dipakai sebagai penanda "tanggal kosong".
     */
    private function isPlaceholderDate(string $value): bool
    {
        $digits = preg_replace('/\D+/', '', trim($value)) ?? '';

        return $digits !== '' && trim($digits, '0') === '';
    }

    /* =========================================================
       EKSPOR — CSV mengikuti filter yang sedang aktif
       ========================================================= */

    public function export(Request $request): StreamedResponse
    {
        Gate::authorize('karyawan_data.view');

        $query = $this->filteredQuery($request);

        ActivityLogger::log('export', null, [
            'module' => 'karyawan',
            'description' => 'mengekspor data karyawan ke CSV',
        ]);

        $filename = 'data-karyawan-'.now()->format('Ymd-His').'.csv';

        return response()->streamDownload(function () use ($query) {
            $out = fopen('php://output', 'w');

            // BOM UTF-8 agar Excel membaca karakter dengan benar.
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, array_values(Karyawan::COLUMNS_LABELS));

            $query->orderBy('nama')->chunk(500, function ($rows) use ($out) {
                foreach ($rows as $karyawan) {
                    fputcsv($out, $this->exportRow($karyawan));
                }
            });

            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    /** Satu baris ekspor — tanggal diformat mudah dibaca, label GENDER/STATUS. */
    private function exportRow(Karyawan $karyawan): array
    {
        return [
            $karyawan->nid,
            $karyawan->nama,
            $karyawan->bidang,
            $karyawan->jabatan,
            $karyawan->jenjang_jabatan,
            $karyawan->grade,
            $karyawan->institusi,
            $karyawan->organik,
            $karyawan->formatTanggal('tanggal_lahir'),
            $karyawan->formatTanggal('service_date'),
            $karyawan->formatTanggal('hire_date'),
            $karyawan->formatTanggal('retire_date'),
            $karyawan->formatTanggal('grade_date'),
            $karyawan->formatTanggal('tgl_jab'),
            $karyawan->telp,
            $karyawan->hp,
            $karyawan->email,
            $karyawan->fte,
            $karyawan->mims,
            $karyawan->tempat_lahir,
            $karyawan->agama,
            $karyawan->genderLabel(),
            $karyawan->statusKawinLabel(),
            $karyawan->unit,
        ];
    }
}
