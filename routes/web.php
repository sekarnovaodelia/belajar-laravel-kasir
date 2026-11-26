<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;

// Login & logout (bisa diakses tanpa login)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Semua route di bawah ini WAJIB login
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('barang.index');
    });

    Route::resource('jenis', JenisBarangController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('transaksi', TransaksiController::class);
});
