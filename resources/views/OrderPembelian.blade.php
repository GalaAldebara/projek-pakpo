@extends('layouts.app')

@if(session('success'))
<div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 text-green-800 border-l-4 border-green-400 rounded-lg shadow-sm animate-pulse">
    <div class="flex items-center">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        {{ session('success') }}
    </div>
</div>
@endif

@if(session('error'))
<div class="mb-6 p-4 bg-gradient-to-r from-red-50 to-rose-50 text-red-800 border-l-4 border-red-400 rounded-lg shadow-sm">
    <div class="flex items-center">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
        </svg>
        {{ session('error') }}
    </div>
</div>
@endif

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 py-8">
    <div class="container mx-auto px-6 max-w-7xl">
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Form Transaksi Supplier</h1>
                    <p class="text-gray-600">Kelola transaksi pembelian dari supplier dengan mudah</p>
                </div>
                <a href="{{ route('supplier.history') }}"
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Lihat History
                </a>
            </div>
        </div>

        <!-- Main Form -->
        <form action="{{ route('supplier.store') }}" method="POST" id="supplierForm" class="space-y-8">
            @csrf

            <!-- Supplier Information Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
                    <h2 class="text-2xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Informasi Supplier
                    </h2>
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Kode Supplier -->
                        <div class="space-y-3">
                            <label for="kode_supplier" class="block text-sm font-semibold text-gray-700">Kode Supplier</label>
                            <div class="flex space-x-3">
                                <button type="button" id="btnCariSupplier"
                                        class="flex-shrink-0 inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-medium rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Cari
                                </button>
                                <input type="text" name="kode_supplier" id="kode_supplier"
                                    class="flex-1 border-2 border-gray-300 rounded-xl px-4 py-3 bg-gray-50 text-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                                    readonly placeholder="Klik tombol cari untuk memilih supplier...">
                            </div>
                        </div>

                        <!-- Nama Supplier -->
                        <div class="space-y-3">
                            <label for="nama_supplier" class="block text-sm font-semibold text-gray-700">Nama Supplier</label>
                            <input type="text" name="nama_supplier" id="nama_supplier"
                                   class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 bg-gray-50 text-gray-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Information Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-600 to-green-600 px-8 py-6">
                    <h2 class="text-2xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        Informasi Pembayaran
                    </h2>
                </div>
                <div class="p-8">
                    <div class="space-y-6">
                        <!-- Pembayaran Checkbox -->
                        <div class="flex items-center space-x-6">
                            <div class="flex items-center">
                                <input type="radio" id="cash" name="is_kredit" value="CASH"
                                    class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500" checked>
                                <label for="cash" class="ml-2 text-lg font-medium text-gray-700 cursor-pointer">
                                    Cash
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input type="radio" id="kredit" name="is_kredit" value="KREDIT"
                                    class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500">
                                <label for="kredit" class="ml-2 text-lg font-medium text-gray-700 cursor-pointer">
                                    Kredit
                                </label>
                            </div>
                        </div>
                        <!-- Hari Kredit -->
                        <div id="hari_kredit_wrapper" class="hidden transition-all duration-300">
                            <label for="hari_kredit" class="block text-sm font-semibold text-gray-700 mb-3">
                                Jangka Waktu Kredit (Hari)
                            </label>
                            <input type="number" name="hari_kredit" id="hari_kredit"
                                class="w-full lg:w-1/3 border-2 border-gray-300 rounded-xl px-4 py-3
                                        focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                                min="1" value="30" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Items Table Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-orange-600 to-red-600 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold text-white flex items-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            Detail Barang
                        </h2>
                        <button type="button" id="addRow"
                                class="inline-flex items-center px-6 py-3 bg-white/20 hover:bg-white/30 text-white font-medium rounded-xl backdrop-blur-sm transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah Barang
                        </button>
                    </div>
                </div>

                <div class="p-8">
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                                    <th class="border-2 border-gray-300 px-4 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wide">Kode</th>
                                    <th class="border-2 border-gray-300 px-4 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wide">Nama Barang</th>
                                    <th class="border-2 border-gray-300 px-4 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wide">Jumlah</th>
                                    <th class="border-2 border-gray-300 px-4 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wide">Satuan</th>
                                    <th class="border-2 border-gray-300 px-4 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wide">Harga</th>
                                    <th class="border-2 border-gray-300 px-4 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wide">Total</th>
                                    <th class="border-2 border-gray-300 px-4 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wide">Tgl Kirim</th>
                                    <th class="border-2 border-gray-300 px-4 py-4 text-center text-sm font-bold text-gray-700 uppercase tracking-wide">Action</th>
                                </tr>
                            </thead>
                            <tbody id="barangTableBody" class="divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="border-2 border-gray-300 px-4 py-3">
                                        <input type="text" name="barang[0][kode]" class="w-full border-2 border-gray-300 rounded-lg px-3 py-2 kode_item focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 cursor-pointer" readonly required>
                                    </td>
                                    <td class="border-2 border-gray-300 px-4 py-3">
                                        <input type="text" name="barang[0][nama]" class="w-full border-2 border-gray-300 rounded-lg px-3 py-2 nama_barang focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 cursor-pointer" readonly required>
                                    </td>
                                    <td class="border-2 border-gray-300 px-4 py-3">
                                        <input type="number" name="barang[0][jumlah]" class="w-full border-2 border-gray-300 rounded-lg px-3 py-2 jumlah focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200" min="1" required>
                                    </td>
                                    <td class="border-2 border-gray-300 px-4 py-3">
                                        <select name="barang[0][satuan]" class="w-full border-2 border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200" required>
                                            <option value="KG">KG</option>
                                            <option value="Gram">Gram</option>
                                            <option value="Ons">Ons</option>
                                        </select>
                                    </td>
                                    <td class="border-2 border-gray-300 px-4 py-3">
                                        <input type="number" name="barang[0][harga]" class="w-full border-2 border-gray-300 rounded-lg px-3 py-2 harga focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200" min="0" required>
                                    </td>
                                    <td class="border-2 border-gray-300 px-4 py-3">
                                        <input type="number" name="barang[0][total]" class="w-full border-2 border-gray-300 rounded-lg px-3 py-2 total bg-gray-50 font-semibold text-gray-700" readonly>
                                    </td>
                                    <td class="border-2 border-gray-300 px-4 py-3">
                                        <input type="date" name="barang[0][tgl_kirim]" class="w-full border-2 border-gray-300 rounded-lg px-3 py-2 bg-gray-50" value="{{ date('Y-m-d') }}" readonly>
                                    </td>
                                    <td class="border-2 border-gray-300 px-4 py-3 text-center">
                                        <button type="button" class="text-red-500 hover:text-red-700 remove-row p-2 rounded-lg hover:bg-red-50 transition-all duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Financial Information Card -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-teal-600 to-cyan-600 px-8 py-6">
                    <h2 class="text-2xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        Informasi Keuangan
                    </h2>
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="space-y-3">
                            <label for="discount" class="block text-sm font-semibold text-gray-700">Discount (%)</label>
                            <div class="relative">
                                <input type="number" name="discount" id="discount"
                                       class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                                       min="0" max="100" step="0.01" placeholder="0.00">
                                <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">%</span>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label for="ppn" class="block text-sm font-semibold text-gray-700">PPN (%)</label>
                            <div class="relative">
                                <input type="number" name="ppn" id="ppn"
                                       class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                                       min="0" max="100" step="0.01" placeholder="0.00">
                                <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">%</span>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label for="pph" class="block text-sm font-semibold text-gray-700">PPH (%)</label>
                            <div class="relative">
                                <input type="number" name="pph" id="pph"
                                       class="w-full border-2 border-gray-300 rounded-xl px-4 py-3 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200"
                                       min="0" max="100" step="0.01" placeholder="0.00">
                                <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400">%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Financial Summary Card -->
            <div id="financialSummary" class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transition-all duration-300">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-8 py-6">
                    <h2 class="text-2xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Ringkasan Keuangan
                    </h2>
                </div>
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-blue-600">Subtotal</p>
                                    <p id="summarySubtotal" class="text-2xl font-bold text-blue-900">Rp 0</p>
                                </div>
                                <div class="bg-blue-100 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-red-50 border border-red-200 rounded-xl p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-red-600">Discount</p>
                                    <p id="summaryDiscount" class="text-2xl font-bold text-red-900">Rp 0</p>
                                </div>
                                <div class="bg-red-100 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 border border-gray-200 rounded-xl p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Setelah Discount</p>
                                    <p id="summaryAfterDiscount" class="text-2xl font-bold text-gray-900">Rp 0</p>
                                </div>
                                <div class="bg-gray-100 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-green-50 border border-green-200 rounded-xl p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-green-600">PPN</p>
                                    <p id="summaryPPN" class="text-2xl font-bold text-green-900">Rp 0</p>
                                </div>
                                <div class="bg-green-100 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-orange-50 border border-orange-200 rounded-xl p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-orange-600">PPH</p>
                                    <p id="summaryPPH" class="text-2xl font-bold text-orange-900">Rp 0</p>
                                </div>
                                <div class="bg-orange-100 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-purple-50 border border-purple-200 rounded-xl p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-purple-600">Grand Total</p>
                                    <p id="summaryGrandTotal" class="text-2xl font-bold text-purple-900">Rp 0</p>
                                </div>
                                <div class="bg-purple-100 p-3 rounded-lg">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6-4a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
                <div class="flex justify-center">
                    <button type="submit"
                            class="inline-flex items-center px-12 py-4 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white text-lg font-bold rounded-2xl shadow-2xl hover:shadow-3xl transform hover:-translate-y-1 transition-all duration-300">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Transaksi
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- MODAL SUPPLIER --}}
<div id="supplierModal" class="fixed inset-0 bg-black bg-opacity-60 hidden justify-center items-center z-50 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-11/12 max-w-4xl mx-4 max-h-[80vh] overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6">
            <h3 class="text-2xl font-bold text-white flex items-center">
                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Pilih Supplier
            </h3>
        </div>
        <div class="p-8 overflow-y-auto max-h-96">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                            <th class="border-2 border-gray-300 px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wide">Kode Supplier</th>
                            <th class="border-2 border-gray-300 px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wide">Nama Supplier</th>
                            <th class="border-2 border-gray-300 px-6 py-4 text-center text-sm font-bold text-gray-700 uppercase tracking-wide">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($suppliers as $supplier)
                        <tr class="hover:bg-blue-50 transition-colors duration-200">
                            <td class="border-2 border-gray-300 px-6 py-4 font-mono text-sm">{{ $supplier->kode_supplier }}</td>
                            <td class="border-2 border-gray-300 px-6 py-4 font-medium">{{ $supplier->nama_supplier }}</td>
                            <td class="border-2 border-gray-300 px-6 py-4 text-center">
                                <button type="button" class="pilihSupplier inline-flex items-center px-6 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200"
                                        data-kode="{{ $supplier->kode_supplier }}"
                                        data-nama="{{ $supplier->nama_supplier }}">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Pilih
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bg-gray-50 px-8 py-6 flex justify-end">
            <button id="closeSupplierModal" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Tutup
            </button>
        </div>
    </div>
