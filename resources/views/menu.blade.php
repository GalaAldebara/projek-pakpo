@extends('layouts.app')

@section('content')
<style>
    .welcome-header {
        margin-bottom: 2rem;
    }

    .welcome-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 0.5rem;
    }

    .welcome-subtitle {
        color: #6b7280;
        font-size: 0.9375rem;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.5rem;
        transition: all 0.2s ease;
    }

    .stat-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1rem;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .stat-icon.purple {
        background: #eef2ff;
        color: #6366f1;
    }

    .stat-icon.blue {
        background: #eff6ff;
        color: #3b82f6;
    }

    .stat-icon.green {
        background: #f0fdf4;
        color: #10b981;
    }

    .stat-label {
        color: #6b7280;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #1a1a1a;
    }

    .content-section {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .section-title {
        font-size: 1.125rem;
        font-weight: 600;
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
    }

    .table-wrapper {
        overflow-x: auto;
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
    }

    .custom-table td {
        padding: 0.875rem 1rem;
        border-bottom: 1px solid #e5e7eb;
        color: #6b7280;
    }

    .custom-table tbody tr:hover {
        background: #f8f9fa;
    }

    .badge {
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .badge-warning {
        background: #fff7ed;
        color: #f59e0b;
    }

    .badge-success {
        background: #f0fdf4;
        color: #10b981;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #6b7280;
    }

    .empty-state i {
        font-size: 3rem;
        color: #d1d5db;
        margin-bottom: 1rem;
    }

    .alert-custom {
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        border: 1px solid;
    }

    .alert-success {
        background: #f0fdf4;
        border-color: #86efac;
        color: #166534;
    }

    @media (max-width: 768px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .section-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
    }
</style>

<div class="welcome-header">
    <h1 class="welcome-title">Selamat Datang, {{ Auth::user()->name }}</h1>
    <p class="welcome-subtitle">Kelola purchasing order dengan mudah</p>
</div>

<!-- Statistics Cards -->
<div class="dashboard-grid">
    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon purple">
                <i class="bi bi-people-fill"></i>
            </div>
        </div>
        <div class="stat-label">Total Suppliers</div>
        <div class="stat-value">{{ \App\Models\Supplier::count() }}</div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon blue">
                <i class="bi bi-box-seam-fill"></i>
            </div>
        </div>
        <div class="stat-label">Total Items</div>
        <div class="stat-value">{{ \App\Models\Item::count() }}</div>
    </div>

    <div class="stat-card">
        <div class="stat-header">
            <div class="stat-icon green">
                <i class="bi bi-cart-check-fill"></i>
            </div>
        </div>
        <div class="stat-label">Total Orders</div>
        <div class="stat-value">{{ \App\Models\OrderPembelian::count() }}</div>
    </div>
</div>

<!-- Purchase Orders Section -->
<div class="content-section">
    <div class="section-header">
        <h2 class="section-title">Daftar Order Pembelian</h2>
        <a href="{{ route('orders.create') }}" class="btn-primary-custom">
            <i class="bi bi-plus-circle"></i>
            Buat Order Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert-custom alert-success">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
        </div>
    @endif

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
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td><strong>{{ $order->no_bukti }}</strong></td>
                        <td>{{ $order->supplier->nama }}</td>
                        <td>{{ $order->item->name }}</td>
                        <td>{{ $order->jumlah }}</td>
                        <td>{{ $order->satuan->kode ?? '-' }}</td>
                        <td>Rp {{ number_format($order->harga, 0, ',', '.') }}</td>
                        <td><strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong></td>
                        <td>
                            <span class="badge {{ $order->status == 'SELESAI' ? 'badge-success' : 'badge-warning' }}">
                                {{ $order->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <p>Belum ada order pembelian</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
