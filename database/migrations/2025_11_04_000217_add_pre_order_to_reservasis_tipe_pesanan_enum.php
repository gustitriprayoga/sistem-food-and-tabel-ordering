<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // MySQL 5.7+ / MariaDB: Perintah SQL mentah diperlukan untuk memodifikasi ENUM
        DB::statement("ALTER TABLE reservasis MODIFY tipe_pesanan ENUM('makan_ditempat', 'bawa_pulang', 'pre_order') NOT NULL DEFAULT 'makan_ditempat'");
    }

    public function down(): void
    {
        // Rollback (opsional, jika diperlukan)
        DB::statement("ALTER TABLE reservasis MODIFY tipe_pesanan ENUM('makan_ditempat', 'bawa_pulang') NOT NULL DEFAULT 'makan_ditempat'");
    }
};
