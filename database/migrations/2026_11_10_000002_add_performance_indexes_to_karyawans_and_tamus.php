<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * INDEX PERFORMA — halaman Data Karyawan & Manajemen Tamu.
 *
 * Kolom yang sering difilter / di-join / diurutkan:
 * - karyawans: daftar default `WHERE status = 'aktif' ORDER BY nama`
 *   (composite status+nama), serta FK `bidang_id` / `jabatan_id`
 *   (biasanya sudah terindeks otomatis oleh foreign key — di sini hanya
 *   ditambahkan bila belum ada, tanpa menduplikasi).
 * - tamus: `created_at` (statistik hari ini/bulan ini), `tanggal_kunjungan`
 *   (filter rentang + urutan daftar), `checked_out_at` (statistik aktif),
 *   dan composite `status_verifikasi + tanggal_kunjungan` untuk filter
 *   status + urutan jadwal.
 * - `nid` (unique) dan `tamus.nik` (unique) sudah terindeks dari migrasi
 *   pembuatan tabel, jadi tidak diulang di sini.
 *
 * Aman dijalankan pada database yang sudah terisi: hanya menambah index,
 * tanpa mengubah data. Index yang sudah ada (termasuk index otomatis FK)
 * dilewati agar tidak duplikat.
 */
return new class extends Migration
{
    /**
     * Daftar index yang ditambahkan migrasi ini:
     * [tabel, nama index, kolom].
     *
     * @var array<int, array{0: string, 1: string, 2: array<int, string>}>
     */
    private const INDEXES = [
        ['karyawans', 'karyawans_status_nama_index', ['status', 'nama']],
        ['karyawans', 'karyawans_bidang_id_index', ['bidang_id']],
        ['karyawans', 'karyawans_jabatan_id_index', ['jabatan_id']],
        ['tamus', 'tamus_created_at_index', ['created_at']],
        ['tamus', 'tamus_tanggal_kunjungan_index', ['tanggal_kunjungan']],
        ['tamus', 'tamus_checked_out_at_index', ['checked_out_at']],
        ['tamus', 'tamus_status_verifikasi_tanggal_kunjungan_index', ['status_verifikasi', 'tanggal_kunjungan']],
    ];

    public function up(): void
    {
        foreach (self::INDEXES as [$table, $name, $columns]) {
            if ($this->hasIndex($table, $name) || $this->hasIndexOnColumns($table, $columns)) {
                continue;
            }

            Schema::table($table, function (Blueprint $blueprint) use ($name, $columns): void {
                $blueprint->index($columns, $name);
            });
        }
    }

    public function down(): void
    {
        foreach (self::INDEXES as [$table, $name]) {
            if (! $this->hasIndex($table, $name)) {
                continue;
            }

            Schema::table($table, function (Blueprint $blueprint) use ($name): void {
                $blueprint->dropIndex($name);
            });
        }
    }

    /** Index dengan nama tertentu sudah ada? */
    private function hasIndex(string $table, string $name): bool
    {
        foreach (Schema::getIndexes($table) as $index) {
            if (strcasecmp((string) ($index['name'] ?? ''), $name) === 0) {
                return true;
            }
        }

        return false;
    }

    /**
     * Sudah ada index dengan kolom PERSIS sama (mis. index otomatis FK
     * untuk bidang_id/jabatan_id)? Urutan kolom ikut dibandingkan agar
     * composite tidak dianggap sama dengan index kolom tunggal.
     *
     * @param  array<int, string>  $columns
     */
    private function hasIndexOnColumns(string $table, array $columns): bool
    {
        foreach (Schema::getIndexes($table) as $index) {
            if (array_values($index['columns'] ?? []) === array_values($columns)) {
                return true;
            }
        }

        return false;
    }
};
