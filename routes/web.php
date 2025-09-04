<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\LaporanTerimaBarangController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

use App\Http\Controllers\Auth\LoginController;

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/supplier/calculate-summary', [SupplierController::class, 'calculateSummary'])->name('supplier.calculate-summary');
Route::get('/supplier/{supplier}/items', [SupplierController::class, 'getItems']);
Route::get('/OrderPembelian', [SupplierController::class, 'create'])->name('supplier.create');
Route::post('/supplier/store', [SupplierController::class, 'store'])->name('supplier.store');
Route::get('/supplier/history', [SupplierController::class, 'history'])->name('supplier.history');
Route::get('/supplier/{id}/detail', [SupplierController::class, 'detail'])->name('supplier.detail');
Route::get('/supplier/{id}', [SupplierController::class, 'show'])->name('supplier.show');

// Laporan
Route::get('/supplier/history', [LaporanTerimaBarangController::class, 'index'])->name('supplier.history');
Route::get('/supplier/{laporan}', [LaporanTerimaBarangController::class, 'show'])->name('supplier.show');
Route::get('/supplier/print/{no_bukti}', [SupplierController::class, 'print'])->name('supplier.print');


Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
