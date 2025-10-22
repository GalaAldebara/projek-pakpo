<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\BarangMasukDetail;
use App\Models\OrderPembelian;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuk = BarangMasuk::with('supplier')->latest()->get();

        return view('barang-masuk.index', compact('barangMasuk'));
    }

    public function create()
    {
        return view('barang-masuk.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required|exists:suppliers,id',
            'no_bukti' => 'required|string',
            'tanggal_terima' => 'required|date',
            'detail' => 'required|array|min:1',
            'detail.*.kode_barang' => 'required|string',
            'detail.*.nama_barang' => 'required|string',
            'detail.*.jumlah_order' => 'required|numeric|min:1',
            'detail.*.jumlah_terima' => 'required|numeric|min:0',
        ], [
            'supplier_id.required' => 'Supplier wajib dipilih',
            'supplier_id.exists' => 'Supplier tidak ditemukan',
            'no_bukti.required' => 'Nomor bukti (PO) wajib diisi',
            'tanggal_terima.required' => 'Tanggal terima wajib diisi',
            'detail.required' => 'Detail barang wajib diisi',
            'detail.array' => 'Format detail barang tidak valid',
            'detail.min' => 'Minimal harus ada 1 detail barang',
        ]);

        $validator->after(function ($validator) use ($request) {
            if ($request->has('detail')) {
                foreach ($request->detail as $index => $detail) {
                    $namaBarang = $detail['nama_barang'] ?? "Baris " . ($index + 1);
                    $jumlahTerima = $detail['jumlah_terima'] ?? 0;

                    if ($jumlahTerima < 0) {
                        $validator->errors()->add(
                            "detail.$index.jumlah_terima",
                            "Jumlah terima untuk barang '{$namaBarang}' tidak boleh negatif"
                        );
                    }
                }
            }
        });

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Terdapat kesalahan pada input data.');
        }

        DB::beginTransaction();

        try {
            // cek apakah ada jumlah terima < jumlah order
            $isBarangKurang = false;
            foreach ($request->detail as $detail) {
                if ($detail['jumlah_terima'] < $detail['jumlah_order']) {
                    $isBarangKurang = true;
                    break;
                }
            }

            // status barang masuk
            $statusBarangMasuk = $isBarangKurang ? 'BARANG KURANG' : 'DITERIMA';

            // simpan barang masuk
            $barangMasuk = BarangMasuk::create([
                'supplier_id' => $request->supplier_id,
                'no_bukti' => $request->no_bukti,
                'tanggal_terima' => $request->tanggal_terima,
                'surat_jalan' => $request->surat_jalan,
                'status' => $statusBarangMasuk,
                'keterangan' => $request->keterangan,
            ]);

            // simpan detail barang masuk
            foreach ($request->detail as $detail) {
                BarangMasukDetail::create([
                    'barang_masuk_id' => $barangMasuk->id,
                    'order_pembelian_id' => $detail['order_pembelian_id'] ?? null,
                    'kode_barang' => $detail['kode_barang'] ?? '',
                    'nama_barang' => $detail['nama_barang'] ?? '',
                    'jumlah_order' => $detail['jumlah_order'] ?? 0,
                    'jumlah_terima' => $detail['jumlah_terima'] ?? 0,
                    'satuan_id' => $detail['satuan_id'] ?? null,
                    'tgl_kirim' => $detail['tgl_kirim'] ?? null,
                ]);
            }

            // update status order pembelian: cek semua pengiriman untuk PO ini
            $po = OrderPembelian::where('no_bukti', $request->no_bukti)->get();
            foreach ($po as $item) {
                $totalTerima = BarangMasukDetail::where('order_pembelian_id', $item->id)->sum('jumlah_terima');
                if ($totalTerima >= $item->jumlah) {
                    $item->status = 'SELESAI';
                } else {
                    $item->status = 'PROSES';
                }
                $item->save();
            }

            DB::commit();

            return redirect()->route('barang-masuk.index')
                ->with('success', 'Data barang masuk berhasil disimpan dan status PO diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function show($id)
    {
        $barangMasuk = BarangMasuk::with('details', 'supplier')->findOrFail($id);
        return view('barang_masuk.show', compact('barangMasuk'));
    }

    // ✅ API untuk ambil daftar PO (dipakai oleh modal)
    public function getTransaksi()
    {
        try {
            \Log::info('getTransaksi called');
            // Ambil no_bukti yang sudah ada di barang_masuk
            $excludedNoBukti = DB::table('barang_masuk')
                ->whereIn('status', ['BARANG KURANG', 'DITERIMA'])
                ->pluck('no_bukti')
                ->unique()
                ->toArray();

            \Log::info('Excluded no_bukti:', $excludedNoBukti);                

            // ✅ Gunakan DISTINCT dan subquery
            $pesanan = DB::table(DB::raw('(SELECT DISTINCT no_bukti, supplier_id, status, created_at FROM order_pembelian WHERE status = "PROSES") as op'))
                ->join('suppliers', 'suppliers.id', '=', 'op.supplier_id')
                ->select(
                    'op.no_bukti',
                    'op.supplier_id',
                    'suppliers.nama as nama_supplier',
                    'suppliers.kode_supplier',
                    'op.status',
                    'op.created_at'
                )
                ->whereNotIn('op.no_bukti', $excludedNoBukti)
                ->orderBy('op.created_at', 'desc')
                ->get();

            \Log::info('Query result count: ' . $pesanan->count());
            
            return response()->json([
                'success' => true,
                'pesanan' => $pesanan,
            ]);

        } catch (\Exception $e) {
            \Log::error('Error getTransaksi: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
                'pesanan' => []
            ], 500);
        }
    }

    // ✅ API untuk ambil detail PO berdasarkan no_bukti
    public function getDetailBarang($no_bukti)
    {
        $barang = DB::table('order_pembelian')
            ->join('items', 'items.id', '=', 'order_pembelian.item_id')
            ->join('satuan', 'satuan.id', '=', 'order_pembelian.satuan_id')
            ->where('order_pembelian.no_bukti', $no_bukti)
            ->select(
                'items.sku as kode',
                'items.name as nama',
                'order_pembelian.jumlah',
                'satuan.nama as satuan',  // ← INI YANG DIPERBAIKI
                'order_pembelian.satuan_id',
                'order_pembelian.id as order_pembelian_id'
            )
            ->get();

        return response()->json([
            'success' => true,
            'barang' => $barang
        ]);
    }

    public function edit($id)
    {
        $barangMasuk = BarangMasuk::with('details', 'supplier')->findOrFail($id);

        return view('barang-masuk.edit', compact('barangMasuk'));
    }


    public function update(Request $request, $id)
    {
        $barangMasuk = BarangMasuk::with('details')->findOrFail($id);

        // Validasi input
        $rules = [
            'tanggal_terima' => 'required|date',
            'surat_jalan' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'details' => 'required|array|min:1',
        ];

        foreach ($barangMasuk->details as $detail) {
            $rules['details.' . $detail->id . '.jumlah_terima'] = 'required|numeric|min:0';
        }

        $validator = Validator::make($request->all(), $rules, [
            'details.*.jumlah_terima.required' => 'Jumlah terima wajib diisi',
            'details.*.jumlah_terima.numeric' => 'Jumlah terima harus berupa angka',
            'details.*.jumlah_terima.min' => 'Jumlah terima minimal 0',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', 'Terdapat kesalahan pada input.');
        }

        DB::beginTransaction();

        try {
            // Update barang masuk utama
            $barangMasuk->update([
                'tanggal_terima' => $request->tanggal_terima,
                'surat_jalan' => $request->surat_jalan,
                'keterangan' => $request->keterangan,
            ]);

            $allTerima = true; // default semua diterima

            // Update setiap detail
            foreach ($barangMasuk->details as $detail) {
                $jumlahTerima = $request->details[$detail->id]['jumlah_terima'] ?? 0;
                $detail->update([
                    'jumlah_terima' => $jumlahTerima,
                ]);

                if ($jumlahTerima < $detail->jumlah_order) {
                    $allTerima = false;
                }
            }

            // Update status barang_masuk
            $barangMasuk->status = $allTerima ? 'DITERIMA' : 'BARANG KURANG';
            $barangMasuk->save();

            // Update status order_pembelian terkait
            $poStatus = $allTerima ? 'SELESAI' : 'PROSES';
            $noBukti = $barangMasuk->no_bukti;

            OrderPembelian::where('no_bukti', $noBukti)->update(['status' => $poStatus]);

            DB::commit();

            return redirect()->route('barang-masuk.index')
                ->with('success', 'Data barang masuk berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal memperbarui data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function cetak($id)
    {
        $barangMasuk = BarangMasuk::with('details', 'supplier')->findOrFail($id);

        // generate pdf
        $pdf = PDF::loadView('barang-masuk.cetak', compact('barangMasuk'))
            ->setPaper('A4', 'portrait');

        return $pdf->download('struk_barang_masuk_' . $barangMasuk->no_bukti . '.pdf');
    }
}
