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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan')->unique();
            // Relasi bisa null jika pelanggan tidak login
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            // Relasi bisa null jika pesanan tidak terikat reservasi
            $table->foreignId('reservasi_id')->nullable()->constrained('reservasi')->onDelete('set null');
            $table->string('nama_pelanggan');
            $table->string('telepon_pelanggan');
            $table->decimal('total_harga', 10, 2);
            $table->enum('tipe_pesanan', ['dine_in', 'take_away'])->default('dine_in');
            $table->enum('status', ['keranjang', 'menunggu_pembayaran', 'diproses', 'selesai', 'dibatalkan'])->default('keranjang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
