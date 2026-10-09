<?php

namespace App\Console\Commands;

use App\Models\MasterMenu;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Console\Command;

/**
 * permission:grant — Diagnosa & pemberian Direct Permission tanpa lewat form.
 *
 * Mengapa command ini ada: tombol @can('xxx.create') di portal karyawan
 * tidak muncul padahal admin "sudah men centang" di form Pengguna. Penyebab
 * paling umum: baris permission (mis. news.create) TIDAK ADA di tabel
 * `permissions` sehingga kolom checkbox di matriks menampilkan "—" dan
 * centangan tidak pernah tersimpan, atau permission tersimpan di ROLE
 * sedangkan akun punya direct permission lain di modul sama (white-list
 * override memblokir fallback role).
 *
 * Pemakaian:
 *   php artisan permission:grant email@karyawan.com news.create news.edit
 *
 * Command ini:
 * 1. Memastikan semua baris permission matriks ada di DB (membuat yang kurang).
 * 2. Menampilkan direct permission akun SEBELUM.
 * 3. Menambahkan permission yang diminta (tanpa menghapus yang sudah ada).
 * 4. Menampilkan hasil akhir + hasil cek hasPermission() (yang dipakai @can).
 */
class GrantPermission extends Command
{
    protected $signature = 'permission:grant
        {email : Email akun target}
        {permissions?* : Nama permission yang akan diberikan (mis. news.create announcements.create)}';

    protected $description = 'Diagnosa & berikan Direct Permission ke akun tertentu tanpa lewat form admin';

    public function handle(): int
    {
        $user = User::where('email', $this->argument('email'))->first();

        if (! $user) {
            $this->error("Akun dengan email '{$this->argument('email')}' tidak ditemukan.");

            return self::FAILURE;
        }

        $this->info("Akun: {$user->name} <{$user->email}>");
        $this->line('Role: ' . ($user->roleNames()->implode(', ') ?: '(tidak ada)'));
        $this->newLine();

        /* ======================================================
           1. PASTIKAN BARIS PERMISSION MATRIKS ADA DI DB
           ====================================================== */
        $createdRows = $this->ensureMatrixPermissionRows();

        if ($createdRows !== []) {
            $this->warn('Baris permission berikut TIDAK ADA di tabel permissions dan BARU DIBUAT:');
            foreach ($createdRows as $name) {
                $this->warn("  + {$name}");
            }
            $this->warn('→ Artinya checkbox kolom tersebut sebelumnya menampilkan "—"');
            $this->warn('  sehingga tidak bisa dicentang lewat form. Sekarang sudah ada.');
            $this->newLine();
        } else {
            $this->line('Semua baris permission matriks sudah ada di DB.');
            $this->newLine();
        }

        /* ======================================================
           2. TAMPILKAN DIRECT PERMISSION SEBELUM
           ====================================================== */
        $before = $user->directPermissionNames()->sort()->values();
        $this->info('Direct permission SEBELUM: ' . ($before->implode(', ') ?: '(kosong)'));
        $this->newLine();

        $requested = array_values(array_unique(array_filter(array_map('trim', $this->argument('permissions')))));

        if ($requested === []) {
            $this->line('Tidak ada permission diminta — hanya diagnostik. Contoh pemberian:');
            $this->line('  php artisan permission:grant ' . $user->email . ' news.create news.edit');

            return self::SUCCESS;
        }

        /* ======================================================
           3. VALIDASI & TAMBAHKAN PERMISSION (tanpa menghapus lama)
           ====================================================== */
        $validNames = Permission::pluck('name')->all();
        $toGrant = [];
        $unknown = [];

        foreach ($requested as $name) {
            if (in_array($name, $validNames, true)) {
                $toGrant[] = $name;
            } else {
                $unknown[] = $name;
            }
        }

        if ($unknown !== []) {
            $this->error('Permission TIDAK dikenal (tidak ada di DB): ' . implode(', ', $unknown));
        }

        if ($toGrant === []) {
            return self::FAILURE;
        }

        $ids = Permission::whereIn('name', $toGrant)->pluck('id')->all();
        // syncWithoutDetaching: tambah tanpa menghapus direct permission lain.
        $user->permissions()->syncWithoutDetaching($ids);

        /* ======================================================
           4. HASIL AKHIR + VERIFIKASI
           ====================================================== */
        $after = $user->directPermissionNames()->sort()->values();
        $this->newLine();
        $this->info('Direct permission SESUDAH: ' . $after->implode(', '));
        $this->newLine();

        $this->table(
            ['Permission', 'hasPermission() (@can / middleware)'],
            collect($toGrant)->map(fn ($n) => [
                $n,
                $user->hasPermission($n) ? '✅ ALLOW' : '❌ BLOCK',
            ])->all()
        );

        $this->newLine();
        $this->info('Selesai. Berlaku real-time — karyawan cukup refresh halaman portal (tanpa login ulang).');

        return self::SUCCESS;
    }

    /**
     * Pastikan setiap nama permission matriks (Menu × CRUD) punya baris
     * di tabel permissions. Membuat baris yang kurang (firstOrCreate).
     *
     * @return array<int, string> Nama permission yang baru dibuat.
     */
    private function ensureMatrixPermissionRows(): array
    {
        $created = [];

        $menusByName = MasterMenu::query()->get()->keyBy('permission_key');

        foreach (MasterMenu::MENUS as $def) {
            $menu = $menusByName->get($def['permission_key']);

            foreach (array_keys(MasterMenu::CRUD_ACTIONS) as $action) {
                $name = "{$def['permission_key']}.{$action}";

                $row = Permission::firstOrCreate(
                    ['name' => $name],
                    [
                        'display_name' => MasterMenu::CRUD_ACTIONS[$action] . ' — ' . $def['name'],
                        'module'       => $menu?->name ?? $def['name'],
                    ]
                );

                if ($row->wasRecentlyCreated) {
                    $created[] = $name;
                }
            }
        }

        return $created;
    }
}
