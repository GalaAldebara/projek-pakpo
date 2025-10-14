<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\OrderPembelian;
use App\Models\Satuan;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class OrderPembelianController extends Controller
{
    public function index()
    {
        $orders = OrderPembelian::with('supplier', 'item', 'satuan')->latest()->get();

        return view('orderpembelian.index', compact('orders'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $items = Item::with('satuan')->get();
        return view('orderpembelian.create', compact('suppliers', 'items',));
    }

    private function generateNoBukti($kodeSupplier)
    {
        $today = now()->format('Ymd');

        $countToday = \App\Models\OrderPembelian::whereDate('created_at', today())
            ->whereHas('supplier', function ($q) use ($kodeSupplier) {
                $q->where('kode_supplier', $kodeSupplier);
            })
            ->count();

        $nextNumber = str_pad($countToday + 1, 4, '0', STR_PAD_LEFT);

        return "PO-{$kodeSupplier}-{$today}-{$nextNumber}";
    }

    public function store(Request $request)
    {

        // dd($request->all());

        $validated = $request->validate([
            'supplier_id'  => 'required|exists:suppliers,id',
            'item_id'      => 'required|exists:items,id',
            'jumlah'       => 'required|integer|min:1',
            'harga'        => 'required|numeric|min:0',
            'tgl_kirim'    => 'required|date',
            'is_kredit'    => 'required|in:CASH,KREDIT',
            'hari_kredit'  => 'nullable|integer|min:1',
            'discount'     => 'nullable|numeric|min:0|max:100',
            'ppn'          => 'nullable|numeric|min:0|max:100',
            'pph'          => 'nullable|numeric|min:0|max:100',
        ]);

        DB::beginTransaction();
        try {
            $supplier = Supplier::findOrFail($validated['supplier_id']);
            $item     = Item::findOrFail($validated['item_id']);

            $noBukti = $this->generateNoBukti($supplier->kode_supplier);

            $jumlah   = (int) $validated['jumlah'];
            $harga    = (float) $validated['harga'];
            $subtotal = $jumlah * $harga;

            $discount = (float) ($validated['discount'] ?? 0);
            $ppn      = (float) ($validated['ppn'] ?? 0);
            $pph      = (float) ($validated['pph'] ?? 0);

            $discountAmount = ($subtotal * $discount) / 100;
            $ppnAmount      = ($subtotal * $ppn) / 100;
            $pphAmount      = ($subtotal * $pph) / 100;

            $total = $subtotal - $discountAmount + $ppnAmount - $pphAmount;

            OrderPembelian::create([
                'supplier_id' => $supplier->id,
                'item_id'     => $item->id,
                'sku'         => $item->sku,
                'no_bukti'    => $noBukti,
                'jumlah'      => $jumlah,
                'satuan_id'   => $item->satuan_id,
                'harga'       => $harga,
                'total'       => $total,
                'tgl_kirim'   => $validated['tgl_kirim'],
                'discount'    => $discount,
                'ppn'         => $ppn,
                'pph'         => $pph,
                'is_kredit'   => $validated['is_kredit'],
                'hari_kredit' => $validated['hari_kredit'],
                'status'      => 'PROSES',
            ]);

            DB::commit();

            return redirect()
                ->route('orders.index')
                ->with('success', "Order berhasil disimpan! No Bukti: {$noBukti}, Total: Rp " . number_format($total, 2, ',', '.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menyimpan transaksi: ' . $e->getMessage()]);
        }
    }

    public function getTransaksi()
    {
        $pesanan = \App\Models\OrderPembelian::with('supplier')
            ->where('status', 'PROSES')
            ->get();

        return response()->json([
            'success' => true,
            'pesanan' => $pesanan
        ]);
    }
}
