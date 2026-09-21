<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Clean removal modul "Kontak" (Hubungi Kami, Lokasi, Sosial Media).
 *
 * - Menghapus tabel contact_messages (form kontak publik → admin Permohonan).
 *   Nama tabel alternatif (contacts, locations, social_medias) ikut
 *   di-drop bila ada, agar removal bersih di semua lingkungan.
 * - Membersihkan baris menu navbar yang menunjuk ke route kontak
 *   (hubungi-kami, lokasi, sosial-media) — parent "Kontak" ikut dihapus
 *   bila tidak lagi memiliki anak.
 * - Membersihkan permission contact_messages.* beserta pivot role_permission
 *   (modul admin "Permohonan & Pesan" dihapus bersama form publiknya).
 */
return new class extends Migration
{
    public function up(): void
    {
        // --- 1. Hapus tabel modul kontak ---
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('locations');
        Schema::dropIfExists('social_medias');

        // --- 2. Hapus menu navbar yang menunjuk ke route kontak ---
        $contactRouteIds = DB::table('menus')
            ->whereIn('route_name', ['hubungi-kami', 'lokasi', 'sosial-media'])
            ->pluck('id');

        if ($contactRouteIds->isNotEmpty()) {
            // Parent "Kontak" dari anak-anak tersebut (bisa jadi multi-level)
            $parentIds = DB::table('menus')
                ->whereIn('id', $contactRouteIds)
                ->pluck('parent_id')
                ->filter();

            DB::table('menus')->whereIn('id', $contactRouteIds)->delete();

            // Hapus parent yang tidak lagi punya anak (grup dropdown kosong)
            foreach ($parentIds as $parentId) {
                $hasChildren = DB::table('menus')->where('parent_id', $parentId)->exists();
                if (! $hasChildren) {
                    DB::table('menus')->where('id', $parentId)->delete();
                }
            }
        }

        // --- 3. Hapus permission modul contact_messages + pivot role_permission ---
        $permIds = DB::table('permissions')
            ->where('name', 'like', 'contact_messages.%')
            ->pluck('id');

        if ($permIds->isNotEmpty()) {
            DB::table('role_permission')->whereIn('permission_id', $permIds)->delete();
            DB::table('permissions')->whereIn('id', $permIds)->delete();
        }
    }

    public function down(): void
    {
        // Penghapusan modul bersifat permanen — tidak ada rollback.
        // Struktur tabel dapat dibuat ulang via seeder/menu builder.
    }
};
