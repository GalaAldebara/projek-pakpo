{{-- resources/views/barang-masuk/index.blade.php
@extends('layouts.app')

@section('title', 'Barang Masuk')
@section('page-title', 'Barang Masuk')

@section('content')
<style>
    .form-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 24px;
        margin: 20px;
    }

    .page-header {
        border-bottom: 2px solid #e2e8f0;
        padding-bottom: 20px;
        margin-bottom: 24px;
    }

    .page-title {
        font-size: 24px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .page-subtitle {
        color: #64748b;
        font-size: 14px;
    }

    .action-bar {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 16px;
        margin-bottom: 24px;
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn {
        padding: 10px 16px;
        border-radius: 6px;
        border: 1px solid;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }

    .btn-primary {
        background: #3b82f6;
        border-color: #3b82f6;
        color: white;
    }

    .btn-primary:hover {
        background: #2563eb;
        border-color: #2563eb;
    }

    .btn-secondary {
        background: white;
        border-color: #d1d5db;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #f9fafb;
        border-color: #9ca3af;
    }

    .btn-success {
        background: #10b981;
        border-color: #10b981;
        color: white;
    }

    .btn-success:hover {
        background: #059669;
        border-color: #059669;
    }

    .form-section {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 24px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 16px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .form-label {
        font-weight: 500;
        color: #374151;
        font-size: 14px;
    }

    .form-input {
        padding: 10px 12px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 14px;
        transition: border-color 0.2s;
    }

    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-input[readonly] {
        background: #f9fafb;
        color: #6b7280;
    }

    .table-section {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        overflow: hidden;
    }

    .table-header {
        background: #f8fafc;
        padding: 16px 20px;
        border-bottom: 1px solid #e2e8f0;
        font-weight: 600;
        color: #1e293b;
    }

    .table-container {
        overflow-x: auto;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table th {
        background: #f1f5f9;
        padding: 12px;
        text-align: left;
        font-weight: 600;
        color: #374151;
        border-bottom: 1px solid #e2e8f0;
        font-size: 13px;
    }

    .data-table td {
        padding: 12px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
        color: #374151;
    }

    .data-table tbody tr:hover {
        background: #f8fafc;
    }

    .row-number {
        width: 60px;
        text-align: center;
        background: #f9fafb;
        font-weight: 500;
        color: #6b7280;
    }

    .text-center { text-align: center; }
    .text-right { text-align: right; }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 500;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-received {
        background: #d1fae5;
        color: #065f46;
    }

    .footer-note {
        background: #f0f9ff;
        border: 1px solid #bae6fd;
        border-radius: 8px;
        padding: 12px 16px;
        margin-top: 20px;
        font-size: 13px;
        color: #0c4a6e;
    }

    .action-buttons {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 24px;
        padding-top: 20px;
        border-top: 1px solid #e2e8f0;
    }

    .icon {
        width: 18px;
        height: 18px;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .action-bar {
            flex-direction: column;
        }

        .action-buttons {
            flex-direction: column;
        }
    }
</style>

<div class="form-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Penerimaan Barang</h1>
        <p class="page-subtitle">Form untuk mencatat penerimaan barang dari supplier</p>
    </div>

    <!-- Action Bar -->
    <div class="action-bar">
        <button class="btn btn-primary">
            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            Cari Order
        </button>
        <button class="btn btn-secondary">
            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Baru
        </button>
        <button class="btn btn-secondary">
            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            Cetak
        </button>
    </div>

    <!-- Form Section -->
    <div class="form-section">
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">No. Bukti Penerimaan</label>
                <input type="text" class="form-input" value="BM070920250001" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">No. Order Pembelian</label>
                <input type="text" class="form-input" value="OR1010001070920250001">
            </div>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Kode Supplier</label>
                <input type="text" class="form-input" value="1010001" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Nama Supplier</label>
                <input type="text" class="form-input" value="ABADI JAYA.PR. , DS.KARANGPANDAN 79 PK-AJI , MALANG" readonly>
            </div>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Gudang</label>
                <select class="form-input">
                    <option value="0000">Gudang Utama (0000)</option>
                    <option value="0001">Gudang Cabang (0001)</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Tanggal Terima</label>
                <input type="date" class="form-input" value="2025-09-07">
            </div>
            <div class="form-group">
                <label class="form-label">No. Surat Jalan</label>
                <input type="text" class="form-input" placeholder="Masukkan nomor surat jalan">
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="table-section">
        <div class="table-header">
            Detail Barang yang Diterima
        </div>
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="row-number">#</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th class="text-center">Jumlah Order</th>
                        <th class="text-center">Jumlah Terima</th>
                        <th class="text-center">Selisih</th>
                        <th class="text-center">Satuan</th>
                        <th>No. PO</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="row-number">1</td>
                        <td>001001</td>
                        <td>AMERICAN 114/8611243</td>
                        <td class="text-right">5,000.000</td>
                        <td class="text-right">
                            <input type="number" class="form-input" style="width: 120px; margin: 0;" step="0.001" value="5000">
                        </td>
                        <td class="text-right" style="color: #059669; font-weight: 500;">0.000</td>
                        <td class="text-center">KG</td>
                        <td>LO25090001</td>
                        <td class="text-center">
                            <span class="status-badge status-received">Sesuai</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="row-number">2</td>
                        <td>002001</td>
                        <td>CHEMICAL COMPOUND X20</td>
                        <td class="text-right">2,500.000</td>
                        <td class="text-right">
                            <input type="number" class="form-input" style="width: 120px; margin: 0;" step="0.001" placeholder="0.000">
                        </td>
                        <td class="text-right">-</td>
                        <td class="text-center">KG</td>
                        <td>LO25090001</td>
                        <td class="text-center">
                            <span class="status-badge status-pending">Pending</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="row-number">3</td>
                        <td>003001</td>
                        <td>INDUSTRIAL GRADE POLYMER</td>
                        <td class="text-right">1,000.000</td>
                        <td class="text-right">
                            <input type="number" class="form-input" style="width: 120px; margin: 0;" step="0.001" placeholder="0.000">
                        </td>
                        <td class="text-right">-</td>
                        <td class="text-center">KG</td>
                        <td>LO25090001</td>
                        <td class="text-center">
                            <span class="status-badge status-pending">Pending</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer Note -->
    <div class="footer-note">
        <strong>Petunjuk:</strong> Masukkan jumlah barang yang benar-benar diterima. Sistem akan otomatis menghitung selisih antara jumlah order dan jumlah terima.
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <button class="btn btn-secondary" onclick="batalInput()">
            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            Batal
        </button>
        <button class="btn btn-secondary">
            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
            </svg>
            Simpan Draft
        </button>
        <button class="btn btn-success" onclick="simpanBarangMasuk()">
            <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Konfirmasi Penerimaan
        </button>
    </div>
</div>

<script>
function simpanBarangMasuk() {
    // Collect form data
    const formData = {
        no_bukti: document.querySelector('input[value="OR1010001070920250001"]').value,
        no_penerimaan: document.querySelector('input[value="BM070920250001"]').value,
        supplier_id: '1',
        tanggal_terima: document.querySelector('input[type="date"]').value,
        surat_jalan: document.querySelector('input[placeholder="Masukkan nomor surat jalan"]').value,
        barang: []
    };

    // Get items data
    const rows = document.querySelectorAll('.data-table tbody tr');
    rows.forEach((row, index) => {
        const jumlahTerima = row.querySelector('input[type="number"]').value;
        if (jumlahTerima && jumlahTerima > 0) {
            formData.barang.push({
                kode: row.cells[1].textContent.trim(),
                nama: row.cells[2].textContent.trim(),
                jumlah_order: parseFloat(row.cells[3].textContent.replace(/[,]/g, '')),
                jumlah_terima: parseFloat(jumlahTerima),
                satuan: row.cells[6].textContent.trim(),
                no_po: row.cells[7].textContent.trim()
            });
        }
    });

    if (formData.barang.length === 0) {
        alert('Silakan masukkan jumlah barang yang diterima');
        return;
    }

    // Show confirmation
    const itemCount = formData.barang.length;
    if (confirm(`Konfirmasi penerimaan ${itemCount} item barang?`)) {
        alert('Penerimaan barang berhasil disimpan!\nNo. Bukti: ' + formData.no_penerimaan);
        // Here you would actually submit to the server
        // fetch('/barang-masuk', { method: 'POST', body: JSON.stringify(formData) })
    }
}

function batalInput() {
    if (confirm('Yakin ingin membatalkan input?')) {
        window.location.href = '{{ route("menu") }}';
    }
}

// Auto calculate selisih when jumlah_terima changes
document.querySelectorAll('input[type="number"]').forEach(input => {
    input.addEventListener('input', function() {
        const row = this.closest('tr');
        const jumlahOrder = parseFloat(row.cells[3].textContent.replace(/[,]/g, ''));
        const jumlahTerima = parseFloat(this.value) || 0;
        const selisih = jumlahTerima - jumlahOrder;

        const selisihCell = row.cells[5];
        selisihCell.textContent = selisih.toFixed(3);

        // Update status
        const statusCell = row.querySelector('.status-badge');
        if (jumlahTerima === 0) {
            statusCell.textContent = 'Pending';
            statusCell.className = 'status-badge status-pending';
        } else if (selisih === 0) {
            statusCell.textContent = 'Sesuai';
            statusCell.className = 'status-badge status-received';
        } else {
            statusCell.textContent = selisih > 0 ? 'Lebih' : 'Kurang';
            statusCell.className = 'status-badge status-pending';
        }

        // Color code selisih
        if (selisih > 0) {
            selisihCell.style.color = '#dc2626';
        } else if (selisih < 0) {
            selisihCell.style.color = '#ea580c';
        } else {
            selisihCell.style.color = '#059669';
        }
    });
});
</script>
@endsection --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Daftar Barang Masuk</h2>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No Penerimaan</th>
                <th>No Bukti</th>
                <th>Supplier ID</th>
                <th>Kode Supplier</th>
                <th>Nama Supplier</th>
                <th>Gudang</th>
                <th>Tanggal Terima</th>
                <th>Surat Jalan</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Tanggal Input</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barangMasuk as $bm)
                <tr>
                    <td>{{ $bm->no_penerimaan }}</td>
                    <td>{{ $bm->no_bukti }}</td>
                    <td>{{ $bm->supplier_id }}</td>
                    <td>{{ $bm->kode_supplier }}</td>
                    <td>{{ $bm->nama_supplier }}</td>
                    <td>{{ $bm->gudang }}</td>
                    <td>{{ \Carbon\Carbon::parse($bm->tanggal_terima)->format('d-m-Y') }}</td>
                    <td>{{ $bm->surat_jalan ?? '-' }}</td>
                    <td>
                        @if($bm->status == 'PENDING')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($bm->status == 'DITERIMA')
                            <span class="badge bg-success">Diterima</span>
                        @else
                            <span class="badge bg-secondary">Selesai</span>
                        @endif
                    </td>
                    <td>{{ $bm->keterangan ?? '-' }}</td>
                    <td>{{ $bm->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center">Belum ada data barang masuk</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

