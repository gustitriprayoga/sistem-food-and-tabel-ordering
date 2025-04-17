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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('meja_id')->constrained()->onDelete('cascade');
            $table->integer('total_harga');
            $table->enum('metode_pembayaran', ['cod', 'manual']);
            $table->enum('status_pembayaran', ['tertunda', 'lunas']);
            $table->enum('pesanan_status', ['tertunda', 'proses', 'selesai', 'kadaluarsa']);
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
