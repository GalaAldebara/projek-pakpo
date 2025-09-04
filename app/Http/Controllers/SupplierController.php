<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Supplier;
use App\Models\Transaksi;
use App\Models\LaporanTerimaBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    /**
     * Simpan transaksi supplier beserta detail barang
     */
    public function getItems(Supplier $supplier)
    {
        // Ambil semua item dari supplier
        $items = $supplier->items()->select('id', 'kode_item', 'nama_item', 'tgl_kadaluarsa')->get();

        return response()->json($items);
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $items = \App\Models\SupplierItem::all();
        return view('OrderPembelian', compact('suppliers', 'items'));
    }

    /**
     * Generate unique no_bukti with auto increment
     */
    private function generateNoBukti($kodeSupplier)
    {
        $tanggal = Carbon::now()->format('dmY');
        $prefix = 'OR' . $kodeSupplier . $tanggal;

        // Use database lock to prevent race conditions
        return DB::transaction(function () use ($prefix) {
            // Get the last number for today's date with this supplier
            $lastReport = LaporanTerimaBarang::where('no_bukti', 'like', $prefix . '%')
                ->lockForUpdate() // Lock to prevent concurrent access issues
                ->orderBy('no_bukti', 'desc')
                ->first();

            // Extract the last number and increment
            if ($lastReport) {
                $lastNumber = (int)substr($lastReport->no_bukti, -3);
                $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $nextNumber = '001';
            }

            return $prefix . $nextNumber;
        });
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_supplier'       => 'required|string|exists:suppliers,kode_supplier',
            'is_kredit'           => 'required|in:CASH,KREDIT',
            'hari_kredit'         => 'nullable|integer|min:1',
            'discount'            => 'nullable|numeric|min:0|max:100',
            'ppn'                 => 'nullable|numeric|min:0|max:100',
            'pph'                 => 'nullable|numeric|min:0|max:100',
            'barang'              => 'required|array|min:1',
            'barang.*.kode'       => 'required|string',
            'barang.*.nama'       => 'required|string',
            'barang.*.jumlah'     => 'required|integer|min:1',
            'barang.*.satuan'     => 'required|string',
            'barang.*.harga'      => 'required|numeric|min:0',
            'barang.*.total'      => 'required|numeric|min:0',
            'barang.*.tgl_kirim'  => 'required|date',
        ]);

        DB::beginTransaction();
        try {
            // Ambil supplier
            $supplier = Supplier::where('kode_supplier', $validated['kode_supplier'])->firstOrFail();

            // Generate nomor bukti laporan dengan auto increment
            $noBukti = $this->generateNoBukti($validated['kode_supplier']);

            // Simpan laporan terima barang
            $laporan = LaporanTerimaBarang::create([
                'no_bukti'    => $noBukti,
                'supplier_id' => $supplier->id,
            ]);

            // Hitung subtotal
            $subtotal = 0;
            foreach ($validated['barang'] as $item) {
                $subtotal += floatval($item['total']);
            }

            $discount = floatval($validated['discount'] ?? 0);
            $ppn = floatval($validated['ppn'] ?? 0);
            $pph = floatval($validated['pph'] ?? 0);

            // Calculate amounts based on original subtotal (not sequential)
            $discountAmount = ($subtotal * $discount) / 100;
            $ppnAmount = ($subtotal * $ppn) / 100;  // Calculate from original subtotal
            $pphAmount = ($subtotal * $pph) / 100;  // Calculate from original subtotal

            // Calculate final grand total
            // Formula: subtotal - discount + ppn - pph
            $grandTotal = $subtotal - $discountAmount + $ppnAmount - $pphAmount;

            foreach ($validated['barang'] as $item) {
                // Calculate individual item's proportion for financial adjustments
                $itemProportion = floatval($item['total']) / $subtotal;

                // Calculate proportional amounts for this item
                $itemDiscountAmount = $discountAmount * $itemProportion;
                $itemPpnAmount = $ppnAmount * $itemProportion;
                $itemPphAmount = $pphAmount * $itemProportion;

                // Calculate final total for this item
                $itemFinalTotal = floatval($item['total']) - $itemDiscountAmount + $itemPpnAmount - $itemPphAmount;

                Transaksi::create([
                    'supplier_id' => $supplier->id,
                    'no_bukti' => $noBukti, // Add reference to laporan
                    'kode' => $item['kode'],
                    'nama' => $item['nama'],
                    'jumlah' => $item['jumlah'],
                    'satuan' => $item['satuan'],
                    'harga' => $item['harga'],
                    'total' => $itemFinalTotal, // Store the final calculated total
                    'tgl_kirim' => $item['tgl_kirim'],
                    'discount' => $discount,
                    'ppn' => $ppn,
                    'pph' => $pph,
                    'is_kredit' => $validated['is_kredit'],
                    'hari_kredit' => $validated['hari_kredit'],
                ]);
            }

            DB::commit();

            return redirect()
                ->route('supplier.history')
                ->with('success', "Data transaksi berhasil disimpan! No Bukti: {$noBukti}, Grand Total: Rp " . number_format($grandTotal, 2, ',', '.'));
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menyimpan transaksi: ' . $e->getMessage()]);
        }
    }

    /**
     * Tampilkan riwayat transaksi supplier
     */
    public function history()
    {
        $laporanList = \App\Models\LaporanTerimaBarang::with('supplier')->latest()->get();
        return view('supplier.history', compact('laporanList'));
    }

    /**
     * Detail 1 supplier dengan semua transaksi
     */
    public function show(Supplier $supplier)
    {
        $supplier->load(['laporan', 'transaksi']);
        return view('supplier.show', compact('supplier'));
    }

    /**
     * Ambil detail berdasarkan ID
     */
    public function detail($id)
    {
        $supplier = Supplier::with(['laporan', 'transaksi'])->findOrFail($id);
        return view('supplier.detail', compact('supplier'));
    }

    /**
     * Calculate financial summary for preview
     */
    public function calculateSummary(Request $request)
    {
        $barang = $request->input('barang', []);
        $discount = floatval($request->input('discount', 0)) / 100;
        $ppn = floatval($request->input('ppn', 0)) / 100;
        $pph = floatval($request->input('pph', 0)) / 100;

        $subtotal = 0;
        foreach ($barang as $item) {
            $subtotal += floatval($item['total'] ?? 0);
        }

        $grandTotal = $subtotal * (1 - $discount + $ppn - $pph);

        return response()->json([
            'subtotal' => $subtotal,
            'grand_total' => $grandTotal,
            'discount' => $discount * 100,
            'ppn' => $ppn * 100,
            'pph' => $pph * 100,
        ]);
    }

    public function print($no_bukti)
    {
        $laporan = LaporanTerimaBarang::with('supplier')
            ->where('no_bukti', $no_bukti)
            ->firstOrFail();

        $transaksi = Transaksi::where('no_bukti', $no_bukti)->get();

        $subtotal = $transaksi->sum('total');
        $discount = $transaksi->first()->discount ?? 0;
        $ppn = $transaksi->first()->ppn ?? 0;
        $pph = $transaksi->first()->pph ?? 0;

        $discountAmount = ($subtotal * $discount) / 100;
        $ppnAmount = ($subtotal * $ppn) / 100;
        $pphAmount = ($subtotal * $pph) / 100;
        $grandTotal = $subtotal - $discountAmount + $ppnAmount - $pphAmount;

        return view('supplier.print', compact(
            'laporan',
            'transaksi',
            'subtotal',
            'discount',
            'ppn',
            'pph',
            'grandTotal'
        ));
    }
}
