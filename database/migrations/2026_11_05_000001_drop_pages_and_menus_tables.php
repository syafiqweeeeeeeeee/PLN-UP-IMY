<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Menghapus permanen fitur Halaman CMS (/admin/pages) dan Menu Builder
 * (/admin/menus) beserta seluruh tabel pendukungnya.
 *
 * Tabel yang dihapus:
 *   - menus          (menu navbar publik + anak menu)
 *   - page_sections  (blok konten halaman CMS)
 *   - page_role      (visibilitas halaman per role)
 *   - pages          (halaman CMS)
 *
 * Migration pembuat tabel-tabel ini (2026_09_15_000001..000003) juga
 * dihapus dari repo, sehingga instalasi BARU tidak pernah membuatnya.
 * Migration ini tetap disediakan untuk database yang sudah berjalan:
 * dropIfExists membuatnya aman dijalankan baik saat tabel masih ada
 * maupun pada instalasi baru (no-op).
 */
return new class extends Migration
{
    public function up(): void
    {
        // Urutan drop: anak dulu (FK ke pages/menus), induk terakhir.
        Schema::dropIfExists('menus');
        Schema::dropIfExists('page_sections');
        Schema::dropIfExists('page_role');
        Schema::dropIfExists('pages');
    }

    /**
     * Rollback mengembalikan struktur tabel persis seperti migration
     * pembuatnya (data lama tidak dapat dikembalikan).
     */
    public function down(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('status', 20)->default('draft')->index();
            $table->string('visibility', 20)->default('public')->index();
            $table->boolean('show_in_list')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('page_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->cascadeOnDelete();
            $table->foreignId('role_id')->constrained()->cascadeOnDelete();
            $table->unique(['page_id', 'role_id']);
        });

        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->cascadeOnDelete();
            $table->string('type', 30);
            $table->json('data')->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->timestamps();
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('menus')->cascadeOnDelete();
            $table->string('label');
            $table->string('type', 20)->default('url');
            $table->string('route_name')->nullable();
            $table->foreignId('page_id')->nullable()->constrained('pages')->nullOnDelete();
            $table->string('url', 500)->nullable();
            $table->string('target', 10)->default('_self');
            $table->string('icon', 60)->nullable();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index(['parent_id', 'sort_order']);
        });
    }
};
