<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel tamu — buku registrasi pengunjung kantor/instansi.
     * Foto KTP disimpan sebagai path relatif di disk 'public'
     * (mis. ktp/xxxx.jpg → storage/app/public/ktp).
     */
    public function up(): void
    {
        Schema::create('tamus', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique()->comment('NIK / No. KTP (16 digit)');
            $table->string('nama', 150);
            $table->string('instansi', 150)->nullable()->comment('Perusahaan / instansi asal tamu');
            $table->string('no_hp', 25)->comment('No. WhatsApp / HP aktif');
            $table->string('email', 150)->nullable()->comment('Opsional');
            $table->string('foto_ktp')->comment('Path file KTP di disk public, mis. ktp/abc.jpg');
            $table->string('tujuan_ditemui', 150)->comment('Nama orang / divisi yang ditemui');
            $table->unsignedTinyInteger('jumlah_tamu')->default(1)->comment('Jumlah rombongan (min 1)');
            $table->text('keperluan')->comment('Maksud & tujuan kunjungan');
            $table->timestamp('checked_in_at')->nullable()->comment('Waktu check-in di front office');
            $table->timestamp('checked_out_at')->nullable()->comment('Waktu check-out / selesai kunjungan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tamus');
    }
};
