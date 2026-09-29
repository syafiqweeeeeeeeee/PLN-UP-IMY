<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * RBAC — Admin Delegasi per Bidang:
 *
 * 1. Tabel `departments` (katalog Bidang Utama) — kode-nya sama dengan
 *    konstanta User::DEPARTMENTS ('operasi', 'pemeliharaan', ...) yang
 *    sudah dipakai work_links.department & users.department.
 * 2. users.department_id (nullable FK) — pengikatan akun "Admin Bidang"
 *    & "Karyawan" ke satu bidang. Dibackfill dari kolom lama
 *    users.department (kode string) agar data existing tetap terikat.
 * 3. announcements.department_id (nullable FK) — penanda bidang pemilik
 *    pengumuman internal. NULL = konten global (Super Admin).
 */
return new class extends Migration
{
    public function up(): void
    {
        // ===== 1. Tabel katalog bidang =====
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        foreach (User::DEPARTMENTS as $code => $name) {
            DB::table('departments')->insert([
                'code'      => $code,
                'name'      => $name,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // ===== 2. users.department_id — pengikatan akun per bidang =====
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('department_id')
                ->nullable()
                ->after('department')
                ->constrained('departments')
                ->nullOnDelete();
        });

        // Backfill: akun yang sudah punya kode bidang (string) diikat ke
        // baris departments yang cocok.
        DB::statement(
            'UPDATE users INNER JOIN departments ON users.department = departments.code '
            . 'SET users.department_id = departments.id'
        );

        // ===== 3. announcements.department_id — pemilik pengumuman =====
        Schema::table('announcements', function (Blueprint $table) {
            $table->foreignId('department_id')
                ->nullable()
                ->after('author_user_id')
                ->constrained('departments')
                ->nullOnDelete();

            $table->index('department_id');
        });
    }

    public function down(): void
    {
        if (Schema::hasColumn('announcements', 'department_id')) {
            Schema::table('announcements', function (Blueprint $table) {
                $table->dropForeign(['department_id']);
                $table->dropIndex(['department_id']);
                $table->dropColumn('department_id');
            });
        }

        if (Schema::hasColumn('users', 'department_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign(['department_id']);
                $table->dropColumn('department_id');
            });
        }

        Schema::dropIfExists('departments');
    }
};
