<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Review::create([
            'pesanan_id' => 1,
            'user_id' => 1,
            'rating' => 5,
            'comment' => 'Produk sangat bagus dan berkualitas',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
