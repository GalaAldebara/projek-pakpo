@extends('layouts.app')

@push('styles')
<style>
    /* Tailwind utilities yang dibutuhkan */
    .min-h-screen { min-height: 100vh; }
    .bg-gray-50 { background-color: #f9fafb; }
    .py-6 { padding-top: 1.5rem; padding-bottom: 1.5rem; }
    .px-6 { padding-left: 1.5rem; padding-right: 1.5rem; }
    .py-4 { padding-top: 1rem; padding-bottom: 1rem; }
    .px-3 { padding-left: 0.75rem; padding-right: 0.75rem; }
    .py-2 { padding-top: 0.5rem; padding-bottom: 0.5rem; }
    .py-1 { padding-top: 0.25rem; padding-bottom: 0.25rem; }

    .mb-6 { margin-bottom: 1.5rem; }
    .mb-4 { margin-bottom: 1rem; }
    .mb-3 { margin-bottom: 0.75rem; }
    .mb-2 { margin-bottom: 0.5rem; }
    .mb-1 { margin-bottom: 0.25rem; }
    .ml-2 { margin-left: 0.5rem; }
    .mr-1 { margin-right: 0.25rem; }
    .mr-2 { margin-right: 0.5rem; }
    .mt-4 { margin-top: 1rem; }

    .mx-auto { margin-left: auto; margin-right: auto; }
    .mx-4 { margin-left: 1rem; margin-right: 1rem; }

    .max-w-7xl { max-width: 80rem; }
    .max-w-2xl { max-width: 42rem; }
    .max-h-96 { max-height: 24rem; }
    .max-h-\[80vh\] { max-height: 80vh; }

    .container { width: 100%; }
    @media (min-width: 640px) { .container { max-width: 640px; } }
    @media (min-width: 768px) { .container { max-width: 768px; } }
    @media (min-width: 1024px) { .container { max-width: 1024px; } }
    @media (min-width: 1280px) { .container { max-width: 1280px; } }

    .flex { display: flex; }
    .grid { display: grid; }
    .hidden { display: none; }
    .block { display: block; }

    .items-center { align-items: center; }
    .items-start { align-items: flex-start; }
    .justify-between { justify-content: space-between; }
    .justify-center { justify-content: center; }

    .space-x-3 > * + * { margin-left: 0.75rem; }
    .space-x-4 > * + * { margin-left: 1rem; }

    .gap-4 { gap: 1rem; }
    .gap-6 { gap: 1.5rem; }
    .gap-8 { gap: 2rem; }

    .grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    .grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
    .grid-cols-12 { grid-template-columns: repeat(12, minmax(0, 1fr)); }

    .col-span-1 { grid-column: span 1 / span 1; }
    .col-span-2 { grid-column: span 2 / span 2; }
    .col-span-3 { grid-column: span 3 / span 3; }

    .bg-white { background-color: #ffffff; }
    .bg-gray-50 { background-color: #f9fafb; }

    .text-gray-900 { color: #111827; }
    .text-gray-700 { color: #374151; }
    .text-gray-600 { color: #4b5563; }
    .text-gray-500 { color: #6b7280; }
    .text-gray-400 { color: #9ca3af; }
    .text-gray-300 { color: #d1d5db; }
    .text-blue-600 { color: #2563eb; }
    .text-blue-700 { color: #1d4ed8; }
    .text-red-600 { color: #dc2626; }
    .text-red-700 { color: #b91c1c; }
    .text-green-600 { color: #16a34a; }
    .text-orange-600 { color: #ea580c; }

    .text-xs { font-size: 0.75rem; line-height: 1rem; }
    .text-sm { font-size: 0.875rem; line-height: 1.25rem; }
    .text-lg { font-size: 1.125rem; line-height: 1.75rem; }

    .font-medium { font-weight: 500; }
    .font-semibold { font-weight: 600; }
    .font-bold { font-weight: 700; }

    .uppercase { text-transform: uppercase; }
    .text-center { text-align: center; }

    .border { border-width: 1px; }
    .border-b { border-bottom-width: 1px; }
    .border-t { border-top-width: 1px; }
    .border-gray-100 { border-color: #f3f4f6; }
    .border-gray-200 { border-color: #e5e7eb; }
    .border-gray-300 { border-color: #d1d5db; }
    .border-blue-600 { border-color: #2563eb; }

    .rounded { border-radius: 0.25rem; }
    .rounded-md { border-radius: 0.375rem; }
    .rounded-lg { border-radius: 0.5rem; }

    .shadow-sm { box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }
    .shadow-xl { box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); }

    .overflow-hidden { overflow: hidden; }
    .overflow-y-auto { overflow-y: auto; }

    .opacity-50 { opacity: 0.5; }
    .pointer-events-none { pointer-events: none; }

    .w-5 { width: 1.25rem; }
    .w-20 { width: 5rem; }
    .w-full { width: 100%; }
    .h-5 { height: 1.25rem; }

    .fixed { position: fixed; }
    .inset-0 { top: 0; right: 0; bottom: 0; left: 0; }
    .z-50 { z-index: 50; }

    .cursor-pointer { cursor: pointer; }

    .transition { transition-property: all; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 150ms; }
    .transition-colors { transition-property: color, background-color, border-color; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 150ms; }
    .duration-200 { transition-duration: 200ms; }

    .hover\:text-blue-700:hover { color: #1d4ed8; }
    .hover\:text-blue-600:hover { color: #2563eb; }
    .hover\:text-red-700:hover { color: #b91c1c; }
    .hover\:text-gray-600:hover { color: #4b5563; }
    .hover\:bg-blue-600:hover { background-color: #2563eb; }
    .hover\:bg-blue-700:hover { background-color: #1d4ed8; }
    .hover\:bg-gray-50:hover { background-color: #f9fafb; }
    .hover\:text-white:hover { color: #ffffff; }
    .hover\:border-blue-400:hover { border-color: #60a5fa; }

    .focus\:outline-none:focus { outline: 2px solid transparent; outline-offset: 2px; }
    .focus\:ring-1:focus { box-shadow: 0 0 0 1px; }
    .focus\:ring-blue-500:focus { --tw-ring-color: #3b82f6; box-shadow: 0 0 0 1px var(--tw-ring-color); }

    .divide-y > * + * { border-top-width: 1px; }
    .divide-gray-200 > * + * { border-color: #e5e7eb; }

    .bg-black\/30 { background-color: rgba(0, 0, 0, 0.3); }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="container mx-auto px-6 max-w-7xl">

        <!-- Header -->
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-700 flex items-center text-sm font-medium">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back
                </a>
                <span class="text-gray-300">|</span>
                <h1 class="text-lg text-gray-700 font-medium">Create Purchase Order</h1>
            </div>
        </div>

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <input type="hidden" name="supplier_id" id="supplier_id">

            <!-- Main Card -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-4">

                <!-- Supplier Header -->
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <button type="button" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
<div class="flex items-center">
    <span class="text-gray-900 font-medium" id="supplier_name_display">Supplier</span>
    <button type="button" id="btnCariSupplier"
        class="ml-2 px-3 py-1 border border-blue-600 text-blue-600 rounded-md text-sm hover:bg-blue-600 hover:text-white transition duration-200">
        Pilih
    </button>
</div>

                    </div>
                    <div class="flex items-center space-x-4">
                        <label class="flex items-center text-sm text-gray-600">
                            <input type="radio" name="is_kredit" value="CASH" id="cash" class="mr-2" checked>
                            Cash
                        </label>
                        <label class="flex items-center text-sm text-gray-600">
                            <input type="radio" name="is_kredit" value="KREDIT" id="kredit" class="mr-2">
                            Credit
                        </label>
                        <div id="hari_kredit_wrapper" class="hidden">
                            <input type="number" name="hari_kredit" id="hari_kredit" min="1" value="30"
                                   class="w-20 px-2 py-1 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                                   placeholder="Days">
                        </div>
                    </div>
                </div>

                <!-- Product Section -->
                <div id="order-fields" class="opacity-50 pointer-events-none">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Product Details</span>
                        </div>
                    </div>

                    <!-- Product Row -->
                    <div class="px-6 py-4">
                        <div class="grid grid-cols-12 gap-4 text-xs text-gray-500 uppercase font-medium mb-3">
                            <div class="col-span-2">SKU</div>
                            <div class="col-span-3">Nama Item</div>
                            <div class="col-span-1">Jumlah</div>
                            <div class="col-span-1">Satuan</div>
                            <div class="col-span-2">Harga Item</div>
                            <div class="col-span-2">Tanggal Kirim</div>
                            <div class="col-span-1 text-center">Aksi</div>
                        </div>

                        <div id="item-container">
                            <!-- Default item row -->
                            <div class="item-row grid grid-cols-12 gap-4 items-center py-3 border-t border-gray-100">
                                <div class="col-span-2">
                                    <input type="text"
                                           class="sku_display w-full px-3 py-2 text-sm border border-gray-300 rounded hover:border-blue-400 focus:outline-none focus:ring-1 focus:ring-blue-500 cursor-pointer"
                                           placeholder="Klik Pilih..." readonly>
                                    <input type="hidden" name="item_id[]" class="item_id">
                                </div>
                                <div class="col-span-3">
                                    <input type="text"
                                           class="nama_item w-full px-3 py-2 text-sm border border-gray-300 rounded bg-gray-50 focus:outline-none" readonly>
                                </div>
                                <div class="col-span-1">
                                    <input type="number" name="jumlah[]" min="1"
                                           class="jumlah w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                                <div class="col-span-1">
                                    <input type="text"
                                           class="satuan_display w-full px-3 py-2 text-sm border border-gray-300 rounded bg-gray-50 focus:outline-none" readonly>
                                    <input type="hidden" name="satuan_id[]" class="satuan_id">
                                </div>
                                <div class="col-span-2">
                                    <input type="number" name="harga[]" step="0.01"
                                           class="harga w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                                <div class="col-span-2">
                                    <input type="date" name="tgl_kirim[]"
                                           class="tgl_kirim w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500">
                                </div>
                                <div class="col-span-1 text-center">
                                    <button type="button" class="btn-remove-item text-red-600 hover:text-red-700 font-bold text-lg">✕</button>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol tambah baris -->
                        <div class="mt-4">
                            <button type="button" id="add-item-row"
                                class="px-4 py-2 rounded text-white text-sm font-medium"
                                style="background-color: #6366f1; hover:background-color: #4f46e5;">
                                ➕ Tambah Item
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Financial Section -->
                <div id="finance-fields" class="px-6 py-4 border-t border-gray-200 opacity-50 pointer-events-none">
                    <div class="grid grid-cols-4 gap-6">
                        <div>
                            <label class="block text-xs text-gray-600 mb-2">Discount (%)</label>
                            <input type="number" name="discount" id="discount" min="0" max="100" step="0.01"
                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                                   placeholder="0" disabled>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-600 mb-2">PPN (%)</label>
                            <input type="number" name="ppn" id="ppn" min="0" max="100" step="0.01"
                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                                   placeholder="0" disabled>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-600 mb-2">PPH (%)</label>
                            <input type="number" name="pph" id="pph" min="0" max="100" step="0.01"
                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-blue-500"
                                   placeholder="0" disabled>
                        </div>
                    </div>
                </div>

                <!-- Summary Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex justify-between items-start">
                        <div class="grid grid-cols-3 gap-8">
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Subtotal</div>
                                <div id="summarySubtotal" class="text-sm font-semibold text-gray-900">Rp 0</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Discount</div>
                                <div id="summaryDiscount" class="text-sm font-semibold text-red-600">Rp 0</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 mb-1">After Discount</div>
                                <div id="summaryAfterDiscount" class="text-sm font-semibold text-gray-900">Rp 0</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 mb-1">PPN</div>
                                <div id="summaryPPN" class="text-sm font-semibold text-green-600">Rp 0</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 mb-1">PPH</div>
                                <div id="summaryPPH" class="text-sm font-semibold text-orange-600">Rp 0</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 mb-1">Grand Total</div>
                                <div id="summaryGrandTotal" class="text-lg font-bold text-gray-900">Rp 0</div>
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('orders.index') }}"
                               class="px-6 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
                                Batalkan
                            </a>
                            <button type="submit"
                                    class="px-6 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700 transition-colors">
                                Buat PO
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<!-- Modal Supplier -->
<div id="modalSupplier" class="hidden fixed inset-0 bg-black/30 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4 max-h-[80vh] overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-medium text-gray-900">Pilih Supplier</h3>
            <button type="button" id="closeModal" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="overflow-y-auto max-h-96">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @foreach($suppliers as $supplier)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $supplier->kode_supplier }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $supplier->nama }}</td>
                        <td class="px-6 py-4 text-center">
                            <button type="button" class="pilihSupplier px-4 py-1.5 text-sm text-blue-600 hover:text-blue-700 font-medium"
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
<div id="modalSKU" class="hidden fixed inset-0 bg-black/30 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4 max-h-[80vh] overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h3 class="text-lg font-medium text-gray-900">Pilih SKU</h3>
            <button type="button" id="closeModalSKU" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="overflow-y-auto max-h-96">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">SKU</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Item</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody id="skuListBody" class="divide-y divide-gray-200">
                    @foreach($items as $item)
                        <tr class="sku-row hidden hover:bg-gray-50" data-supplier="{{ $item->supplier_id }}">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $item->sku }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $item->name }}</td>
                            <td class="px-6 py-4 text-center">
                                <button type="button" class="pilihSKU px-4 py-1.5 text-sm text-blue-600 hover:text-blue-700 font-medium"
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
    let currentSKUInput = null; // Track which SKU input is being filled

    // Modal Supplier
    document.getElementById('btnCariSupplier').addEventListener('click', () => {
        document.getElementById('modalSupplier').classList.remove('hidden');
    });

    document.getElementById('closeModal').addEventListener('click', () => {
        document.getElementById('modalSupplier').classList.add('hidden');
    });

    // Pilih Supplier
    document.querySelectorAll('.pilihSupplier').forEach(btn => {
        btn.addEventListener('click', function () {
            const supplierId = this.dataset.id;
            document.getElementById('supplier_id').value = supplierId;
            document.getElementById('supplier_name_display').textContent = this.dataset.nama;

            // Enable order fields
            orderFields.classList.remove('opacity-50', 'pointer-events-none');

            document.getElementById('modalSupplier').classList.add('hidden');
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

            currentSKUInput = e.target; // Store reference to clicked input

            skuRows.forEach(row => {
                row.classList.toggle('hidden', row.dataset.supplier !== supplierId);
            });
            modalSKU.classList.remove('hidden');
        }
    });

    closeModalSKU.addEventListener('click', () => {
        modalSKU.classList.add('hidden');
        currentSKUInput = null;
    });

    // Pilih SKU
    document.querySelectorAll('.pilihSKU').forEach(btn => {
        btn.addEventListener('click', function () {
            if (!currentSKUInput) return;

            const row = currentSKUInput.closest('.item-row');

            // Fill the current row
            row.querySelector('.item_id').value = this.dataset.id;
            row.querySelector('.sku_display').value = this.dataset.sku;
            row.querySelector('.nama_item').value = this.dataset.nama;
            row.querySelector('.satuan_display').value = this.dataset.satuanNama;
            row.querySelector('.satuan_id').value = this.dataset.satuanId;

            modalSKU.classList.add('hidden');
            currentSKUInput = null;

            checkFinanceFields();
        });
    });

    // Tambah item baru
    addItemBtn.addEventListener('click', function () {
        const firstRow = itemContainer.querySelector('.item-row');
        const newRow = firstRow.cloneNode(true);

        // Clear all input values
        newRow.querySelectorAll('input').forEach(input => {
            input.value = '';
        });

        itemContainer.appendChild(newRow);
    });

    // Hapus item
    itemContainer.addEventListener('click', function (e) {
        if (e.target.classList.contains('btn-remove-item')) {
            const allRows = itemContainer.querySelectorAll('.item-row');
            if (allRows.length > 1) {
                e.target.closest('.item-row').remove();
                hitungRingkasan();
            } else {
                alert('Minimal satu item harus ada.');
            }
        }
    });

    // Enable finance fields when at least one item is filled
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
            financeFields.classList.remove('opacity-50', 'pointer-events-none');
            financeFields.querySelectorAll('input').forEach(el => el.disabled = false);
        }
    }

    // Listen to changes in all item rows
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
        hariWrapper.classList.toggle('hidden', !kreditRadio.checked);
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
});
</script>
@endpush

@endsection
