<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\Dashboard\HomeController;
use App\Http\Controllers\Backend\Setting\SettingController;
use App\Http\Controllers\Backend\MejaController;
use App\Http\Controllers\Backend\MenuController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/auth')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('dashboard')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard.index');

    Route::get('/setting/website', [SettingController::class, 'index'])->name('dashboard.setting.index');
    Route::post('/setting/website', [SettingController::class, 'update'])->name('dashboard.setting.update');
    Route::post('/setting/website/logo', [SettingController::class, 'logoChange'])->name('dashboard.setting.logo');
    Route::post('/setting/website/name', [SettingController::class, 'nameChange'])->name('dashboard.setting.name');
})->middleware('auth');

// Setting Website

Route::prefix('meja')->group(function () {
    Route::get('/', [MejaController::class, 'index'])->name('meja.index');
    Route::post('/store', [MejaController::class, 'store'])->name('meja.store');
    Route::post('/update-posisi', [MejaController::class, 'updatePosisi'])->name('meja.update.posisi');
    Route::get('/edit/{id}', [MejaController::class, 'edit'])->name('meja.edit');
    Route::put('/update/{id}', [MejaController::class, 'update'])->name('meja.update');
    Route::delete('/destroy/{id}', [MejaController::class, 'destroy'])->name('meja.destroy');
});


Route::prefix('menu')->group(function () {
    Route::get('/', [MenuController::class, 'index'])->name('menu.index');
    Route::get('/create', [MenuController::class, 'create'])->name('menu.create');
    Route::post('/store', [MenuController::class, 'store'])->name('menu.store');
    Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
    Route::put('/update/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::delete('/destroy/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');
});
