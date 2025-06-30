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
        Schema::create('mejas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('denah_id')->constrained('denahs')->onDelete('cascade');
            $table->string('nama'); // Contoh: "Meja 01", "Sofa Sudut"
            $table->integer('kapasitas');
            $table->enum('status', ['tersedia', 'dipesan', 'ditempati', 'tidak_tersedia'])->default('tersedia');
            $table->integer('posisi_x')->nullable()->comment('Koordinat X pada gambar denah');
            $table->integer('posisi_y')->nullable()->comment('Koordinat Y pada gambar denah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mejas');
    }
};
