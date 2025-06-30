<?php

namespace Database\Seeders;

use App\Models\KategoriMenu;
use App\Models\Menu;
use App\Models\VariasiMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat Kategori
        $kopi = KategoriMenu::create(['nama' => 'Minuman Kopi', 'slug' => Str::slug('Minuman Kopi')]);
        $nonKopi = KategoriMenu::create(['nama' => 'Minuman Non-Kopi', 'slug' => Str::slug('Minuman Non-Kopi')]);
        $makanan = KategoriMenu::create(['nama' => 'Makanan Berat', 'slug' => Str::slug('Makanan Berat')]);
        $snack = KategoriMenu::create(['nama' => 'Snack & Makanan Ringan', 'slug' => Str::slug('Snack & Makanan Ringan')]);

        // Data Menu beserta Variasinya
        $daftarMenu = [
            [
                'kategori_id' => $kopi->id, 'nama' => 'Kopi Susu Gula Aren', 'deskripsi' => 'Perpaduan kopi, susu, dan manisnya gula aren.',
                'variasi' => [['nama_variasi' => 'Panas', 'harga' => 20000], ['nama_variasi' => 'Dingin', 'harga' => 22000]]
            ],
            [
                'kategori_id' => $kopi->id, 'nama' => 'Americano', 'deskripsi' => 'Espresso dengan tambahan air.',
                'variasi' => [['nama_variasi' => 'Panas', 'harga' => 18000], ['nama_variasi' => 'Dingin', 'harga' => 18000]]
            ],
            [
                'kategori_id' => $kopi->id, 'nama' => 'Caffe Latte', 'deskripsi' => 'Espresso dengan steamed milk dan sedikit foam.',
                'variasi' => [['nama_variasi' => 'Panas', 'harga' => 22000], ['nama_variasi' => 'Dingin', 'harga' => 24000]]
            ],
            [
                'kategori_id' => $nonKopi->id, 'nama' => 'Lemon Tea', 'deskripsi' => 'Teh dengan kesegaran lemon asli.',
                'variasi' => [['nama_variasi' => 'Panas', 'harga' => 15000], ['nama_variasi' => 'Dingin', 'harga' => 17000]]
            ],
             [
                'kategori_id' => $nonKopi->id, 'nama' => 'Chocolate', 'deskripsi' => 'Minuman cokelat premium.',
                'variasi' => [['nama_variasi' => 'Panas', 'harga' => 21000], ['nama_variasi' => 'Dingin', 'harga' => 23000]]
            ],
            [
                'kategori_id' => $makanan->id, 'nama' => 'Nasi Goreng Niskala', 'deskripsi' => 'Nasi goreng spesial resep rahasia Niskala.',
                'variasi' => [['nama_variasi' => 'Biasa', 'harga' => 25000], ['nama_variasi' => 'Ekstra Pedas', 'harga' => 26000], ['nama_variasi' => 'Seafood', 'harga' => 32000]]
            ],
            [
                'kategori_id' => $makanan->id, 'nama' => 'Spaghetti Carbonara', 'deskripsi' => 'Spaghetti dengan saus carbonara creamy.',
                'variasi' => [['nama_variasi' => 'Original', 'harga' => 35000]]
            ],
            [
                'kategori_id' => $snack->id, 'nama' => 'Kentang Goreng', 'deskripsi' => 'Kentang goreng renyah dengan saus pilihan.',
                'variasi' => [['nama_variasi' => 'Original', 'harga' => 18000]]
            ],
            [
                'kategori_id' => $snack->id, 'nama' => 'Roti Bakar', 'deskripsi' => 'Roti bakar dengan pilihan topping.',
                'variasi' => [['nama_variasi' => 'Coklat Keju', 'harga' => 20000], ['nama_variasi' => 'Srikaya', 'harga' => 18000]]
            ],
        ];

        foreach ($daftarMenu as $item) {
            $menu = Menu::create([
                'kategori_id' => $item['kategori_id'],
                'nama' => $item['nama'],
                'deskripsi' => $item['deskripsi'],
            ]);

            foreach ($item['variasi'] as $v) {
                VariasiMenu::create([
                    'menu_id' => $menu->id,
                    'nama_variasi' => $v['nama_variasi'],
                    'harga' => $v['harga'],
                ]);
            }
        }
    }
}