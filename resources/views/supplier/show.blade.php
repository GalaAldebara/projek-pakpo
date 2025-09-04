@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-xl font-bold mb-4">
        Detail Transaksi: {{ $supplier->no_bukti }}
    </h2>

    <div class="mb-4">
        <p><strong>Kode Supplier:</strong> {{ $supplier->kode_supplier }}</p>
        <p><strong>Gudang:</strong> {{ $supplier->gudang }}</p>
        <p><strong>Pembayaran:</strong> {{ $supplier->is_kredit ? 'Kredit' : 'Cash' }}</p>
        <p><strong>Hari Kredit:</strong> {{ $supplier->hari_kredit ?? '-' }}</p>
        <p><strong>Total Transaksi:</strong> {{ number_format($supplier->total, 2) }}</p>
    </div>

    <h3 class="text-lg font-semibold mb-2">Detail Barang</h3>
    <table class="w-full border text-sm">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-2 py-1">Kode</th>
                <th class="border px-2 py-1">Nama</th>
                <th class="border px-2 py-1">Jumlah</th>
                <th class="border px-2 py-1">Satuan</th>
                <th class="border px-2 py-1">Harga</th>
                <th class="border px-2 py-1">Total</th>
                <th class="border px-2 py-1">Tgl Kirim</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($supplier->items as $item)
                <tr>
                    <td class="border px-2 py-1">{{ $item->kode }}</td>
                    <td class="border px-2 py-1">{{ $item->nama }}</td>
                    <td class="border px-2 py-1">{{ $item->jumlah }}</td>
                    <td class="border px-2 py-1">{{ $item->satuan }}</td>
                    <td class="border px-2 py-1">{{ number_format($item->harga, 2) }}</td>
                    <td class="border px-2 py-1">{{ number_format($item->total, 2) }}</td>
                    <td class="border px-2 py-1">{{ $item->tgl_kirim }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
