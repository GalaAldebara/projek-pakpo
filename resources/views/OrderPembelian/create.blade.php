@extends('layouts.app')

@section('content')
<style>
    .page-header {
        margin-bottom: 1rem;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 0.5rem;
    }

    .breadcrumb-custom {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8125rem;
        color: #6b7280;
        margin-bottom: 0.75rem;
    }

    .breadcrumb-custom a {
        color: #6366f1;
        text-decoration: none;
        transition: color 0.2s ease;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .breadcrumb-custom a:hover {
        color: #4f46e5;
    }

    .form-card {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        margin-bottom: 1rem;
        overflow: hidden;
    }

    .card-header {
        background: #f8f9fa;
        padding: 0.875rem 1.25rem;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .supplier-section {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .supplier-name {
        font-weight: 600;
        color: #1a1a1a;
        font-size: 0.9375rem;
    }

    .btn-select-supplier {
        background: #6366f1;
        color: white;
        border: none;
        padding: 0.375rem 0.875rem;
        border-radius: 6px;
        font-size: 0.8125rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-select-supplier:hover {
        background: #4f46e5;
    }

    .payment-options {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .radio-label {
        display: flex;
        align-items: center;
        gap: 0.375rem;
        font-size: 0.8125rem;
        color: #374151;
        cursor: pointer;
    }

    .credit-days {
        width: 70px;
        padding: 0.375rem 0.5rem;
        border: 1px solid #e5e7eb;
        border-radius: 4px;
        font-size: 0.8125rem;
    }

    .credit-days:focus {
        outline: none;
        border-color: #6366f1;
    }

    .table-container {
        padding: 1rem 1.25rem;
    }

    .table-header-row {
        display: grid;
        grid-template-columns: 100px 1fr 80px 80px 120px 130px 60px;
        gap: 0.75rem;
        padding: 0.5rem 0;
        font-size: 0.75rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        border-bottom: 2px solid #e5e7eb;
        margin-bottom: 0.75rem;
    }

    .item-row {
        display: grid;
        grid-template-columns: 100px 1fr 80px 80px 120px 130px 60px;
        gap: 0.75rem;
        align-items: center;
        padding: 0.625rem 0;
        border-bottom: 1px solid #f3f4f6;
    }

    .item-row:last-child {
        border-bottom: none;
    }

    .form-control {
        width: 100%;
        padding: 0.5rem 0.625rem;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        font-size: 0.8125rem;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #6366f1;
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.1);
    }

    .form-control:read-only {
        background: #f9fafb;
        color: #6b7280;
        cursor: not-allowed;
    }

    .form-control.clickable {
        cursor: pointer;
        background: #ffffff;
    }

    .form-control.clickable:hover {
        border-color: #6366f1;
    }

    .btn-remove {
        background: #fee2e2;
        color: #dc2626;
        border: none;
        width: 28px;
        height: 28px;
        border-radius: 4px;
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-remove:hover {
        background: #fecaca;
    }

    .btn-add-item {
        background: #10b981;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-size: 0.8125rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        margin-top: 0.75rem;
    }

    .btn-add-item:hover {
        background: #059669;
    }

    .finance-section {
        padding: 1rem 1.25rem;
        background: #f9fafb;
        border-top: 1px solid #e5e7eb;
    }

    .finance-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }

    .finance-field {
        display: flex;
        flex-direction: column;
        gap: 0.375rem;
    }

    .finance-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
    }

    .summary-section {
        padding: 1rem 1.25rem;
        background: #f8f9fa;
        border-top: 1px solid #e5e7eb;
    }

    .summary-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .summary-item {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .summary-label {
        font-size: 0.75rem;
        color: #6b7280;
    }

    .summary-value {
        font-size: 0.9375rem;
        font-weight: 600;
        color: #1a1a1a;
    }

    .summary-value.discount {
        color: #dc2626;
    }

    .summary-value.ppn {
        color: #10b981;
    }

    .summary-value.pph {
        color: #f59e0b;
    }

    .summary-value.grand-total {
        font-size: 1.125rem;
        font-weight: 700;
    }

    .action-buttons {
        display: flex;
        gap: 0.75rem;
    }

    .btn-action {
        padding: 0.625rem 1.25rem;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
    }

    .btn-secondary {
        background: #f3f4f6;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #e5e7eb;
    }

    .btn-primary {
        background: #6366f1;
        color: white;
    }

    .btn-primary:hover {
        background: #4f46e5;
    }

    /* Modal Styles */
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
        max-width: 700px;
        max-height: 80vh;
        display: flex;
        flex-direction: column;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    }

    .modal-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1a1a1a;
    }

    .modal-close {
        background: transparent;
        border: none;
        color: #9ca3af;
        cursor: pointer;
        padding: 0;
        width: 1.5rem;
        height: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        transition: all 0.2s ease;
    }

    .modal-close:hover {
        background: #f3f4f6;
        color: #374151;
    }

    .modal-body {
        overflow-y: auto;
        flex: 1;
    }

    .modal-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.8125rem;
    }

    .modal-table thead {
        background: #f8f9fa;
        position: sticky;
        top: 0;
    }

    .modal-table th {
        padding: 0.75rem 1rem;
        text-align: left;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        font-size: 0.75rem;
        border-bottom: 2px solid #e5e7eb;
    }

    .modal-table td {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #f3f4f6;
        color: #374151;
    }

    .modal-table tbody tr:hover {
        background: #f9fafb;
    }

    .btn-select {
        background: #6366f1;
        color: white;
        border: none;
        padding: 0.375rem 0.875rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-select:hover {
        background: #4f46e5;
    }

    .disabled-section {
        opacity: 0.5;
        pointer-events: none;
    }

    @media (max-width: 1024px) {
        .table-header-row,
        .item-row {
            grid-template-columns: 80px 1fr 70px 70px 100px 110px 50px;
            gap: 0.5rem;
        }

        .summary-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .finance-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .table-header-row,
        .item-row {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            margin-bottom: 0.75rem;
        }

        .summary-grid {
            grid-template-columns: 1fr;
        }

        .summary-content {
            flex-direction: column;
            gap: 1.5rem;
        }

        .action-buttons {
            width: 100%;
            flex-direction: column;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }

        .finance-grid {
            grid-template-columns: 1fr;
        }

        .card-header {
            flex-direction: column;
            gap: 0.75rem;
            align-items: flex-start;
        }
    }
</style>

<div class="page-header">
    <div class="breadcrumb-custom">
        <a href="{{ route('orders.index') }}">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
        <i class="bi bi-chevron-right"></i>
        <span>Buat Purchase Order</span>
    </div>
    <h1 class="page-title">Buat Purchase Order</h1>
</div>

<form action="{{ route('orders.store') }}" method="POST" id="formPO">
    @csrf
    <input type="hidden" name="supplier_id" id="supplier_id">

    <!-- Main Card -->
    <div class="form-card">
        <!-- Supplier Header -->
        <div class="card-header">
            <div class="supplier-section">
                <span class="supplier-name" id="supplier_name_display">Pilih Supplier</span>
                <button type="button" id="btnCariSupplier" class="btn-select-supplier">
                    <i class="bi bi-search"></i>
                    Pilih Supplier
                </button>
            </div>

            <div class="payment-options">
                <label class="radio-label">
                    <input type="radio" name="is_kredit" value="CASH" id="cash" checked>
                    Cash
                </label>
                <label class="radio-label">
                    <input type="radio" name="is_kredit" value="KREDIT" id="kredit">
                    Kredit
                </label>
                <div id="hari_kredit_wrapper" style="display: none;">
                    <input type="number" name="hari_kredit" id="hari_kredit" min="1" value="30"
                           class="credit-days" placeholder="Hari">
                </div>
            </div>
        </div>

        <!-- Product Section -->
        <div id="order-fields" class="disabled-section">
            <div class="table-container">
                <div class="table-header-row">
                    <div>SKU</div>
                    <div>Nama Item</div>
                    <div>Jumlah</div>
                    <div>Satuan</div>
                    <div>Harga</div>
                    <div>Tgl Kirim</div>
                    <div style="text-align: center;">Aksi</div>
                </div>

                <div id="item-container">
                    <!-- Default item row -->
                    <div class="item-row">
                        <div>
                            <input type="text" class="form-control clickable sku_display" placeholder="Pilih SKU..." readonly>
                            <input type="hidden" name="item_id[]" class="item_id">
                        </div>
                        <div>
                            <input type="text" class="form-control nama_item" readonly>
                        </div>
                        <div>
                            <input type="number" name="jumlah[]" class="form-control jumlah" min="1" placeholder="0">
                        </div>
                        <div>
                            <input type="text" class="form-control satuan_display" readonly>
                            <input type="hidden" name="satuan_id[]" class="satuan_id">
                        </div>
                        <div>
                            <input type="number" name="harga[]" class="form-control harga" step="0.01" placeholder="0">
                        </div>
                        <div>
                            <input type="date" name="tgl_kirim[]" class="form-control tgl_kirim">
                        </div>
                        <div style="text-align: center;">
                            <button type="button" class="btn-remove btn-remove-item">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <button type="button" id="add-item-row" class="btn-add-item">
                    <i class="bi bi-plus-circle"></i>
                    Tambah Item
                </button>
            </div>
        </div>

        <!-- Financial Section -->
        <div id="finance-fields" class="finance-section disabled-section">
            <div class="finance-grid">
                <div class="finance-field">
                    <label class="finance-label">Discount (%)</label>
                    <input type="number" name="discount" id="discount" class="form-control"
                           min="0" max="100" step="0.01" placeholder="0" disabled>
                </div>
                <div class="finance-field">
                    <label class="finance-label">PPN (%)</label>
                    <input type="number" name="ppn" id="ppn" class="form-control"
                           min="0" max="100" step="0.01" placeholder="0" disabled>
                </div>
                <div class="finance-field">
                    <label class="finance-label">PPH (%)</label>
                    <input type="number" name="pph" id="pph" class="form-control"
                           min="0" max="100" step="0.01" placeholder="0" disabled>
                </div>
            </div>
        </div>

        <!-- Summary Footer -->
        <div class="summary-section">
            <div class="summary-content">
                <div class="summary-grid">
                    <div class="summary-item">
                        <div class="summary-label">Subtotal</div>
                        <div class="summary-value" id="summarySubtotal">Rp 0</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">Discount</div>
                        <div class="summary-value discount" id="summaryDiscount">Rp 0</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">After Discount</div>
                        <div class="summary-value" id="summaryAfterDiscount">Rp 0</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">PPN</div>
                        <div class="summary-value ppn" id="summaryPPN">Rp 0</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">PPH</div>
                        <div class="summary-value pph" id="summaryPPH">Rp 0</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">Grand Total</div>
                        <div class="summary-value grand-total" id="summaryGrandTotal">Rp 0</div>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('orders.index') }}" class="btn-action btn-secondary">
                        <i class="bi bi-x-circle"></i>
                        Batal
                    </a>
                    <button type="submit" class="btn-action btn-primary">
                        <i class="bi bi-check-circle"></i>
                        Buat PO
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal Supplier -->
<div id="modalSupplier" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title">Pilih Supplier</h3>
            <button type="button" id="closeModal" class="modal-close">
                <i class="bi bi-x" style="font-size: 1.25rem;"></i>
            </button>
        </div>
        <div class="modal-body">
            <table class="modal-table">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th style="text-align: center; width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($suppliers as $supplier)
                    <tr>
                        <td style="font-family: monospace; font-weight: 600;">{{ $supplier->kode_supplier }}</td>
                        <td>{{ $supplier->nama }}</td>
                        <td style="text-align: center;">
                            <button type="button" class="btn-select pilihSupplier"
                                    data-id="{{ $supplier->id }}"
                                    data-kode="{{ $supplier->kode_supplier }}"
                                    data-nama="{{ $supplier->nama }}">
                                Pilih
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal SKU -->
<div id="modalSKU" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="modal-title">Pilih SKU</h3>
            <button type="button" id="closeModalSKU" class="modal-close">
                <i class="bi bi-x" style="font-size: 1.25rem;"></i>
            </button>
        </div>
        <div class="modal-body">
            <table class="modal-table">
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Nama Item</th>
                        <th style="text-align: center; width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="skuListBody">
                    @foreach($items as $item)
                        <tr class="sku-row" style="display: none;" data-supplier="{{ $item->supplier_id }}">
                            <td style="font-family: monospace; font-weight: 600;">{{ $item->sku }}</td>
                            <td>{{ $item->name }}</td>
                            <td style="text-align: center;">
                                <button type="button" class="btn-select pilihSKU"
                                        data-id="{{ $item->id }}"
                                        data-sku="{{ $item->sku }}"
                                        data-nama="{{ $item->name }}"
                                        data-satuan-id="{{ $item->satuan->id ?? '' }}"
                                        data-satuan-nama="{{ $item->satuan->nama ?? '' }}">
                                    Pilih
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const orderFields = document.getElementById('order-fields');
    const financeFields = document.getElementById('finance-fields');
    const itemContainer = document.getElementById('item-container');
    const addItemBtn = document.getElementById('add-item-row');
    let currentSKUInput = null;

    // Modal Supplier
    document.getElementById('btnCariSupplier').addEventListener('click', () => {
        document.getElementById('modalSupplier').classList.add('show');
    });

    document.getElementById('closeModal').addEventListener('click', () => {
        document.getElementById('modalSupplier').classList.remove('show');
    });

    // Pilih Supplier
    document.querySelectorAll('.pilihSupplier').forEach(btn => {
        btn.addEventListener('click', function () {
            const supplierId = this.dataset.id;
            document.getElementById('supplier_id').value = supplierId;
            document.getElementById('supplier_name_display').textContent = this.dataset.nama;

            // Enable order fields
            orderFields.classList.remove('disabled-section');

            document.getElementById('modalSupplier').classList.remove('show');
        });
    });

    // SKU Modal
    const modalSKU = document.getElementById('modalSKU');
    const closeModalSKU = document.getElementById('closeModalSKU');
    const skuRows = document.querySelectorAll('.sku-row');

    // Event delegation for SKU input clicks
    itemContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('sku_display')) {
            const supplierId = document.getElementById('supplier_id').value;
            if (!supplierId) {
                alert('Pilih supplier terlebih dahulu!');
                return;
            }

            currentSKUInput = e.target;

            skuRows.forEach(row => {
                row.style.display = row.dataset.supplier === supplierId ? '' : 'none';
            });
            modalSKU.classList.add('show');
        }
    });

    closeModalSKU.addEventListener('click', () => {
        modalSKU.classList.remove('show');
        currentSKUInput = null;
    });

    // Pilih SKU
    document.querySelectorAll('.pilihSKU').forEach(btn => {
        btn.addEventListener('click', function () {
            if (!currentSKUInput) return;

            const row = currentSKUInput.closest('.item-row');

            row.querySelector('.item_id').value = this.dataset.id;
            row.querySelector('.sku_display').value = this.dataset.sku;
            row.querySelector('.nama_item').value = this.dataset.nama;
            row.querySelector('.satuan_display').value = this.dataset.satuanNama;
            row.querySelector('.satuan_id').value = this.dataset.satuanId;

            modalSKU.classList.remove('show');
            currentSKUInput = null;

            checkFinanceFields();
        });
    });

    // Tambah item baru
    addItemBtn.addEventListener('click', function () {
        const firstRow = itemContainer.querySelector('.item-row');
        const newRow = firstRow.cloneNode(true);

        newRow.querySelectorAll('input').forEach(input => {
            input.value = '';
        });

        itemContainer.appendChild(newRow);
    });

    // Hapus item
    itemContainer.addEventListener('click', function (e) {
        if (e.target.closest('.btn-remove-item')) {
            const allRows = itemContainer.querySelectorAll('.item-row');
            if (allRows.length > 1) {
                e.target.closest('.item-row').remove();
                hitungRingkasan();
            } else {
                alert('Minimal satu item harus ada.');
            }
        }
    });

    // Enable finance fields
    function checkFinanceFields() {
        const allRows = itemContainer.querySelectorAll('.item-row');
        let hasValidItem = false;

        allRows.forEach(row => {
            const itemId = row.querySelector('.item_id').value;
            const jumlah = row.querySelector('.jumlah').value;
            const harga = row.querySelector('.harga').value;
            const tglKirim = row.querySelector('.tgl_kirim').value;

            if (itemId && jumlah && harga && tglKirim) {
                hasValidItem = true;
            }
        });

        if (hasValidItem) {
            financeFields.classList.remove('disabled-section');
            financeFields.querySelectorAll('input').forEach(el => el.disabled = false);
        }
    }

    // Listen to changes
    itemContainer.addEventListener('input', function(e) {
        if (e.target.matches('.jumlah, .harga, .tgl_kirim')) {
            checkFinanceFields();
            hitungRingkasan();
        }
    });

    // Kredit toggle
    const kreditRadio = document.getElementById('kredit');
    const cashRadio = document.getElementById('cash');
    const hariWrapper = document.getElementById('hari_kredit_wrapper');

    function toggleKredit() {
        hariWrapper.style.display = kreditRadio.checked ? 'block' : 'none';
    }

    kreditRadio.addEventListener('change', toggleKredit);
    cashRadio.addEventListener('change', toggleKredit);

    // Financial calculations
    function formatRupiah(angka) {
        return "Rp " + angka.toLocaleString("id-ID");
    }

    function hitungRingkasan() {
        const allRows = itemContainer.querySelectorAll('.item-row');
        let subtotal = 0;

        allRows.forEach(row => {
            const jumlah = parseFloat(row.querySelector('.jumlah').value || 0);
            const harga = parseFloat(row.querySelector('.harga').value || 0);
            subtotal += jumlah * harga;
        });

        const disc = parseFloat(document.getElementById('discount')?.value || 0);
        const ppnVal = parseFloat(document.getElementById('ppn')?.value || 0);
        const pphVal = parseFloat(document.getElementById('pph')?.value || 0);

        const discountAmount = subtotal * (disc / 100);
        const afterDiscount = subtotal - discountAmount;
        const ppnAmount = afterDiscount * (ppnVal / 100);
        const pphAmount = afterDiscount * (pphVal / 100);
        const grandTotal = afterDiscount + ppnAmount - pphAmount;

        document.getElementById("summarySubtotal").textContent = formatRupiah(subtotal);
        document.getElementById("summaryDiscount").textContent = formatRupiah(discountAmount);
        document.getElementById("summaryAfterDiscount").textContent = formatRupiah(afterDiscount);
        document.getElementById("summaryPPN").textContent = formatRupiah(ppnAmount);
        document.getElementById("summaryPPH").textContent = formatRupiah(pphAmount);
        document.getElementById("summaryGrandTotal").textContent = formatRupiah(grandTotal);
    }

    // Listen to financial field changes
    ['discount', 'ppn', 'pph'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.addEventListener("input", hitungRingkasan);
    });

    // Close modals on outside click
    document.getElementById('modalSupplier').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('show');
        }
    });

    document.getElementById('modalSKU').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.remove('show');
            currentSKUInput = null;
        }
    });

    // Form validation
    document.getElementById('formPO').addEventListener('submit', function(e) {
        e.preventDefault();

        let hasError = false;
        let errorMessages = [];

        // Validasi supplier
        const supplierId = document.getElementById('supplier_id').value;
        if (!supplierId) {
            hasError = true;
            errorMessages.push('• Supplier wajib dipilih');
        }

        // Validasi items
        const allRows = itemContainer.querySelectorAll('.item-row');
        let hasValidItem = false;

        allRows.forEach((row, index) => {
            const itemId = row.querySelector('.item_id').value;
            const jumlah = row.querySelector('.jumlah').value;
            const harga = row.querySelector('.harga').value;
            const tglKirim = row.querySelector('.tgl_kirim').value;

            if (itemId || jumlah || harga || tglKirim) {
                hasValidItem = true;

                if (!itemId) {
                    hasError = true;
                    errorMessages.push(`• Baris ${index + 1}: SKU wajib dipilih`);
                }
                if (!jumlah || parseFloat(jumlah) <= 0) {
                    hasError = true;
                    errorMessages.push(`• Baris ${index + 1}: Jumlah harus lebih dari 0`);
                }
                if (!harga || parseFloat(harga) <= 0) {
                    hasError = true;
                    errorMessages.push(`• Baris ${index + 1}: Harga harus lebih dari 0`);
                }
                if (!tglKirim) {
                    hasError = true;
                    errorMessages.push(`• Baris ${index + 1}: Tanggal kirim wajib diisi`);
                }
            }
        });

        if (!hasValidItem) {
            hasError = true;
            errorMessages.push('• Minimal harus ada 1 item yang diisi lengkap');
        }

        // Validasi kredit
        const isKredit = document.getElementById('kredit').checked;
        const hariKredit = document.getElementById('hari_kredit').value;
        if (isKredit && (!hariKredit || parseInt(hariKredit) <= 0)) {
            hasError = true;
            errorMessages.push('• Hari kredit wajib diisi untuk pembayaran kredit');
        }

        if (hasError) {
            const errorMessage = '⚠️ VALIDASI GAGAL!\n\nPeriksa kembali data:\n\n' +
                                errorMessages.join('\n') +
                                '\n\nSilakan perbaiki data terlebih dahulu.';
            alert(errorMessage);
            return false;
        }

        // Konfirmasi
        if (confirm('Apakah Anda yakin ingin membuat Purchase Order ini?')) {
            this.submit();
        }
    });
});
</script>
@endpush

@endsection
