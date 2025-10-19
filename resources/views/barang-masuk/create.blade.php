@extends('layouts.app')

@section('content')
<style>
    .page-header {
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 0.5rem;
    }

    .breadcrumb-custom {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: #6b7280;
        margin-bottom: 1rem;
    }

    .breadcrumb-custom a {
        color: #6366f1;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .breadcrumb-custom a:hover {
        color: #4f46e5;
    }

    .form-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem;
    }

    .section-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f3f4f6;
    }

    .section-title i {
        color: #6366f1;
        font-size: 1.25rem;
    }

    .alert-custom {
        padding: 1rem 1.25rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        border: 1px solid;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .alert-success {
        background: #f0fdf4;
        border-color: #86efac;
        color: #166534;
    }

    .alert-error {
        background: #fef2f2;
        border-color: #fecaca;
        color: #991b1b;
    }

    .alert-custom i {
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .alert-success i {
        color: #10b981;
    }

    .alert-error i {
        color: #dc2626;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 0;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .form-label .required {
        color: #dc2626;
        margin-left: 0.25rem;
    }

    .form-label .optional {
        color: #9ca3af;
        font-weight: 400;
        font-size: 0.8125rem;
    }

    .form-control-custom {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 0.9375rem;
        transition: all 0.2s ease;
        background: #ffffff;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .form-control-custom:read-only {
        background: #f9fafb;
        color: #6b7280;
    }

    .form-control-custom.error {
        border-color: #dc2626;
        background: #fef2f2;
    }

    .input-group {
        display: flex;
        gap: 0.75rem;
    }

    .input-group .form-control-custom {
        flex: 1;
    }

    .btn-search {
        background: #6366f1;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        white-space: nowrap;
    }

    .btn-search:hover {
        background: #4f46e5;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .table-container {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .table-header {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-header h3 {
        font-size: 1.125rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-add-row {
        background: white;
        color: #10b981;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
    }

    .btn-add-row:hover {
        background: #f0fdf4;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .detail-table {
        width: 100%;
        border-collapse: collapse;
    }

    .detail-table thead {
        background: #f8f9fa;
    }

    .detail-table th {
        padding: 0.875rem 1rem;
        text-align: left;
        font-weight: 600;
        color: #1a1a1a;
        border-bottom: 2px solid #e5e7eb;
        font-size: 0.8125rem;
        text-transform: uppercase;
        letter-spacing: 0.025em;
        white-space: nowrap;
    }

    .detail-table td {
        padding: 0.875rem 1rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .detail-table tbody tr:hover {
        background: #f9fafb;
    }

    .detail-table input {
        width: 100%;
        padding: 0.5rem 0.75rem;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        font-size: 0.875rem;
    }

    .detail-table input:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.1);
    }

    .detail-table input:read-only {
        background: #f9fafb;
        color: #6b7280;
    }

    .detail-table input.error {
        border-color: #dc2626;
        background: #fef2f2;
    }

    .btn-remove {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fecaca;
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

    .btn-remove:hover {
        background: #fecaca;
        border-color: #fca5a5;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        padding-top: 1.5rem;
    }

    .btn-action {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-size: 0.9375rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-primary {
        background: #6366f1;
        color: white;
    }

    .btn-primary:hover {
        background: #4f46e5;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .btn-secondary {
        background: #f3f4f6;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #e5e7eb;
        color: #1a1a1a;
    }

    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        padding: 1rem;
    }

    .modal-overlay.show {
        display: flex;
    }

    .modal-container {
        background: white;
        border-radius: 12px;
        width: 100%;
        max-width: 1000px;
        max-height: 90vh;
        display: flex;
        flex-direction: column;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .modal-header {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 12px 12px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header h3 {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .modal-close {
        background: transparent;
        border: none;
        color: white;
        font-size: 2rem;
        cursor: pointer;
        padding: 0;
        width: 2rem;
        height: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        transition: background 0.2s ease;
    }

    .modal-close:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .modal-body {
        padding: 1.5rem;
        overflow-y: auto;
        flex: 1;
    }

    .search-box {
        margin-bottom: 1.5rem;
        position: relative;
    }

    .search-box input {
        width: 100%;
        padding: 0.75rem 1rem;
        padding-left: 2.75rem;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 0.9375rem;
    }

    .search-box input:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 1.125rem;
    }

    .modal-table-wrapper {
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
        max-height: 400px;
        overflow-y: auto;
    }

    .modal-table {
        width: 100%;
        border-collapse: collapse;
    }

    .modal-table thead {
        background: #f8f9fa;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .modal-table th {
        padding: 0.875rem 1rem;
        text-align: left;
        font-weight: 600;
        color: #374151;
        border-bottom: 2px solid #e5e7eb;
        font-size: 0.875rem;
    }

    .modal-table td {
        padding: 0.875rem 1rem;
        border-bottom: 1px solid #e5e7eb;
        color: #6b7280;
    }

    .modal-table tbody tr:hover {
        background: #f9fafb;
    }

    .btn-select-po {
        background: #10b981;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
    }

    .btn-select-po:hover {
        background: #059669;
    }

    .modal-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: flex-end;
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
        display: block;
    }

    .error-message {
        color: #dc2626;
        font-size: 0.75rem;
        margin-top: 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }

        .input-group {
            flex-direction: column;
        }

        .btn-search {
            width: 100%;
            justify-content: center;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }

        .table-header {
            flex-direction: column;
            gap: 1rem;
        }

        .btn-add-row {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="page-header">
    <div class="breadcrumb-custom">
        <a href="{{ route('menu') }}">
            <i class="bi bi-house-door"></i> Home
        </a>
        <i class="bi bi-chevron-right"></i>
        <a href="{{ route('barang-masuk.index') }}">Barang Masuk</a>
        <i class="bi bi-chevron-right"></i>
        <span>Tambah Barang Masuk</span>
    </div>
    <h1 class="page-title">Tambah Barang Masuk</h1>
</div>

@if (session('success'))
    <div class="alert-custom alert-success">
        <i class="bi bi-check-circle-fill"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if ($errors->any())
    <div class="alert-custom alert-error">
        <i class="bi bi-exclamation-circle-fill"></i>
        <div>
            <p style="font-weight: 600; margin-bottom: 0.5rem;">Terdapat kesalahan:</p>
            <ul style="margin: 0; padding-left: 1.25rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<form action="{{ route('barang-masuk.store') }}" method="POST" id="formBarangMasuk">
    @csrf

    <!-- Header Information -->
    <div class="form-card">
        <div class="section-title">
            <i class="bi bi-info-circle"></i>
            <span>Informasi Header</span>
        </div>

        <div class="form-row">
            <div class="form-group" style="grid-column: 1 / -1;">
                <label class="form-label">
                    No Bukti (PO)
                    <span class="required">*</span>
                </label>
                <div class="input-group">
                    <input type="text" name="no_bukti" id="no_bukti"
                           class="form-control-custom"
                           readonly required
                           placeholder="Pilih PO terlebih dahulu">
                    <button type="button" class="btn-search" onclick="openModal()">
                        <i class="bi bi-search"></i>
                        Cari PO
                    </button>
                </div>
                <span class="error-message" id="error-no_bukti" style="display:none;">
                    <i class="bi bi-exclamation-circle"></i>
                    No Bukti (PO) wajib diisi
                </span>
            </div>

            <div class="form-group">
                <label class="form-label">
                    Tanggal Terima
                    <span class="required">*</span>
                </label>
                <input type="date" name="tanggal_terima" id="tanggal_terima"
                       class="form-control-custom" required>
                <span class="error-message" id="error-tanggal_terima" style="display:none;">
                    <i class="bi bi-exclamation-circle"></i>
                    Tanggal Terima wajib diisi
                </span>
            </div>

            <div class="form-group">
                <label class="form-label">
                    Supplier ID
                    <span class="required">*</span>
                </label>
                <input type="number" name="supplier_id" id="supplier_id"
                       class="form-control-custom"
                       readonly required
                       placeholder="Auto fill dari PO">
            </div>

            <div class="form-group">
                <label class="form-label">
                    Kode Supplier
                    <span class="required">*</span>
                </label>
                <input type="text" name="kode_supplier" id="kode_supplier"
                       class="form-control-custom"
                       readonly required
                       placeholder="Auto fill dari PO">
            </div>

            <div class="form-group">
                <label class="form-label">
                    Nama Supplier
                    <span class="required">*</span>
                </label>
                <input type="text" name="nama_supplier" id="nama_supplier"
                       class="form-control-custom"
                       readonly required
                       placeholder="Auto fill dari PO">
            </div>

            <div class="form-group">
                <label class="form-label">
                    Surat Jalan
                    <span class="optional">(Opsional)</span>
                </label>
                <input type="text" name="surat_jalan"
                       class="form-control-custom"
                       placeholder="Nomor surat jalan (opsional)">
            </div>

            <div class="form-group" style="grid-column: 1 / -1;">
                <label class="form-label">
                    Keterangan
                    <span class="optional">(Opsional)</span>
                </label>
                <textarea name="keterangan" rows="3"
                          class="form-control-custom"
                          placeholder="Keterangan tambahan (opsional)"></textarea>
            </div>
        </div>
    </div>

    <!-- Detail Barang -->
    <div class="table-container">
        <div class="table-header">
            <h3>
                <i class="bi bi-box-seam"></i>
                Detail Barang
            </h3>
            <button type="button" id="add-row" class="btn-add-row">
                <i class="bi bi-plus-circle"></i>
                Tambah Barang
            </button>
        </div>

        <div class="table-wrapper">
            <table class="detail-table" id="detail-table">
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th style="width: 120px;">Jml Order</th>
                        <th style="width: 120px;">Jml Terima</th>
                        <th style="width: 100px;">Satuan</th>
                        <th style="width: 150px;">Tgl Kirim</th>
                        <th style="width: 100px; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <p>Pilih PO terlebih dahulu untuk memuat detail barang</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="form-actions">
        <a href="{{ route('barang-masuk.index') }}" class="btn-action btn-secondary">
            <i class="bi bi-x-circle"></i>
            Batal
        </a>
        <button type="submit" class="btn-action btn-primary">
            <i class="bi bi-check-circle"></i>
            Simpan Data
        </button>
    </div>
</form>

<!-- Modal Cari PO -->
<div class="modal-overlay" id="modalCariPO">
    <div class="modal-container">
        <div class="modal-header">
            <h3>
                <i class="bi bi-search"></i>
                Cari Transaksi (Purchase Order)
            </h3>
            <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
        </div>

        <div class="modal-body">
            <div class="search-box">
                <i class="bi bi-search search-icon"></i>
                <input type="text" id="searchPO"
                       placeholder="Ketik untuk mencari berdasarkan no bukti atau nama supplier...">
            </div>

            <div class="modal-table-wrapper">
                <table class="modal-table" id="po-table">
                    <thead>
                        <tr>
                            <th>No Bukti</th>
                            <th>Nama Supplier</th>
                            <th>Supplier ID</th>
                            <th>Tanggal Kirim</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5">
                                <div class="empty-state" style="padding: 2rem 1rem;">
                                    <div style="display: flex; align-items: center; justify-content: center; gap: 0.75rem;">
                                        <div style="width: 24px; height: 24px; border: 2px solid #6366f1; border-top-color: transparent; border-radius: 50%; animation: spin 1s linear infinite;"></div>
                                        <span>Memuat data PO...</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn-action btn-secondary" onclick="closeModal()">
                <i class="bi bi-x-circle"></i>
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const today = new Date().toISOString().split("T")[0];
    document.getElementById("tanggal_terima").value = today;

    let poData = [];

    window.openModal = function() {
        document.getElementById('modalCariPO').classList.add('show');
        loadPOData();
    }

    window.closeModal = function() {
        document.getElementById('modalCariPO').classList.remove('show');
    }

    function loadPOData() {
        const tbody = document.querySelector("#po-table tbody");

        fetch("{{ url('/transaksi') }}")
            .then(res => {
                if (!res.ok) throw new Error('Network response was not ok');
                return res.json();
            })
            .then(data => {
                tbody.innerHTML = "";

                if (data.success && data.pesanan && data.pesanan.length > 0) {
                    poData = data.pesanan;
                    renderPOTable(poData);
                } else {
                    tbody.innerHTML = '<tr><td colspan="5"><div class="empty-state" style="padding: 2rem 1rem;"><i class="bi bi-inbox"></i><p>Tidak ada data PO PROSES</p></div></td></tr>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                tbody.innerHTML = '<tr><td colspan="5"><div class="empty-state" style="padding: 2rem 1rem; color: #dc2626;"><i class="bi bi-exclamation-circle"></i><p>Error memuat data PO</p></div></td></tr>';
            });
    }

    function renderPOTable(data) {
        const tbody = document.querySelector("#po-table tbody");
        tbody.innerHTML = "";

        if (data.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5"><div class="empty-state" style="padding: 2rem 1rem;"><i class="bi bi-search"></i><p>Tidak ada data yang sesuai dengan pencarian</p></div></td></tr>';
            return;
        }

        data.forEach(item => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td style="font-weight: 600; color: #6366f1; font-family: 'Courier New', monospace;">${item.no_bukti || ''}</td>
                <td>${item.nama_supplier || 'N/A'}</td>
                <td>${item.supplier_id || 'N/A'}</td>
                <td>${item.created_at ? item.created_at.split("T")[0] : 'N/A'}</td>
                <td style="text-align: center;">
                    <button type="button" class="btn-select-po"
                            data-no_bukti="${item.no_bukti || ''}"
                            data-supplier_id="${item.supplier_id || ''}"
                            data-kode_supplier="${item.kode_supplier || ''}"
                            data-nama_supplier="${item.nama_supplier || ''}">
                        <i class="bi bi-check-circle"></i>
                        Pilih
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    document.getElementById('searchPO').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const filteredData = poData.filter(item => {
            return (item.no_bukti && item.no_bukti.toLowerCase().includes(searchTerm)) ||
                   (item.nama_supplier && item.nama_supplier.toLowerCase().includes(searchTerm));
        });
        renderPOTable(filteredData);
    });

    document.addEventListener("click", function(e) {
        if (e.target.closest(".btn-select-po")) {
            const btn = e.target.closest(".btn-select-po");
            document.getElementById("no_bukti").value = btn.dataset.no_bukti;
            document.getElementById("supplier_id").value = btn.dataset.supplier_id;
            document.getElementById("kode_supplier").value = btn.dataset.kode_supplier;
            document.getElementById("nama_supplier").value = btn.dataset.nama_supplier;

            // Clear error
            document.getElementById("no_bukti").classList.remove('error');
            document.getElementById("error-no_bukti").style.display = 'none';

            const noBukti = btn.dataset.no_bukti;
            if (noBukti) {
                fetch("{{ url('/barang-masuk/transaksi') }}/" + encodeURIComponent(noBukti))
                    .then(res => {
                        if (!res.ok) throw new Error('Network response was not ok');
                        return res.json();
                    })
                    .then(data => {
                        if (data.success && data.barang) {
                            const tbody = document.querySelector("#detail-table tbody");
                            tbody.innerHTML = "";
                            data.barang.forEach((barang, idx) => {
                                const row = document.createElement("tr");
                                row.innerHTML = `
                                    <td><input type="text" name="detail[${idx}][kode_barang]" value="${barang.kode || ''}" readonly></td>
                                    <td><input type="text" name="detail[${idx}][nama_barang]" value="${barang.nama || ''}" readonly></td>
                                    <td><input type="number" step="0.01" name="detail[${idx}][jumlah_order]" value="${barang.jumlah || 0}" class="jumlah-order" readonly data-max="${barang.jumlah || 0}"></td>
                                    <td><input type="number" step="0.01" name="detail[${idx}][jumlah_terima]" value="0" class="jumlah-terima" required min="0.01" max="${barang.jumlah || 0}" data-max="${barang.jumlah || 0}"></td>
                                    <td><input type="text" name="detail[${idx}][satuan]" value="${barang.satuan || ''}" readonly></td>
                                    <td><input type="date" name="detail[${idx}][tgl_kirim]" value="${today}" required></td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn-remove remove-row">
                                            <i class="bi bi-trash"></i>
                                            Hapus
                                        </button>
                                    </td>
                                `;
                                tbody.appendChild(row);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error memuat detail barang: ' + error.message);
                    });
            }

            closeModal();
        }
    });

    let rowIndex = 100;
    document.getElementById('add-row').addEventListener('click', function () {
        const table = document.querySelector("#detail-table tbody");
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><input type="text" name="detail[${rowIndex}][kode_barang]" required placeholder="Kode barang"></td>
            <td><input type="text" name="detail[${rowIndex}][nama_barang]" required placeholder="Nama barang"></td>
            <td><input type="number" step="0.01" name="detail[${rowIndex}][jumlah_order]" class="jumlah-order" required placeholder="0" min="0.01"></td>
            <td><input type="number" step="0.01" name="detail[${rowIndex}][jumlah_terima]" class="jumlah-terima" required placeholder="0" min="0.01"></td>
            <td><input type="text" name="detail[${rowIndex}][satuan]" required placeholder="Unit"></td>
            <td><input type="date" name="detail[${rowIndex}][tgl_kirim]" value="${today}" required></td>
            <td style="text-align: center;">
                <button type="button" class="btn-remove remove-row">
                    <i class="bi bi-trash"></i>
                    Hapus
                </button>
            </td>
        `;
        table.appendChild(newRow);
        rowIndex++;
    });

    document.addEventListener("click", function (e) {
        if (e.target.closest(".remove-row")) {
            if (confirm('Apakah Anda yakin ingin menghapus baris ini?')) {
                e.target.closest("tr").remove();
            }
        }
    });

    // Validasi real-time jumlah terima tidak melebihi jumlah order
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('jumlah-terima')) {
            const row = e.target.closest('tr');
            const jumlahOrderInput = row.querySelector('.jumlah-order');
            const jumlahOrder = parseFloat(jumlahOrderInput?.value) || 0;
            const jumlahTerima = parseFloat(e.target.value) || 0;
            const maxValue = parseFloat(e.target.getAttribute('data-max')) || jumlahOrder;

            // Remove previous error
            e.target.classList.remove('error');
            const existingError = e.target.parentNode.querySelector('.error-message');
            if (existingError) {
                existingError.remove();
            }

            // Validasi
            if (jumlahTerima <= 0) {
                e.target.classList.add('error');
                const errorMsg = document.createElement('div');
                errorMsg.className = 'error-message';
                errorMsg.innerHTML = '<i class="bi bi-exclamation-circle"></i> Jumlah terima harus lebih dari 0';
                e.target.parentNode.appendChild(errorMsg);
            } else if (jumlahTerima > maxValue) {
                e.target.classList.add('error');
                e.target.value = maxValue; // Auto correct ke nilai maksimal
                const errorMsg = document.createElement('div');
                errorMsg.className = 'error-message';
                errorMsg.innerHTML = `<i class="bi bi-exclamation-circle"></i> Jumlah terima tidak boleh melebihi ${maxValue}`;
                e.target.parentNode.appendChild(errorMsg);

                setTimeout(() => {
                    errorMsg.remove();
                }, 3000);
            }
        }

        // Update max attribute untuk jumlah terima saat jumlah order berubah
        if (e.target.classList.contains('jumlah-order')) {
            const row = e.target.closest('tr');
            const jumlahTerimaInput = row.querySelector('.jumlah-terima');
            const jumlahOrder = parseFloat(e.target.value) || 0;

            if (jumlahTerimaInput) {
                jumlahTerimaInput.setAttribute('max', jumlahOrder);
                jumlahTerimaInput.setAttribute('data-max', jumlahOrder);
            }
        }
    });

    // Form submission validation
    document.getElementById('formBarangMasuk').addEventListener('submit', function(e) {
        e.preventDefault();

        let hasError = false;
        let errorMessages = [];

        // Validasi header fields
        const noBukti = document.getElementById('no_bukti').value.trim();
        const tanggalTerima = document.getElementById('tanggal_terima').value.trim();
        const supplierId = document.getElementById('supplier_id').value.trim();

        if (!noBukti) {
            hasError = true;
            errorMessages.push('• No Bukti (PO) wajib diisi');
            document.getElementById('no_bukti').classList.add('error');
            document.getElementById('error-no_bukti').style.display = 'flex';
        } else {
            document.getElementById('no_bukti').classList.remove('error');
            document.getElementById('error-no_bukti').style.display = 'none';
        }

        if (!tanggalTerima) {
            hasError = true;
            errorMessages.push('• Tanggal Terima wajib diisi');
            document.getElementById('tanggal_terima').classList.add('error');
            document.getElementById('error-tanggal_terima').style.display = 'flex';
        } else {
            document.getElementById('tanggal_terima').classList.remove('error');
            document.getElementById('error-tanggal_terima').style.display = 'none';
        }

        if (!supplierId) {
            hasError = true;
            errorMessages.push('• Supplier wajib dipilih (pilih PO terlebih dahulu)');
        }

        // Validasi detail barang
        const detailRows = document.querySelectorAll('#detail-table tbody tr');

        // Cek apakah ada detail
        const hasDetail = Array.from(detailRows).some(row => {
            const inputs = row.querySelectorAll('input[name*="[kode_barang]"]');
            return inputs.length > 0;
        });

        if (!hasDetail) {
            hasError = true;
            errorMessages.push('• Minimal harus ada 1 detail barang (pilih PO terlebih dahulu)');
        }

        // Validasi setiap baris detail
        detailRows.forEach((row, index) => {
            const kodeBarang = row.querySelector('input[name*="[kode_barang]"]');
            const namaBarang = row.querySelector('input[name*="[nama_barang]"]');
            const jumlahOrder = row.querySelector('input[name*="[jumlah_order]"]');
            const jumlahTerima = row.querySelector('input[name*="[jumlah_terima]"]');
            const satuan = row.querySelector('input[name*="[satuan]"]');
            const tglKirim = row.querySelector('input[name*="[tgl_kirim]"]');

            if (!kodeBarang || !namaBarang) return; // Skip empty rows

            const namaBarangValue = namaBarang.value.trim();
            const jumlahOrderValue = parseFloat(jumlahOrder?.value) || 0;
            const jumlahTerimaValue = parseFloat(jumlahTerima?.value) || 0;
            const satuanValue = satuan?.value.trim();
            const tglKirimValue = tglKirim?.value.trim();

            // Validasi kode barang
            if (!kodeBarang.value.trim()) {
                hasError = true;
                errorMessages.push(`• Baris ${index + 1}: Kode barang wajib diisi`);
                kodeBarang.classList.add('error');
            }

            // Validasi nama barang
            if (!namaBarangValue) {
                hasError = true;
                errorMessages.push(`• Baris ${index + 1}: Nama barang wajib diisi`);
                namaBarang.classList.add('error');
            }

            // Validasi jumlah order
            if (jumlahOrderValue <= 0) {
                hasError = true;
                errorMessages.push(`• ${namaBarangValue || 'Baris ' + (index + 1)}: Jumlah order harus lebih dari 0`);
                jumlahOrder?.classList.add('error');
            }

            // Validasi jumlah terima
            if (jumlahTerimaValue <= 0) {
                hasError = true;
                errorMessages.push(`• ${namaBarangValue || 'Baris ' + (index + 1)}: Jumlah terima harus lebih dari 0`);
                jumlahTerima?.classList.add('error');
            } else if (jumlahTerimaValue > jumlahOrderValue) {
                hasError = true;
                errorMessages.push(`• ${namaBarangValue || 'Baris ' + (index + 1)}: Jumlah terima (${jumlahTerimaValue}) tidak boleh melebihi jumlah order (${jumlahOrderValue})`);
                jumlahTerima?.classList.add('error');
            }

            // Validasi satuan
            if (!satuanValue) {
                hasError = true;
                errorMessages.push(`• ${namaBarangValue || 'Baris ' + (index + 1)}: Satuan wajib diisi`);
                satuan?.classList.add('error');
            }

            // Validasi tanggal kirim
            if (!tglKirimValue) {
                hasError = true;
                errorMessages.push(`• ${namaBarangValue || 'Baris ' + (index + 1)}: Tanggal kirim wajib diisi`);
                tglKirim?.classList.add('error');
            }
        });

        if (hasError) {
            // Tampilkan alert dengan daftar error
            const errorMessage = '⚠️ VALIDASI GAGAL!\n\nPeriksa kembali data yang Anda masukkan:\n\n' +
                                errorMessages.join('\n') +
                                '\n\nSilakan perbaiki data terlebih dahulu.';
            alert(errorMessage);

            // Scroll ke field pertama yang error
            const firstErrorInput = document.querySelector('.error');
            if (firstErrorInput) {
                firstErrorInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstErrorInput.focus();
            }

            return false;
        }

        // Konfirmasi sebelum submit
        const confirmMessage = 'Apakah Anda yakin ingin menyimpan data barang masuk ini?';
        if (confirm(confirmMessage)) {
            this.submit();
        }
    });

    // Clear error on input
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('error')) {
            e.target.classList.remove('error');
        }
    });
});
</script>

@endsection
