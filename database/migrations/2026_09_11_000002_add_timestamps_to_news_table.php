<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Tambahkan timestamps hanya jika belum ada (aman untuk DB fresh
        // karena create_news_table sudah membuat created_at & updated_at).
        if (!Schema::hasColumn('news', 'created_at') && !Schema::hasColumn('news', 'updated_at')) {
            Schema::table('news', function (Blueprint $table) {
                $table->timestamps();
            });
        }

        // Set default values for existing rows
        DB::table('news')->whereNull('created_at')->update([
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()'),
        ]);
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
};
