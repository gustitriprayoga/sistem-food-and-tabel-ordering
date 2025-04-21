<?php

namespace Database\Seeders;

use App\Models\Meja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Meja::create([
            'kode' => 'M1',
            'nama' => 'Meja 1',
            'bentuk' => 'kotak',
            'pos_x' => 0,
            'pos_y' => 0,
            'status' => 'Tersedia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Meja::create([
            'kode' => 'M2',
            'bentuk' => 'kotak',
            'nama' => 'Meja 2',
            'pos_x' => 1,
            'pos_y' => 0,
            'status' => 'Tersedia',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
