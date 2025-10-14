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

    .alert-custom {
        padding: 1rem 1.25rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        border: 1px solid;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .alert-success {
        background: #f0fdf4;
        border-color: #86efac;
        color: #166534;
    }

    .alert-success i {
        color: #10b981;
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

    .badge {
        padding: 0.375rem 0.875rem;
        border-radius: 16px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        display: inline-block;
    }

    .badge-warning {
        background: #fef3c7;
        color: #92400e;
    }

    .badge-success {
        background: #d1fae5;
        color: #065f46;
    }

    .no-bukti {
        font-weight: 600;
        color: #6366f1;
    }

    .price-cell {
        font-weight: 600;
        color: #1a1a1a;
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

    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-mini-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
        padding: 1.25rem;
        color: white;
    }

    .stat-mini-card.blue {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }

    .stat-mini-card.green {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .stat-mini-label {
        font-size: 0.8125rem;
        opacity: 0.9;
        margin-bottom: 0.5rem;
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
            padding: 0.75rem;
        }

        .stats-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="page-header">
    <h1 class="page-title">Daftar Order Pembelian</h1>
    <a href="{{ route('orders.create') }}" class="btn-primary-custom">
        <i class="bi bi-plus-circle"></i>
        Buat Order Baru
    </a>
</div>

@if(session('success'))
    <div class="alert-custom alert-success">
        <i class="bi bi-check-circle-fill"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

<!-- Mini Statistics -->
<div class="stats-row">
    <div class="stat-mini-card">
        <div class="stat-mini-label">Total Orders</div>
        <div class="stat-mini-value">{{ $orders->count() }}</div>
    </div>
    <div class="stat-mini-card blue">
        <div class="stat-mini-label">Order Proses</div>
        <div class="stat-mini-value">{{ $orders->where('status', 'PROSES')->count() }}</div>
    </div>
    <div class="stat-mini-card green">
        <div class="stat-mini-label">Order Selesai</div>
        <div class="stat-mini-value">{{ $orders->where('status', 'SELESAI')->count() }}</div>
    </div>
</div>

<div class="content-card">
    <div class="table-wrapper">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>No Bukti</th>
                    <th>Supplier</th>
                    <th>Item</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td class="no-bukti">{{ $order->no_bukti }}</td>
                        <td>{{ $order->supplier->nama }}</td>
                        <td>{{ $order->item->name }}</td>
                        <td>{{ $order->jumlah }}</td>
                        <td>{{ $order->satuan->kode ?? '-' }}</td>
                        <td>Rp {{ number_format($order->harga, 0, ',', '.') }}</td>
                        <td class="price-cell">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge {{ $order->status == 'SELESAI' ? 'badge-success' : 'badge-warning' }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-link text-primary" title="Detail">
                                <i class="bi bi-eye"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <div class="empty-state-title">Belum ada order pembelian</div>
                                <div class="empty-state-text">Klik tombol "Buat Order Baru" untuk membuat order pertama Anda</div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
