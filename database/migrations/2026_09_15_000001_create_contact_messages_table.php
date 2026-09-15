<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 150);
            $table->string('email');
            $table->string('telepon', 25);
            $table->string('kategori', 30);
            $table->string('subjek');
            $table->text('pesan');
            $table->string('status', 20)->default('belum_dibaca')->index();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
