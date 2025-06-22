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
            $table->string('nama_meja')->unique();
            $table->integer('kapasitas');
            $table->integer('posisi_x')->nullable();
            $table->integer('posisi_y')->nullable();
            $table->enum('status', ['aktif', 'nonaktif', 'perbaikan'])->default('aktif');
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
