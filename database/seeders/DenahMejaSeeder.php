<?php

namespace Database\Seeders;

use App\Models\Denah;
use App\Models\Meja;
use Illuminate\Database\Seeder;

class DenahMejaSeeder extends Seeder
{
    public function run(): void
    {
        // Buat satu denah utama
        $denah = Denah::create([
            'nama' => 'Denah Lantai 1',
            'path_gambar' => 'images/denah-lantai-1.jpg', // Path contoh
            'aktif' => true,
        ]);

        // Buat 15 meja di dalam denah tersebut
        for ($i = 1; $i <= 15; $i++) {
            Meja::create([
                'denah_id' => $denah->id,
                'nama' => 'Meja ' . str_pad($i, 2, '0', STR_PAD_LEFT),
                'kapasitas' => fake()->randomElement([2, 4, 6]),
                'status' => 'tersedia',
                'posisi_x' => fake()->numberBetween(50, 900), // Koordinat X acak
                'posisi_y' => fake()->numberBetween(50, 600), // Koordinat Y acak
            ]);
        }
    }
}