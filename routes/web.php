<?php

use App\Livewire\Frontend\HalamanDepan;
use Illuminate\Support\Facades\Route;

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



// Jadikan ini sebagai route utama Anda
Route::get('/', HalamanDepan::class)->name('home');
