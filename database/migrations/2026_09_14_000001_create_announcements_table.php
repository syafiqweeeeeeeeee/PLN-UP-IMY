<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->enum('category', ['umum', 'teknis', 'kepegawaian', 'keuangan', 'layanan']);
            $table->text('excerpt');
            $table->longText('content')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->unsignedBigInteger('author_user_id')->nullable();
            $table->timestamps();

            $table->foreign('author_user_id')
                  ->references('id')
                  ->on('users')
                  ->nullOnDelete();

            $table->index('is_published');
            $table->index('category');
            $table->index('published_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
