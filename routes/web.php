<?php

// use App\Livewire\Frontend\HalamanDepan;
use Illuminate\Support\Facades\Route;
use App\Livewire\ReservasiComponent;
use App\Livewire\PemesananMenuComponent;
use App\Livewire\PembayaranComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



// Rute Halaman Utama
Route::get('/', function () {
    // Menggunakan Livewire Layout 'app'
    return view('niskala-cafe')->layout('components.layouts.app');
})->name('homepage');

// Rute Komponen Livewire
Route::get('/reservasi', ReservasiComponent::class)->name('reservasi.index');
Route::get('/pesan-menu', PemesananMenuComponent::class)->name('menu.index');
Route::get('/pembayaran', PembayaranComponent::class)->name('pembayaran.index');

// Rute Sukses Pembayaran (Opsional, untuk halaman konfirmasi)
Route::get('/pembayaran/sukses/{kode}', function ($kode) {
    return view('pembayaran-sukses', compact('kode'))->layout('components.layouts.app');
})->name('pembayaran.sukses');
