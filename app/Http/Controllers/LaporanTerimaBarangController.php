<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanTerimaBarang;

class LaporanTerimaBarangController extends Controller
{
    // Tampilkan semua laporan
    public function index()
    {
        $laporanList = LaporanTerimaBarang::with(['supplier', 'transaksi'])->latest()->get();
        return view('supplier.history', compact('laporanList'));
    }

    // Tampilkan detail laporan tertentu
    public function show(LaporanTerimaBarang $laporan)
    {
        $laporan->load('supplier', 'transaksi');
        return view('supplier.show', compact('laporan'));
    }
}
