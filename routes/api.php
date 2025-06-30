<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DenahController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route untuk mengambil semua meja dalam sebuah denah
Route::get('/denah/{denah}/meja', [DenahController::class, 'getMeja']);


// Route untuk menyimpan posisi baru sebuah meja
Route::post('/meja/{meja}/posisi', [DenahController::class, 'updatePosisiMeja']);