</div>

{{-- Enhanced JavaScript --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const kreditCheckbox = document.getElementById('kredit');
    const cashRadio = document.getElementById('cash');
    const hariWrapper = document.getElementById('hari_kredit_wrapper');
    let rowIndex = 1;

    // Financial calculation functions
    function formatRupiah(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount);
    }

    // CORRECTED FINANCIAL CALCULATION FUNCTION
    function calculateFinancialSummary() {
        let subtotal = 0;

        // Calculate subtotal from all items
        document.querySelectorAll('.total').forEach(input => {
            const value = parseFloat(input.value) || 0;
            subtotal += value;
        });

        const discount = parseFloat(document.getElementById('discount').value) || 0;
        const ppn = parseFloat(document.getElementById('ppn').value) || 0;
        const pph = parseFloat(document.getElementById('pph').value) || 0;

        // Calculate all amounts from original subtotal (CORRECTED)
        const discountAmount = (subtotal * discount) / 100;
        const ppnAmount = (subtotal * ppn) / 100;        // From original subtotal
        const pphAmount = (subtotal * pph) / 100;        // From original subtotal

        // Calculate final amounts
        const afterDiscount = subtotal - discountAmount;
        const grandTotal = subtotal - discountAmount + ppnAmount - pphAmount;

        // Update summary display
        document.getElementById('summarySubtotal').textContent = formatRupiah(subtotal);
        document.getElementById('summaryDiscount').textContent = formatRupiah(discountAmount);
        document.getElementById('summaryAfterDiscount').textContent = formatRupiah(afterDiscount);
        document.getElementById('summaryPPN').textContent = formatRupiah(ppnAmount);
        document.getElementById('summaryPPH').textContent = formatRupiah(pphAmount);
        document.getElementById('summaryGrandTotal').textContent = formatRupiah(grandTotal);

        // Add animation effect
        const summaryCard = document.getElementById('financialSummary');
        summaryCard.classList.add('ring-2', 'ring-blue-300');
        setTimeout(() => {
            summaryCard.classList.remove('ring-2', 'ring-blue-300');
        }, 1000);
    }

    // Enhanced disable input function with better styling
    const toggleBarangInputs = (enabled) => {
        const elements = document.querySelectorAll('#barangTableBody input, #barangTableBody select, #addRow');
        elements.forEach(el => {
            el.disabled = !enabled;
            if (!enabled) {
                el.classList.add('bg-gray-100', 'cursor-not-allowed', 'opacity-50');
                el.classList.remove('hover:border-blue-500', 'focus:border-blue-500');
            } else {
                el.classList.remove('bg-gray-100', 'cursor-not-allowed', 'opacity-50');
                el.classList.add('hover:border-blue-500', 'focus:border-blue-500');
            }
        });
    };
    toggleBarangInputs(false);

    // Enhanced kredit toggle with smooth animation
    kreditCheckbox.addEventListener('change', () => {
        if (kreditCheckbox.checked) {
            hariWrapper.classList.remove('hidden');
            setTimeout(() => {
                hariWrapper.style.opacity = '1';
                hariWrapper.style.transform = 'translateY(0)';
            }, 10);
        } else {
            hariWrapper.style.opacity = '0';
            hariWrapper.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                hariWrapper.classList.add('hidden');
            }, 300);
        }
    });

    // Enhanced modal supplier
    const supplierModal = document.getElementById('supplierModal');
    const btnCariSupplier = document.getElementById('btnCariSupplier');
    const closeSupplierModal = document.getElementById('closeSupplierModal');

    btnCariSupplier.addEventListener('click', () => {
        supplierModal.classList.remove('hidden');
        supplierModal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    });

    closeSupplierModal.addEventListener('click', () => {
        supplierModal.classList.add('hidden');
        supplierModal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    });

    // Enhanced supplier selection
    document.querySelectorAll('.pilihSupplier').forEach(btn => {
        btn.addEventListener('click', () => {
            const kode = btn.getAttribute('data-kode');
            const nama = btn.getAttribute('data-nama');
            document.getElementById('kode_supplier').value = kode;
            document.getElementById('nama_supplier').value = nama;
            toggleBarangInputs(true);
            supplierModal.classList.add('hidden');
            supplierModal.classList.remove('flex');
            document.body.style.overflow = 'auto';

            // Show success feedback
            const supplierInputs = document.querySelectorAll('#kode_supplier, #nama_supplier');
            supplierInputs.forEach(input => {
                input.classList.add('border-green-400', 'bg-green-50');
                setTimeout(() => {
                    input.classList.remove('border-green-400', 'bg-green-50');
                }, 2000);
            });
        });
    });

    // Enhanced modal item
    const itemModal = document.createElement('div');
    itemModal.id = 'itemModal';
    itemModal.className = 'fixed inset-0 bg-black bg-opacity-60 hidden justify-center items-center z-50 backdrop-blur-sm';
    itemModal.innerHTML = `
        <div class="bg-white rounded-2xl shadow-2xl w-11/12 max-w-4xl mx-4 max-h-[80vh] overflow-hidden">
            <div class="bg-gradient-to-r from-orange-600 to-red-600 px-8 py-6">
                <h3 class="text-2xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Pilih Barang
                </h3>
            </div>
            <div class="p-8 overflow-y-auto max-h-96">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse" id="itemTable">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-50 to-gray-100">
                                <th class="border-2 border-gray-300 px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wide">Kode Item</th>
                                <th class="border-2 border-gray-300 px-6 py-4 text-left text-sm font-bold text-gray-700 uppercase tracking-wide">Nama Barang</th>
                                <th class="border-2 border-gray-300 px-6 py-4 text-center text-sm font-bold text-gray-700 uppercase tracking-wide">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200"></tbody>
                    </table>
                </div>
            </div>
            <div class="bg-gray-50 px-8 py-6 flex justify-end">
                <button id="closeItemModal" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Tutup
                </button>
            </div>
        </div>
    `;
    document.body.appendChild(itemModal);

    const closeItemModal = document.getElementById('closeItemModal');
    closeItemModal.addEventListener('click', () => {
        itemModal.classList.add('hidden');
        itemModal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    });

    let currentRow = null;

    // Enhanced item selection with loading state
    document.getElementById('barangTableBody').addEventListener('click', (e) => {
        if (e.target.classList.contains('kode_item') || e.target.classList.contains('nama_barang')) {
            const supplierId = document.getElementById('kode_supplier').value;
            if (!supplierId) {
                // Show warning message
                const toast = document.createElement('div');
                toast.className = 'fixed top-4 right-4 bg-yellow-500 text-white px-6 py-3 rounded-lg shadow-lg z-50';
                toast.innerHTML = 'Pilih supplier terlebih dahulu!';
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 3000);
                return;
            }

            currentRow = e.target.closest('tr');

            // Show loading state
            e.target.value = 'Loading...';
            e.target.classList.add('animate-pulse');

            fetch(`/supplier/${supplierId}/items`)
                .then(res => res.json())
                .then(data => {
                    e.target.value = '';
                    e.target.classList.remove('animate-pulse');

                    const tbody = itemModal.querySelector('tbody');
                    tbody.innerHTML = '';
                    data.forEach(item => {
                        const tr = document.createElement('tr');
                        tr.className = 'hover:bg-orange-50 transition-colors duration-200';
                        tr.innerHTML = `
                            <td class="border-2 border-gray-300 px-6 py-4 font-mono text-sm">${item.kode_item}</td>
                            <td class="border-2 border-gray-300 px-6 py-4 font-medium">${item.nama_item}</td>
                            <td class="border-2 border-gray-300 px-6 py-4 text-center">
                                <button class="inline-flex items-center px-6 py-2 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 pilihItem"
                                        data-kode="${item.kode_item}"
                                        data-nama="${item.nama_item}">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Pilih
                                </button>
                            </td>
                        `;
                        tbody.appendChild(tr);
                    });
                    itemModal.classList.remove('hidden');
                    itemModal.classList.add('flex');
                    document.body.style.overflow = 'hidden';
                })
                .catch(error => {
                    e.target.value = '';
                    e.target.classList.remove('animate-pulse');
                    console.error('Error:', error);
                });
        }
    });

    // Enhanced item selection
    itemModal.addEventListener('click', (e) => {
        if (e.target.classList.contains('pilihItem') && currentRow) {
            currentRow.querySelector('.kode_item').value = e.target.dataset.kode;
            currentRow.querySelector('.nama_barang').value = e.target.dataset.nama;
            itemModal.classList.add('hidden');
            itemModal.classList.remove('flex');
            document.body.style.overflow = 'auto';

            // Show success feedback
            const itemInputs = currentRow.querySelectorAll('.kode_item, .nama_barang');
            itemInputs.forEach(input => {
                input.classList.add('border-green-400', 'bg-green-50');
                setTimeout(() => {
                    input.classList.remove('border-green-400', 'bg-green-50');
                }, 2000);
            });
        }
    });

    // Enhanced total calculation with animation
    function updateTotal(row) {
        const jumlah = parseFloat(row.querySelector('.jumlah')?.value) || 0;
        const harga = parseFloat(row.querySelector('.harga')?.value) || 0;
        const totalInput = row.querySelector('.total');
        const newTotal = jumlah * harga;

        totalInput.value = newTotal;

        // Animate total change
        if (newTotal > 0) {
            totalInput.classList.add('bg-green-100', 'border-green-300');
            setTimeout(() => {
                totalInput.classList.remove('bg-green-100', 'border-green-300');
            }, 1000);
        }

        // Recalculate financial summary
        calculateFinancialSummary();
    }

    document.getElementById('barangTableBody').addEventListener('input', (e) => {
        if (e.target.classList.contains('jumlah') || e.target.classList.contains('harga')) {
            updateTotal(e.target.closest('tr'));
        }
    });

    // Listen for changes in financial fields
    document.getElementById('discount').addEventListener('input', calculateFinancialSummary);
    document.getElementById('ppn').addEventListener('input', calculateFinancialSummary);
    document.getElementById('pph').addEventListener('input', calculateFinancialSummary);

    // Enhanced add row with better styling
    document.getElementById('addRow').addEventListener('click', () => {
        const tbody = document.getElementById('barangTableBody');
        const today = new Date().toISOString().split('T')[0];
        const row = document.createElement('tr');
        row.className = 'hover:bg-gray-50 transition-colors duration-200 animate-fadeIn';
        row.innerHTML = `
            <td class="border-2 border-gray-300 px-4 py-3">
                <input type="text" name="barang[${rowIndex}][kode]" class="w-full border-2 border-gray-300 rounded-lg px-3 py-2 kode_item focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 cursor-pointer" readonly required>
            </td>
            <td class="border-2 border-gray-300 px-4 py-3">
                <input type="text" name="barang[${rowIndex}][nama]" class="w-full border-2 border-gray-300 rounded-lg px-3 py-2 nama_barang focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 cursor-pointer" readonly required>
            </td>
            <td class="border-2 border-gray-300 px-4 py-3">
                <input type="number" name="barang[${rowIndex}][jumlah]" class="w-full border-2 border-gray-300 rounded-lg px-3 py-2 jumlah focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200" min="1" required>
            </td>
            <td class="border-2 border-gray-300 px-4 py-3">
                <select name="barang[${rowIndex}][satuan]" class="w-full border-2 border-gray-300 rounded-lg px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200" required>
                    <option value="KG">KG</option>
                    <option value="Gram">Gram</option>
                    <option value="Ons">Ons</option>
                </select>
            </td>
            <td class="border-2 border-gray-300 px-4 py-3">
                <input type="number" name="barang[${rowIndex}][harga]" class="w-full border-2 border-gray-300 rounded-lg px-3 py-2 harga focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200" min="0" required>
            </td>
            <td class="border-2 border-gray-300 px-4 py-3">
                <input type="number" name="barang[${rowIndex}][total]" class="w-full border-2 border-gray-300 rounded-lg px-3 py-2 total bg-gray-50 font-semibold text-gray-700" readonly>
            </td>
            <td class="border-2 border-gray-300 px-4 py-3">
                <input type="date" name="barang[${rowIndex}][tgl_kirim]" class="w-full border-2 border-gray-300 rounded-lg px-3 py-2 bg-gray-50" value="${today}" readonly>
            </td>
            <td class="border-2 border-gray-300 px-4 py-3 text-center">
                <button type="button" class="text-red-500 hover:text-red-700 remove-row p-2 rounded-lg hover:bg-red-50 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </td>
        `;
        tbody.appendChild(row);
        rowIndex++;

        const supplierDipilih = document.getElementById('kode_supplier').value !== '';
        toggleBarangInputs(supplierDipilih);
    });

    // Enhanced remove row with confirmation
    document.addEventListener('click', (e) => {
        if (e.target.closest('.remove-row')) {
            const row = e.target.closest('tr');
            if (confirm('Apakah Anda yakin ingin menghapus baris ini?')) {
                row.style.opacity = '0';
                row.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    row.remove();
                    calculateFinancialSummary(); // Recalculate after removal
                }, 200);
            }
        }
    });

    // Add some CSS animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }

        /* Custom scrollbar */
        .overflow-y-auto::-webkit-scrollbar {
            width: 8px;
        }
        .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }
        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    `;
    document.head.appendChild(style);

    // Initial calculation
    calculateFinancialSummary();
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const cashRadio = document.getElementById("cash");
    const kreditRadio = document.getElementById("kredit");
    const wrapper = document.getElementById("hari_kredit_wrapper");
    const hariInput = document.getElementById("hari_kredit");

    // Pastikan semua elemen ada sebelum menambahkan event
    if (!cashRadio || !kreditRadio || !wrapper || !hariInput) return;

    function toggleKredit() {
        if (kreditRadio.checked) {
            wrapper.classList.remove("hidden");
            hariInput.value = 30;              // default
            hariInput.setAttribute("readonly", true);
        } else {
            wrapper.classList.add("hidden");
            hariInput.value = "";              // reset jika Cash
            hariInput.removeAttribute("readonly");
        }
    }

    // initial load
    toggleKredit();

    // listen on change
    cashRadio.addEventListener("change", toggleKredit);
    kreditRadio.addEventListener("change", toggleKredit);

    // Optional: animasi smooth
    wrapper.style.transition = "all 0.3s ease";
});
</script>

@endsection
