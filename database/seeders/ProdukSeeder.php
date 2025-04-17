<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::create([
            'nama' => 'Nasi Goreng',
            'harga' => 20000,
            'stok' => 50,
            'kategori_id' => 1,
            'deskripsi' => 'Nasi goreng spesial dengan telur dan ayam',
            'gambar' => 'nasi_goreng.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Produk::create([
            'nama' => 'Es Teh Manis',
            'harga' => 5000,
            'stok' => 100,
            'kategori_id' => 2,
            'deskripsi' => 'Es teh manis segar',
            'gambar' => 'es_teh_manis.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Produk::create([
            'nama' => 'Keripik Singkong',
            'harga' => 10000,
            'stok' => 30,
            'kategori_id' => 3,
            'deskripsi' => 'Keripik singkong renyah',
            'gambar' => 'keripik_singkong.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
