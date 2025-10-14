<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderPembelian;

class MenuController extends Controller
{
    public function index()
    {
        $orders = OrderPembelian::with('supplier', 'item', 'satuan')
            ->latest()
            ->get();

        return view('menu', compact('orders'));
    }
}
