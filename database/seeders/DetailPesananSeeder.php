<?php

namespace Database\Seeders;

use App\Models\PesananDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailPesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PesananDetail::create([
            'pesanan_id' => 1,
            'produk_id' => 1,
            'qty' => 2,
            'harga' => 20000,
            'subtotal' => 40000,
        ]);
    }
}

