<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_variasis', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel menu (induk)
            $table->foreignId('menu_id')->constrained('menu')->onDelete('cascade');
            $table->string('nama_variasi');
            $table->decimal('harga', 10, 2);
            $table->enum('status_ketersediaan', ['tersedia', 'habis'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_variasis');
    }
};
