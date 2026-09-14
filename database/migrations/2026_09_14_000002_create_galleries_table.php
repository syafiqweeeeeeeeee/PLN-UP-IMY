<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->enum('kategori', ['KEGIATAN', 'FASILITAS', 'DOKUMENTASI', 'SEREMONIAL']);
            $table->text('deskripsi')->nullable();
            $table->string('file_gambar');
            $table->date('tanggal_kegiatan');
            $table->enum('status', ['publikasi', 'draft'])->default('publikasi');
            $table->timestamps();

            $table->index('kategori');
            $table->index('status');
            $table->index('tanggal_kegiatan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
