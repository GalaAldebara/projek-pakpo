<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderPembelianController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\BarangMasukController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Default halaman
Route::get('/', function () {
    return redirect()->route('dashboard'); // langsung arahkan ke login
});

Route::get('/dashboard', [MenuController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');


// Authentication
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit')->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Protected routes (hanya bisa diakses setelah login)
Route::middleware('auth')->group(function () {
    Route::get('/menu', [MenuController::class, 'index'])->name('menu')->middleware('auth');
    Route::resource('suppliers', SupplierController::class);
    Route::resource('items', ItemController::class);
    Route::get('suppliers/{supplier}', [SupplierController::class, 'show'])->name('suppliers.show');
    Route::resource('orders', OrderPembelianController::class);

    // Barang Masuk
    Route::get('/transaksi', [BarangMasukController::class, 'getTransaksi'])->name('transaksi.index');
    Route::get('/barang-masuk/transaksi', [BarangMasukController::class, 'getTransaksiPO']);
    Route::get('/barang-masuk/transaksi/{no_bukti}', [BarangMasukController::class, 'getDetailBarang'])->name('barang-masuk.detail');
    Route::resource('barang-masuk', BarangMasukController::class);
    Route::get('/barang-masuk/create', [BarangMasukController::class, 'create'])->name('barang-masuk.create');
    Route::post('/barang-masuk', [BarangMasukController::class, 'store'])->name('barang-masuk.store');
    Route::get('barang-masuk/{id}/cetak', [BarangMasukController::class, 'cetak'])->name('barang-masuk.cetak');
});
