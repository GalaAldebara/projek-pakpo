@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">History Transaksi Supplier</h2>
        <a href="{{ route('supplier.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Tambah Transaksi
        </a>
    </div>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full border text-sm bg-white shadow-sm">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-3 py-2 text-left">No Bukti</th>
                    <th class="border px-3 py-2 text-left">Tanggal</th>
                    <th class="border px-3 py-2 text-left">Supplier</th>
                    <th class="border px-3 py-2 text-left">Kode Supplier</th>
                    <th class="border px-3 py-2 text-right">Total Items</th>
                    <th class="border px-3 py-2 text-right">Total Transaksi</th>
                    <th class="border px-3 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporanList as $laporan)
                <tr class="hover:bg-gray-50">
                    <td class="border px-3 py-2 font-mono">{{ $laporan->no_bukti }}</td>
                    <td class="border px-3 py-2">{{ $laporan->created_at->format('d-m-Y H:i') }}</td>
                    <td class="border px-3 py-2">{{ $laporan->supplier->nama_supplier ?? '-' }}</td>
                    <td class="border px-3 py-2">{{ $laporan->supplier->kode_supplier ?? '-' }}</td>
                    <td class="border px-3 py-2 text-right">
                        {{ $laporan->transaksi->count() }} items
                    </td>
                    <td class="border px-3 py-2 text-right font-semibold">
                        Rp {{ number_format($laporan->transaksi->sum('total'), 2, ',', '.') }}
                    </td>
                    <td class="border px-3 py-2 text-center">
                        <a href="{{ route('supplier.show', $laporan->id) }}"
                           class="text-blue-500 hover:text-blue-700 hover:underline inline-block px-2 py-1">
                            Detail
                        </a>
                        <span class="text-gray-300">|</span>
                        <a href="{{ route('supplier.detail', $laporan->id) }}"
                           class="text-green-500 hover:text-green-700 hover:underline inline-block px-2 py-1">
                            Print
                        </a>
                        <a href="{{ route('supplier.print', $laporan->no_bukti) }}" target="_blank"
                            class="text-green-600 hover:underline">Cetak
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-8 text-gray-500">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p>Belum ada transaksi.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
            @if($laporanList->count() > 0)
            <tfoot>
                <tr class="bg-gray-100 font-semibold">
                    <td colspan="4" class="border px-3 py-2 text-right">Total Keseluruhan:</td>
                    <td class="border px-3 py-2 text-right">
                        {{ $laporanList->sum(function($laporan) { return $laporan->transaksi->count(); }) }} items
                    </td>
                    <td class="border px-3 py-2 text-right">
                        Rp {{ number_format($laporanList->sum(function($laporan) { return $laporan->transaksi->sum('total'); }), 2, ',', '.') }}
                    </td>
                    <td class="border px-3 py-2"></td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>

    @if($laporanList->count() > 10)
    <div class="mt-4">
        <p class="text-sm text-gray-600">Menampilkan {{ $laporanList->count() }} transaksi</p>
    </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add hover effect for table rows
    const rows = document.querySelectorAll('tbody tr:not(:last-child)');
    rows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f8f9fa';
        });
        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
        });
    });
});
</script>
@endsection
