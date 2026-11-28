<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StokMasukController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| ROUTE TANPA LOGIN (GUEST)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


/*
|--------------------------------------------------------------------------
| ROUTE WAJIB LOGIN (AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('pelanggan', PelangganController::class);

    // --- PINDAHKAN RUTE KHUSUS KE ATAS RESOURCE ---
    Route::get('transaksi/laporan', [TransaksiController::class, 'laporan'])->name('transaksi.laporan');
    Route::get('transaksi/export-pdf', [TransaksiController::class, 'exportPdf'])->name('transaksi.exportPdf');
    Route::get('transaksi/{id}/struk', [TransaksiController::class, 'struk'])->name('transaksi.struk');
    
    Route::post('transaksi/cart/tambah', [TransaksiController::class, 'tambahKeCart'])->name('transaksi.cart.tambah');
    Route::delete('transaksi/cart/hapus/{id}', [TransaksiController::class, 'hapusCart'])->name('transaksi.cart.hapus');

    // RESOURCE DILETAKKAN PALING BAWAH
    Route::resource('transaksi', TransaksiController::class);
    // ----------------------------------------------

    Route::middleware('role:admin')->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('jenis', JenisBarangController::class);
        Route::resource('barang', BarangController::class);
        Route::resource('supplier', SupplierController::class);
        Route::get('stok-masuk', [StokMasukController::class, 'index'])->name('stok-masuk.index');
        Route::get('stok-masuk/create', [StokMasukController::class, 'create'])->name('stok-masuk.create');
        Route::post('stok-masuk', [StokMasukController::class, 'store'])->name('stok-masuk.store');
    });
});