@extends('layouts.app')

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
