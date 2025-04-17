<?php

namespace Database\Seeders;

use App\Models\Pesanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pesanan::create([
            'meja_id' => 1,
            'user_id' => 1,
            'total_harga' => 15000,
            'metode_pembayaran' => 'cod',
            'status_pembayaran' => 'lunas',
            'pesanan_status' => 'tertunda',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Pesanan::create([
            'meja_id' => 2,
            'user_id' => 1,
            'total_harga' => 20000,
            'metode_pembayaran' => 'manual',
            'status_pembayaran' => 'lunas',
            'pesanan_status' => 'tertunda',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
