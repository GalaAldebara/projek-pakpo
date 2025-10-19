@extends('layouts.app')

@section('content')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
    }

    .btn-primary-custom {
        background: #6366f1;
        color: white;
        border: none;
        padding: 0.625rem 1.25rem;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s ease;
    }

    .btn-primary-custom:hover {
        background: #4f46e5;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .content-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .table-wrapper {
        overflow-x: auto;
        margin-top: 1rem;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }

    .custom-table thead {
        background: #f8f9fa;
    }

    .custom-table th {
        padding: 0.875rem 1rem;
        text-align: left;
        font-weight: 600;
        color: #1a1a1a;
        border-bottom: 2px solid #e5e7eb;
        white-space: nowrap;
        font-size: 0.8125rem;
        text-transform: uppercase;
        letter-spacing: 0.025em;
    }

    .custom-table td {
        padding: 1rem;
        border-bottom: 1px solid #e5e7eb;
        color: #374151;
        vertical-align: top;
    }

    .custom-table tbody tr {
        transition: background-color 0.15s ease;
    }

    .custom-table tbody tr:hover {
        background: #f9fafb;
    }

    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }

    .no-bukti {
        font-weight: 600;
        color: #6366f1;
        font-family: 'Courier New', monospace;
    }

    .supplier-code {
        font-weight: 600;
        color: #374151;
        font-family: 'Courier New', monospace;
        font-size: 0.8125rem;
    }

    .badge {
        padding: 0.375rem 0.875rem;
        border-radius: 16px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        display: inline-block;
    }

    .badge-success {
        background: #d1fae5;
        color: #065f46;
    }

    .badge-warning {
        background: #fef3c7;
        color: #92400e;
    }

    .badge-secondary {
        background: #f3f4f6;
        color: #374151;
    }

    .item-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .item-list li {
        padding: 0.375rem 0;
        border-bottom: 1px solid #f3f4f6;
    }

    .item-list li:last-child {
        border-bottom: none;
    }

    .item-name {
        font-weight: 600;
        color: #1a1a1a;
        display: block;
        margin-bottom: 0.25rem;
    }

    .item-quantity {
        font-size: 0.8125rem;
        color: #6b7280;
    }

    .item-quantity .qty-label {
        font-weight: 500;
    }

    .date-cell {
        white-space: nowrap;
        font-size: 0.8125rem;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .btn-action {
        padding: 0.375rem 0.875rem;
        border-radius: 6px;
        font-size: 0.8125rem;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-edit {
        background: #eff6ff;
        color: #3b82f6;
        border: 1px solid #bfdbfe;
    }

    .btn-edit:hover {
        background: #dbeafe;
        border-color: #93c5fd;
        color: #2563eb;
    }

    .btn-print {
        background: #f0fdf4;
        color: #10b981;
        border: 1px solid #86efac;
    }

    .btn-print:hover {
        background: #dcfce7;
        border-color: #4ade80;
        color: #059669;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #6b7280;
    }

    .empty-state i {
        font-size: 4rem;
        color: #d1d5db;
        margin-bottom: 1.5rem;
        display: block;
    }

    .empty-state-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .empty-state-text {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .stats-mini {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .stat-mini-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
        padding: 1rem;
        color: white;
    }

    .stat-mini-card.green {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .stat-mini-card.orange {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    .stat-mini-card.gray {
        background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
    }

    .stat-mini-label {
        font-size: 0.8125rem;
        opacity: 0.9;
        margin-bottom: 0.375rem;
    }

    .stat-mini-value {
        font-size: 1.5rem;
        font-weight: 700;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .custom-table {
            font-size: 0.8125rem;
        }

        .custom-table th,
        .custom-table td {
            padding: 0.75rem 0.5rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }

        .stats-mini {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="page-header">
    <h1 class="page-title">Daftar Barang Masuk</h1>
    <a href="{{ route('barang-masuk.create') }}" class="btn-primary-custom">
        <i class="bi bi-plus-circle"></i>
        Tambah Barang Masuk
    </a>
</div>

<!-- Mini Statistics -->
<div class="stats-mini">
    <div class="stat-mini-card">
        <div class="stat-mini-label">Total Barang Masuk</div>
        <div class="stat-mini-value">{{ $barangMasuk->count() }}</div>
    </div>
    <div class="stat-mini-card green">
        <div class="stat-mini-label">Diterima</div>
        <div class="stat-mini-value">{{ $barangMasuk->where('status', 'DITERIMA')->count() }}</div>
    </div>
    <div class="stat-mini-card orange">
        <div class="stat-mini-label">Barang Kurang</div>
        <div class="stat-mini-value">{{ $barangMasuk->where('status', 'BARANG KURANG')->count() }}</div>
    </div>
    <div class="stat-mini-card gray">
        <div class="stat-mini-label">Belum Diterima</div>
        <div class="stat-mini-value">{{ $barangMasuk->where('status', 'BELUM DITERIMA')->count() }}</div>
    </div>
</div>

<div class="content-card">
    <div class="table-wrapper">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>No Bukti</th>
                    <th>Supplier</th>
                    <th>Gudang</th>
                    <th>Tgl Terima</th>
                    <th>Surat Jalan</th>
                    <th>Status</th>
                    <th>Item</th>
                    <th>Keterangan</th>
                    <th>Tgl Input</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barangMasuk as $bm)
                    <tr>
                        <td>
                            <span class="no-bukti">{{ $bm->no_bukti }}</span>
                        </td>
                        <td>
                            <div>
                                <span class="supplier-code">{{ $bm->supplier->kode_supplier ?? '-' }}</span>
                            </div>
                            <div style="font-weight: 600; color: #1a1a1a; margin-top: 0.25rem;">
                                {{ $bm->supplier->nama ?? '-' }}
                            </div>
                        </td>
                        <td>{{ $bm->gudang ?? '-' }}</td>
                        <td class="date-cell">
                            {{ \Carbon\Carbon::parse($bm->tanggal_terima)->format('d M Y') }}
                        </td>
                        <td>{{ $bm->surat_jalan ?? '-' }}</td>
                        <td>
                            @if($bm->status == 'DITERIMA')
                                <span class="badge badge-success">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Diterima
                                </span>
                            @elseif($bm->status == 'BARANG KURANG')
                                <span class="badge badge-warning">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    Barang Kurang
                                </span>
                            @elseif($bm->status == 'BELUM DITERIMA')
                                <span class="badge badge-secondary">
                                    <i class="bi bi-clock me-1"></i>
                                    Belum Diterima
                                </span>
                            @else
                                <span class="badge badge-secondary">-</span>
                            @endif
                        </td>
                        <td>
                            <ul class="item-list">
                                @foreach($bm->details as $detail)
                                    <li>
                                        <span class="item-name">{{ $detail->nama_barang }}</span>
                                        <span class="item-quantity">
                                            <span class="qty-label">Order:</span> {{ $detail->jumlah_order }} |
                                            <span class="qty-label">Terima:</span> {{ $detail->jumlah_terima }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $bm->keterangan ?? '-' }}</td>
                        <td class="date-cell">
                            {{ $bm->created_at->format('d M Y') }}
                            <div style="color: #9ca3af; font-size: 0.75rem;">
                                {{ $bm->created_at->format('H:i') }}
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('barang-masuk.edit', $bm->id) }}" class="btn-action btn-edit">
                                    <i class="bi bi-pencil"></i>
                                    Edit
                                </a>
                                <a href="{{ route('barang-masuk.cetak', $bm->id) }}"
                                   class="btn-action btn-print"
                                   target="_blank">
                                    <i class="bi bi-printer"></i>
                                    Cetak
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <div class="empty-state-title">Belum ada data barang masuk</div>
                                <div class="empty-state-text">Klik tombol "Tambah Barang Masuk" untuk menambahkan data baru</div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
