<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\HomePage;
use App\Livewire\MenuPage;
use App\Livewire\ReservasiPage;
use App\Livewire\PembayaranPage;
use App\Livewire\BookingFlow;
use App\Livewire\MejaTester; // Import komponen pengujian


// --- Rute Halaman Utama ---
Route::get('/', HomePage::class)->name('homepage');
Route::get('/menu', MenuPage::class)->name('menu.index');
Route::get('/reservasi', ReservasiPage::class)->name('reservasi.index');
Route::get('/pembayaran', PembayaranPage::class)->name('pembayaran.index');


Route::get('/test/meja-render', MejaTester::class)->name('test.meja');

// Rute Sukses Pembayaran
Route::get('/booking', BookingFlow::class)->name('booking.start');

// Rute Sukses Pembayaran
Route::get('/pembayaran/sukses/{kode}', function ($kode) {
    // Memastikan view sukses menggunakan layout yang sama
    return view('pembayaran-sukses', compact('kode'))->layout('components.layouts.app');
})->name('pembayaran.sukses');
