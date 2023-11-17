<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Authentication Routes
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::post('me', [AuthController::class, 'me']);

Route::middleware('auth.jwt')->group(function () {
    // Barang Routes
    Route::resource('barang', BarangController::class);

    // Penjualan Routes
    Route::resource('penjualan', PenjualanController::class);

    // DetailPenjualan Routes
    Route::resource('detail-penjualan', DetailPenjualanController::class);

    // Rute untuk menampilkan data penjualan berdasarkan range tanggal dengan paginasi
    Route::get('penjualan/by-date-range', [PenjualanController::class, 'indexByDateRange']);
});

// routes/api.php
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
