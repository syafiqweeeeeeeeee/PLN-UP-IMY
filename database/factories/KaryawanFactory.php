<?php

namespace Database\Factories;

use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory DATA KARYAWAN — hanya untuk pengujian otomatis
 * (tests/Feature/DataKaryawanTest). BUKAN untuk mengisi database
 * produksi dengan data palsu.
 */
class KaryawanFactory extends Factory
{
    protected $model = Karyawan::class;

    public function definition(): array
    {
        $gender = $this->faker->randomElement(['L', 'P']);

        return [
            'nid' => $this->faker->unique()->numerify('####'), // string; leading zero aman
            'nama' => $this->faker->name('male'),
            'bidang' => $this->faker->randomElement(['Operasi', 'Pemeliharaan', 'Engineering', 'Business Support', 'K3 & KAM', 'Lingkungan']),
            'jabatan' => $this->faker->randomElement(['Manager', 'Asisten Manager', 'Supervisor', 'Staf']),
            'jenjang_jabatan' => $this->faker->randomElement(['JTE', 'JTM', 'JTG']),
            'grade' => $this->faker->randomElement(['IIIC', 'IIIB', 'IIIA', 'IV']),
            'institusi' => 'PLN Nusantara Power',
            'organik' => $this->faker->randomElement(['Organik', 'Non-Organik']),
            'tanggal_lahir' => $this->faker->dateTimeBetween('-40 years', '-22 years')->format('Y-m-d'),
            'service_date' => $this->faker->dateTimeBetween('-15 years', '-1 year')->format('Y-m-d'),
            'hire_date' => $this->faker->dateTimeBetween('-15 years', '-1 year')->format('Y-m-d'),
            'retire_date' => null,
            'grade_date' => $this->faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            'tgl_jab' => $this->faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            'telp' => $this->faker->numerify('02##-#######'),
            'hp' => $this->faker->numerify('08##########'),
            'email' => $this->faker->unique()->safeEmail(),
            'fte' => 1.00,
            'mims' => $this->faker->numerify('M#####'),
            'tempat_lahir' => $this->faker->city(),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
            'gender' => $gender,
            'status_kawin' => $this->faker->randomElement(['TK', 'K']),
            'unit' => $this->faker->randomElement(['Unit 1', 'Unit 2', 'Sekretariat']),
        ];
    }
}
