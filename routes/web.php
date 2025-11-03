<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\HomePage;
use App\Livewire\MenuPage;
use App\Livewire\ReservasiPage;
use App\Livewire\PembayaranPage;
use App\Livewire\BookingFlow;


// --- Rute Halaman Utama ---
Route::get('/', HomePage::class)->name('homepage');
Route::get('/menu', MenuPage::class)->name('menu.index');
Route::get('/reservasi', ReservasiPage::class)->name('reservasi.index');
Route::get('/pembayaran', PembayaranPage::class)->name('pembayaran.index');

// Rute Sukses Pembayaran
Route::get('/booking', BookingFlow::class)->name('booking.start');

// Rute Sukses Pembayaran
Route::get('/pembayaran/sukses/{kode}', function ($kode) {
    // Memastikan view sukses menggunakan layout yang sama
    return view('pembayaran-sukses', compact('kode'))->layout('components.layouts.app');
})->name('pembayaran.sukses');
