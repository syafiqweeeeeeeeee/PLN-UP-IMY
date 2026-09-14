<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();

            // Pembuat aksi. Nullable + set null: log tetap tersimpan
            // meskipun akun user yang bersangkutan sudah dihapus.
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('user_name')->nullable();  // snapshot nama saat aksi
            $table->string('user_role')->nullable();  // snapshot role saat aksi

            $table->string('module')->index();   // berita | pengumuman | pengguna | autentikasi | ...
            $table->string('action')->index();   // create | update | delete | publish | unpublish | login | logout
            $table->text('description');         // kalimat manusiawi, mis. "membuat berita \"Judul\""

            // Subjek aksi (polymorphic ringan, string agar tidak butuh FK)
            $table->string('subject_type')->nullable()->index();
            $table->unsignedBigInteger('subject_id')->nullable();

            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 500)->nullable();

            $table->timestamps();

            $table->index(['created_at']);
            $table->index(['module', 'action']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
