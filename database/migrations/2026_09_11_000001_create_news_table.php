<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel news sudah ada sebelumnya tanpa timestamps.
     * Migration ini difokuskan untuk menjaga consistensi definisi tabel.
     */
    public function up(): void
    {
        if (!Schema::hasTable('news')) {
            Schema::create('news', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->enum('category', ['umum', 'teknis', 'kegiatan', 'kepegawaian']);
                $table->text('excerpt');
                $table->longText('content')->nullable();
                $table->string('image')->nullable();
                $table->string('author')->nullable();
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
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
