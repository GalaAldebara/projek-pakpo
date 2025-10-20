<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\OrderPembelian;
use App\Models\Satuan;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderPembelianController extends Controller
{
    public function index()
    {
        $orders = OrderPembelian::with('supplier', 'item', 'satuan')->latest()->get();

        return view('OrderPembelian.index', compact('orders'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $items = Item::with('satuan')->get();
        return view('OrderPembelian.create', compact('suppliers', 'items'));
    }

    private function generateNoBukti($kodeSupplier)
    {
        $today = now()->format('Ymd');

        $countToday = OrderPembelian::whereDate('created_at', today())
            ->whereHas('supplier', function ($q) use ($kodeSupplier) {
                $q->where('kode_supplier', $kodeSupplier);
            })
            ->count();

        $nextNumber = str_pad($countToday + 1, 4, '0', STR_PAD_LEFT);

        return "PO-{$kodeSupplier}-{$today}-{$nextNumber}";
    }

    public function store(Request $request)
    {
        // Debug: log request data
        Log::info('Request Data:', $request->all());

        $validated = $request->validate([
            'supplier_id'  => 'required|exists:suppliers,id',
            'item_id'      => 'required|array',
            'item_id.*'    => 'required|exists:items,id',
            'jumlah'       => 'required|array',
            'jumlah.*'     => 'required|integer|min:1',
            'harga'        => 'required|array',
            'harga.*'      => 'required|numeric|min:0',
            'tgl_kirim'    => 'required|array',
            'tgl_kirim.*'  => 'required|date',
            'is_kredit'    => 'required|in:CASH,KREDIT',
            'hari_kredit'  => 'nullable|integer|min:1',
            'discount'     => 'nullable|numeric|min:0|max:100',
            'ppn'          => 'nullable|numeric|min:0|max:100',
            'pph'          => 'nullable|numeric|min:0|max:100',
        ]);

        DB::beginTransaction();
        try {
            $supplier = Supplier::findOrFail($validated['supplier_id']);
            $noBukti = $this->generateNoBukti($supplier->kode_supplier);

            $discount = (float) ($validated['discount'] ?? 0);
            $ppn      = (float) ($validated['ppn'] ?? 0);
            $pph      = (float) ($validated['pph'] ?? 0);

            $grandTotal = 0;

            // Filter out empty item_id values
            $validItems = [];
            foreach ($validated['item_id'] as $index => $itemId) {
                if (!empty($itemId)) {
                    $validItems[] = $index;
                }
            }

            if (empty($validItems)) {
                throw new \Exception('Tidak ada item yang valid untuk disimpan');
            }

            foreach ($validItems as $index) {
                $itemId = $validated['item_id'][$index];
                $item = Item::with('satuan')->findOrFail($itemId);

                $jumlah = (int) $validated['jumlah'][$index];
                $harga = (float) $validated['harga'][$index];
                $tglKirim = $validated['tgl_kirim'][$index];

                // Validasi satuan_id dari item
                if (!$item->satuan_id) {
                    throw new \Exception("Item {$item->name} tidak memiliki satuan yang valid");
                }

                $subtotal = $jumlah * $harga;
                $discountAmount = ($subtotal * $discount) / 100;
                $afterDiscount = $subtotal - $discountAmount;
                $ppnAmount = ($afterDiscount * $ppn) / 100;
                $pphAmount = ($afterDiscount * $pph) / 100;
                $total = $afterDiscount + $ppnAmount - $pphAmount;

                $grandTotal += $total;

                $orderData = [
                    'supplier_id' => $supplier->id,
                    'item_id'     => $item->id,
                    'sku'         => $item->sku,
                    'no_bukti'    => $noBukti,
                    'jumlah'      => $jumlah,
                    'satuan_id'   => $item->satuan_id, // Ambil dari item
                    'harga'       => $harga,
                    'total'       => $total,
                    'tgl_kirim'   => $tglKirim,
                    'discount'    => $discount,
                    'ppn'         => $ppn,
                    'pph'         => $pph,
                    'is_kredit'   => $validated['is_kredit'],
                    'hari_kredit' => $validated['hari_kredit'],
                    'status'      => 'PROSES',
                ];

                Log::info('Creating Order:', $orderData);

                OrderPembelian::create($orderData);
            }

            DB::commit();

            return redirect()
                ->route('orders.index')
                ->with('success', "Order berhasil disimpan! No Bukti: {$noBukti}, Grand Total: Rp " . number_format($grandTotal, 2, ',', '.'));
        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::error('Validation Error:', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Store Error:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return back()->withErrors(['error' => 'Gagal menyimpan transaksi: ' . $e->getMessage()])->withInput();
        }
    }

    public function getTransaksi()
    {
        // Ambil no_bukti yang sudah ada di barang_masuk dengan status BARANG KURANG atau DITERIMA
        $excludedNoBukti = DB::table('barang_masuk')
            ->whereIn('status', ['BARANG KURANG', 'DITERIMA'])
            ->pluck('no_bukti')
            ->toArray();

        $pesanan = DB::table('order_pembelian')
            ->join('suppliers', 'suppliers.id', '=', 'order_pembelian.supplier_id')
            ->select(
                'order_pembelian.no_bukti',
                'order_pembelian.supplier_id',
                'suppliers.nama as nama_supplier',
                'suppliers.kode_supplier',
                'order_pembelian.status',
                'order_pembelian.created_at'
            )
            ->where('order_pembelian.status', 'PROSES')
            ->whereNotIn('order_pembelian.no_bukti', $excludedNoBukti)
            ->groupBy(
                'order_pembelian.no_bukti',
                'order_pembelian.supplier_id',
                'suppliers.nama',
                'suppliers.kode_supplier',
                'order_pembelian.status',
                'order_pembelian.created_at'
            )
            ->orderBy('order_pembelian.created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'pesanan' => $pesanan,
            // 'excluded_count' => count($excludedNoBukti) // Optional: untuk tau berapa yang di-exclude
        ]);
    }
}
