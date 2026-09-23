<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * foto_ktp menjadi nullable: tamu yang didaftarkan manual oleh admin
     * via dashboard belum tentu punya lampiran foto KTP.
     */
    public function up(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->string('foto_ktp')->nullable()->comment('Path file KTP di disk public, mis. ktp/abc.jpg')->change();
        });
    }

    public function down(): void
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->string('foto_ktp')->nullable(false)->comment('Path file KTP di disk public, mis. ktp/abc.jpg')->change();
        });
    }
};
