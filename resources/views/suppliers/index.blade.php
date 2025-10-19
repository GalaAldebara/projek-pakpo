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

    .supplier-code {
        font-weight: 600;
        color: #6366f1;
        font-family: 'Courier New', monospace;
    }

    .supplier-name {
        font-weight: 600;
        color: #1a1a1a;
    }

    .badge-count {
        background: #eef2ff;
        color: #6366f1;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .btn-detail {
        background: #eff6ff;
        color: #3b82f6;
        border: 1px solid #bfdbfe;
        padding: 0.375rem 0.875rem;
        border-radius: 6px;
        font-size: 0.8125rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
    }

    .btn-detail:hover {
        background: #dbeafe;
        border-color: #93c5fd;
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

    /* Modal Styles */
    .modal-content {
        border-radius: 12px;
        border: none;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .modal-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 12px 12px 0 0;
        border-bottom: none;
    }

    .modal-header .modal-title {
        font-weight: 600;
        font-size: 1.125rem;
    }

    .modal-header .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.8;
    }

    .modal-header .btn-close:hover {
        opacity: 1;
    }

    .modal-body {
        padding: 2rem;
    }

    .info-row {
        display: flex;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f3f4f6;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #374151;
        min-width: 120px;
    }

    .info-value {
        color: #6b7280;
    }

    .section-divider {
        border-top: 2px solid #f3f4f6;
        margin: 1.5rem 0;
        padding-top: 1.5rem;
    }

    .section-title-modal {
        font-size: 1rem;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .search-box {
        position: relative;
        margin-bottom: 1rem;
    }

    .search-box input {
        width: 100%;
        padding: 0.625rem 1rem;
        padding-left: 2.5rem;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }

    .search-box input:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .search-box i {
        position: absolute;
        left: 0.875rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }

    .modal-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.875rem;
    }

    .modal-table thead {
        background: #f8f9fa;
    }

    .modal-table th {
        padding: 0.75rem;
        text-align: left;
        font-weight: 600;
        color: #374151;
        border-bottom: 2px solid #e5e7eb;
        font-size: 0.8125rem;
    }

    .modal-table td {
        padding: 0.75rem;
        border-bottom: 1px solid #f3f4f6;
        color: #6b7280;
    }

    .modal-table tbody tr:hover {
        background: #f9fafb;
    }

    .modal-footer {
        padding: 1.25rem 2rem;
        border-top: 1px solid #e5e7eb;
    }

    .btn-modal-close {
        background: #f3f4f6;
        color: #374151;
        border: none;
        padding: 0.625rem 1.5rem;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-modal-close:hover {
        background: #e5e7eb;
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
            padding: 0.75rem;
        }

        .stats-mini {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="page-header">
    <h1 class="page-title">Daftar Supplier</h1>
    <a href="{{ route('suppliers.create') }}" class="btn-primary-custom">
        <i class="bi bi-plus-circle"></i>
        Tambah Supplier
    </a>
</div>

@if(session('success'))
    <div class="alert-custom alert-success">
        <i class="bi bi-check-circle-fill"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

<!-- Mini Statistics -->
<div class="stats-mini">
    <div class="stat-mini-card">
        <div class="stat-mini-label">Total Suppliers</div>
        <div class="stat-mini-value">{{ $suppliers->count() }}</div>
    </div>
</div>

<div class="content-card">
    <div class="table-wrapper">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                    <th>Jumlah Item</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suppliers as $supplier)
                    <tr>
                        <td>
                            <span class="supplier-code">{{ $supplier->kode_supplier }}</span>
                        </td>
                        <td>
                            <span class="supplier-name">{{ $supplier->nama }}</span>
                        </td>
                        <td>{{ $supplier->alamat ?? '-' }}</td>
                        <td>{{ $supplier->no_telp ?? '-' }}</td>
                        <td>
                            <span class="badge-count">{{ $supplier->items->count() }} items</span>
                        </td>
                        <td>
                            <button type="button"
                                    class="btn-detail"
                                    data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $supplier->id }}">
                                <i class="bi bi-eye"></i>
                                Detail
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <div class="empty-state-title">Belum ada supplier</div>
                                <div class="empty-state-text">Klik tombol "Tambah Supplier" untuk menambahkan supplier baru</div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Detail Supplier -->
@foreach($suppliers as $supplier)
<div class="modal fade" id="detailModal{{ $supplier->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-building me-2"></i>
                    Detail Supplier: {{ $supplier->nama }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Supplier Info -->
                <div class="info-row">
                    <span class="info-label">Kode Supplier:</span>
                    <span class="info-value supplier-code">{{ $supplier->kode_supplier }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nama:</span>
                    <span class="info-value">{{ $supplier->nama }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Alamat:</span>
                    <span class="info-value">{{ $supplier->alamat ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">No. Telepon:</span>
                    <span class="info-value">{{ $supplier->no_telp ?? '-' }}</span>
                </div>

                <!-- Items Section -->
                <div class="section-divider">
                    <div class="section-title-modal">
                        <i class="bi bi-box-seam"></i>
                        <span>Daftar Item ({{ $supplier->items->count() }})</span>
                    </div>

                    @if($supplier->items->count() > 0)
                        <div class="search-box">
                            <i class="bi bi-search"></i>
                            <input type="text"
                                   class="form-control"
                                   placeholder="Cari item berdasarkan SKU atau nama..."
                                   onkeyup="filterItems(this, 'tableItems{{ $supplier->id }}')">
                        </div>

                        <table class="modal-table" id="tableItems{{ $supplier->id }}">
                            <thead>
                                <tr>
                                    <th style="width: 30%;">SKU</th>
                                    <th>Nama Item</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($supplier->items as $item)
                                    <tr>
                                        <td>
                                            <span class="supplier-code">{{ $item->sku }}</span>
                                        </td>
                                        <td>{{ $item->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="empty-state" style="padding: 2rem 1rem;">
                            <i class="bi bi-inbox" style="font-size: 3rem;"></i>
                            <div class="empty-state-title" style="font-size: 1rem;">Belum ada item</div>
                            <div class="empty-state-text">Supplier ini belum memiliki item terdaftar</div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modal-close" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@push('scripts')
<script>
    function filterItems(input, tableId) {
        let filter = input.value.toLowerCase();
        let rows = document.querySelectorAll(`#${tableId} tbody tr`);

        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    }
</script>
@endpush
