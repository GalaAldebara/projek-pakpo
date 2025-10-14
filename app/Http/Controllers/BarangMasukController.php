<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\BarangMasukDetail;
use App\Models\OrderPembelian;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        // Validasi dengan pesan custom dalam bahasa Indonesia
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required|exists:suppliers,id',
            'no_bukti' => 'required|string',
            'tanggal_terima' => 'required|date',
            'status' => 'required|in:PENDING,DITERIMA,SELESAI',
            'detail' => 'required|array|min:1',
            'detail.*.kode_barang' => 'required|string',
            'detail.*.nama_barang' => 'required|string',
            'detail.*.jumlah_terima' => 'required|numeric|min:1',
        ], [
            // Custom messages untuk field utama
            'supplier_id.required' => 'Supplier wajib dipilih',
            'supplier_id.exists' => 'Supplier tidak ditemukan dalam database',
            'no_bukti.required' => 'Nomor bukti (PO) wajib diisi',
            'tanggal_terima.required' => 'Tanggal terima wajib diisi',
            'tanggal_terima.date' => 'Format tanggal terima tidak valid',
            'status.required' => 'Status wajib dipilih',
            'status.in' => 'Status harus PENDING, DITERIMA, atau SELESAI',

            // Custom messages untuk detail array
            'detail.required' => 'Detail barang wajib diisi',
            'detail.array' => 'Format detail barang tidak valid',
            'detail.min' => 'Minimal harus ada 1 detail barang',

            // Custom messages untuk setiap field dalam detail
            'detail.*.kode_barang.required' => 'Kode barang pada baris :position wajib diisi',
            'detail.*.nama_barang.required' => 'Nama barang pada baris :position wajib diisi',
            'detail.*.jumlah_terima.required' => 'Jumlah terima pada baris :position wajib diisi',
            'detail.*.jumlah_terima.numeric' => 'Jumlah terima pada baris :position harus berupa angka',
            'detail.*.jumlah_terima.min' => 'Jumlah terima pada baris :position minimal 1 (tidak boleh 0)',
        ]);

        // Custom validation untuk menampilkan nama barang di error message
        $validator->after(function ($validator) use ($request) {
            if ($request->has('detail')) {
                foreach ($request->detail as $index => $detail) {
                    $namaBarang = $detail['nama_barang'] ?? "Baris " . ($index + 1);
                    $jumlahTerima = $detail['jumlah_terima'] ?? 0;

                    if ($jumlahTerima <= 0) {
                        $validator->errors()->add(
                            "detail.$index.jumlah_terima",
                            "Jumlah terima untuk barang '{$namaBarang}' tidak boleh 0 atau kosong"
                        );
                    }
                }
            }
        });

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terdapat kesalahan pada input data. Silakan periksa kembali.');
        }

        DB::beginTransaction();

        try {
            // Simpan data barang masuk utama
            $barangMasuk = BarangMasuk::create([
                'supplier_id' => $request->supplier_id,
                'no_bukti' => $request->no_bukti,
                'tanggal_terima' => $request->tanggal_terima,
                'surat_jalan' => $request->surat_jalan,
                'status' => $request->status,
                'keterangan' => $request->keterangan,
            ]);

            // Simpan detail barang masuk
            foreach ($request->detail as $detail) {
                BarangMasukDetail::create([
                    'barang_masuk_id' => $barangMasuk->id,
                    'kode_barang' => $detail['kode_barang'] ?? '',
                    'nama_barang' => $detail['nama_barang'] ?? '',
                    'jumlah_order' => $detail['jumlah_order'] ?? 0,
                    'jumlah_terima' => $detail['jumlah_terima'] ?? 0,
                    'satuan_id' => $detail['satuan_id'] ?? null,
                    'tgl_kirim' => $detail['tgl_kirim'] ?? null,
                ]);
            }

            // Update status order_pembelian terkait
            OrderPembelian::where('no_bukti', $request->no_bukti)
                ->update(['status' => 'SELESAI']);

            DB::commit();

            return redirect()->route('barang-masuk.index')
                ->with('success', 'Data barang masuk berhasil disimpan dan status PO diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()
                ->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function show($id)
    {
        $barangMasuk = BarangMasuk::with('details', 'supplier')->findOrFail($id);
        return view('barang_masuk.show', compact('barangMasuk'));
    }

    // ✅ API untuk ambil daftar PO (dipakai oleh modal)
    public function getTransaksiPO()
    {
        $pesanan = OrderPembelian::with('supplier')
            ->where('status', 'PROSES')
            ->get();

        return response()->json([
            'success' => true,
            'pesanan' => $pesanan
        ]);
    }

    // ✅ API untuk ambil detail PO berdasarkan no_bukti
    public function getDetailBarang($no_bukti)
    {
        $barang = OrderPembelian::with('item.satuan')
            ->where('no_bukti', $no_bukti)
            ->get()
            ->map(function ($po) {
                return [
                    'kode' => $po->item->sku ?? '',
                    'nama' => $po->item->name ?? '',
                    'jumlah' => $po->jumlah ?? 0,
                    'satuan' => $po->item->satuan->nama_satuan ?? '',
                ];
            });

        return response()->json([
            'success' => true,
            'barang' => $barang
        ]);
    }
}
