<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Item;
use App\Models\Satuan;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        $satuan = Satuan::all();
        return view('suppliers.create', compact('satuan'));
    }

    public function store(Request $request)
    {
        // ---- DEBUG (sementara) ----
        // Kalau masih error, uncomment baris di bawah untuk melihat payload yang dikirim form
        // dd($request->all());
        // ---------------------------

        $request->validate([
            'nama'       => 'required|string|max:255',
            'alamat'     => 'nullable|string|max:255',
            'no_telp'    => 'nullable|string|max:50',
            // item opsional — jika item_name diisi, satuan_id wajib
            'item_name'  => 'nullable|string|max:255',
            'satuan_id'  => 'required_with:item_name|exists:satuan,id',
        ]);

        $lastId = Supplier::max('id') ?? 0;
        $kodeSupplier = 'SUP-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

        $supplier = Supplier::create([
            'nama'          => $request->nama,
            'kode_supplier' => $kodeSupplier,
            'alamat'        => $request->alamat,
            'no_telp'       => $request->no_telp,
        ]);

        if ($request->filled('item_name')) {
            $lastItemId = Item::max('id') ?? 0;
            $sku = 'ITEM-' . str_pad($lastItemId + 1, 4, '0', STR_PAD_LEFT);

            Item::create([
                'supplier_id' => $supplier->id,
                'name'        => $request->item_name,
                'sku'         => $sku,
                'satuan_id'   => $request->satuan_id, // ini wajib karena validasi required_with memastikan ada
            ]);
        }

        return redirect()->route('suppliers.index')
            ->with('success', 'Supplier berhasil ditambahkan');
    }


    public function show(Supplier $supplier)
    {
        $supplier->load('items');

        return view('suppliers.show', compact('supplier'));
    }
}
