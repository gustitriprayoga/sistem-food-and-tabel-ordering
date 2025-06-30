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
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('meja_id')->nullable()->constrained('mejas');

            $table->date('tanggal_reservasi');
            $table->time('waktu_reservasi');
            $table->integer('jumlah_orang')->nullable();
            $table->text('catatan')->nullable();

            // Detail Pembayaran
            $table->unsignedBigInteger('total_bayar');
            $table->enum('metode_pembayaran', ['kasir', 'transfer_bank', 'e_wallet']);
            $table->enum('status_pembayaran', [
                'pending', // Belum bayar
                'menunggu_konfirmasi', // Sudah upload bukti, menunggu verifikasi admin
                'lunas', // Dikonfirmasi lunas oleh admin
                'dibatalkan' // Pesanan dibatalkan
            ])->default('pending');
            $table->string('bukti_pembayaran')->nullable()->comment('Path ke file bukti pembayaran');

            // Detail Status Pesanan
            $table->enum('tipe_pesanan', ['makan_ditempat', 'bawa_pulang'])->default('makan_ditempat');
            $table->enum('status', ['pending', 'dikonfirmasi', 'selesai', 'dibatalkan'])->default('pending');

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
