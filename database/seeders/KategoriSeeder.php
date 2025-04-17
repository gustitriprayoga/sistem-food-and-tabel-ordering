<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create([
            'nama' => 'Makanan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Kategori::create([
            'nama' => 'Minuman',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Kategori::create([
            'nama' => 'Snack',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
