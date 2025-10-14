<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Supplier;
use App\Models\Satuan;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $satuan   = Satuan::all();
        return view('items.create', compact('suppliers', 'satuan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'supplier_id' => 'required|exists:suppliers,id',
            'satuan_id'   => 'required|exists:satuan,id',
        ]);

        \App\Models\Item::create($request->all());

        return redirect()->route('menu')->with('success', 'Item berhasil ditambahkan');
    }
}
