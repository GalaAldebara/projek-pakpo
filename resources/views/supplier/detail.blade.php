@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    @if(!empty($laporan))
        <h3 class="text-lg font-bold mb-2">
            Detail Transaksi — No Bukti: {{ $laporan->no_bukti }}
        </h3>

        <table class="w-full border text-sm">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-2 py-1">Kode</th>
                    <th class="border px-2 py-1">Nama Item</th>
                    <th class="border px-2 py-1">Jumlah</th>
                    <th class="border px-2 py-1">Satuan</th>
                    <th class="border px-2 py-1">Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $item)
                <tr>
                    <td class="border px-2 py-1">{{ $item->kode }}</td>
                    <td class="border px-2 py-1">{{ $item->nama }}</td>
                    <td class="border px-2 py-1 text-right">{{ $item->jumlah }}</td>
                    <td class="border px-2 py-1">{{ $item->satuan }}</td>
                    <td class="border px-2 py-1 text-right">
                        {{ number_format($item->total, 2, ',', '.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-2">Tidak ada item.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

    @else
        <h3 class="text-lg font-bold mb-2">Laporan untuk Supplier: {{ $supplier->nama_supplier ?? '-' }}</h3>
        <table class="w-full border text-sm">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-2 py-1">No Bukti</th>
                    <th class="border px-2 py-1">Tanggal</th>
                    <th class="border px-2 py-1">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporanList as $lp)
                <tr>
                    <td class="border px-2 py-1">{{ $lp->no_bukti }}</td>
                    <td class="border px-2 py-1">{{ $lp->created_at->format('d-m-Y') }}</td>
                    <td class="border px-2 py-1">
                        <a href="{{ route('supplier.show', $supplier->id) }}?no_bukti={{ $lp->no_bukti }}" class="text-blue-500 hover:underline">Lihat Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-2">Belum ada laporan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    @endif
</div>
@endsection
