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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_reservasi')->unique();
            // Relasi bisa null jika pelanggan tidak login
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('meja_id')->constrained('meja')->onDelete('cascade');
            $table->string('nama_pelanggan');
            $table->string('telepon_pelanggan');
            $table->date('tanggal_reservasi');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->integer('jumlah_orang');
            $table->enum('status', ['menunggu_konfirmasi', 'dikonfirmasi', 'selesai', 'dibatalkan'])->default('menunggu_konfirmasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
