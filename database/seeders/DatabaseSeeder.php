<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SettingSeeder::class);
        $this->call(SpatieController::class);
        $this->call(UserSeeder::class);

        $this->call(MejaSeeder::class);
        $this->call(KategoriSeeder::class);
        $this->call(ProdukSeeder::class);
        $this->call(PesananSeeder::class);
        $this->call(DetailPesananSeeder::class);
        $this->call(ReviewSeeder::class);
    }
}
