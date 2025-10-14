@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-6">
            <h2 class="text-2xl font-bold flex items-center">
                <span class="text-3xl mr-3">📦</span>
                Tambah Barang Masuk
            </h2>
        </div>

        <div class="p-8">
            @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-r-lg">
                <div class="flex items-center">
                    <span class="text-2xl mr-3">✅</span>
                    <p class="text-green-800 font-semibold">{{ session('success') }}</p>
                    <button type="button" class="ml-auto text-green-600 hover:text-green-800" onclick="this.parentElement.parentElement.style.display='none'">
                        <span class="text-xl">&times;</span>
                    </button>
                </div>
            </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-r-lg">
                    <div class="flex">
                        <span class="text-2xl mr-3">⚠️</span>
                        <div class="flex-1">
                            <p class="text-red-800 font-semibold">Terdapat kesalahan:</p>
                            <ul class="mt-2 text-red-700 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="text-red-600 hover:text-red-800" onclick="this.parentElement.parentElement.style.display='none'">
                            <span class="text-xl">&times;</span>
                        </button>
                    </div>
                </div>
            @endif

            <form action="{{ route('barang-masuk.store') }}" method="POST">
                @csrf

                <!-- Header Information -->
                <div class="mb-8">
                    <div class="bg-gray-50 rounded-xl border border-gray-200 overflow-hidden">
                        <div class="bg-gray-100 px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                                <span class="text-xl mr-2">📋</span>
                                Informasi Header
                            </h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                <div class="lg:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <span class="mr-2">📄</span>No Bukti (PO)
                                    </label>
                                    <div class="flex gap-3">
                                        <input type="text" name="no_bukti" id="no_bukti"
                                               class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50"
                                               readonly required placeholder="Pilih PO terlebih dahulu">
                                        <button type="button"
                                                class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200 font-medium"
                                                id="btnCariPO" onclick="openModal()">
                                            <span class="mr-2">🔍</span>Cari PO
                                        </button>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <span class="mr-2">📅</span>Tanggal Terima
                                    </label>
                                    <input type="date" name="tanggal_terima" id="tanggal_terima"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           required>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <span class="mr-2">🆔</span>Supplier ID
                                    </label>
                                    <input type="number" name="supplier_id" id="supplier_id"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50"
                                           readonly required placeholder="Auto fill dari PO">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <span class="mr-2">🏷️</span>Kode Supplier
                                    </label>
                                    <input type="text" name="kode_supplier" id="kode_supplier"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50"
                                           readonly required placeholder="Auto fill dari PO">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <span class="mr-2">🏢</span>Nama Supplier
                                    </label>
                                    <input type="text" name="nama_supplier" id="nama_supplier"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50"
                                           readonly required placeholder="Auto fill dari PO">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <span class="mr-2">🚚</span>Surat Jalan
                                    </label>
                                    <input type="text" name="surat_jalan"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                           placeholder="Nomor surat jalan (opsional)">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <span class="mr-2">🚩</span>Status
                                    </label>
                                    <select name="status"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            required>
                                        <option value="">Pilih Status</option>
                                        <option value="PENDING">⏳ Pending</option>
                                        <option value="DITERIMA" selected>✅ Diterima</option>
                                        <option value="SELESAI">🎯 Selesai</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        <span class="mr-2">📝</span>Keterangan
                                    </label>
                                    <textarea name="keterangan" rows="3"
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                                              placeholder="Keterangan tambahan (opsional)"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail Barang Section -->
                <div class="mb-8">
                    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                        <div class="bg-green-500 text-white px-6 py-4 flex justify-between items-center">
                            <h3 class="text-lg font-semibold flex items-center">
                                <span class="text-xl mr-2">📦</span>
                                Detail Barang
                            </h3>
                            <button type="button" id="add-row"
                                    class="px-4 py-2 bg-white text-green-600 rounded-lg hover:bg-gray-50 transition duration-200 font-medium text-sm">
                                <span class="mr-1">➕</span>Tambah Barang
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full" id="detail-table">
                                <thead class="bg-gray-800 text-white">
                                    <tr>
                                        <th class="px-4 py-4 text-center text-sm font-semibold">
                                            <span class="mr-2">🏷️</span>Kode Barang
                                        </th>
                                        <th class="px-4 py-4 text-center text-sm font-semibold">
                                            <span class="mr-2">📦</span>Nama Barang
                                        </th>
                                        <th class="px-4 py-4 text-center text-sm font-semibold">
                                            <span class="mr-2">🛒</span>Jumlah Order
                                        </th>
                                        <th class="px-4 py-4 text-center text-sm font-semibold">
                                            <span class="mr-2">✅</span>Jumlah Terima
                                        </th>
                                        <th class="px-4 py-4 text-center text-sm font-semibold">
                                            <span class="mr-2">⚖️</span>Satuan
                                        </th>
                                        <th class="px-4 py-4 text-center text-sm font-semibold">
                                            <span class="mr-2">🚛</span>Tanggal Kirim
                                        </th>
                                        <th class="px-4 py-4 text-center text-sm font-semibold">
                                            <span class="mr-2">⚙️</span>Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                            <span class="text-2xl mr-2">💡</span>
                                            Pilih PO terlebih dahulu untuk memuat detail barang
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-end">
                    <a href="{{ route('barang-masuk.index') }}"
                       class="px-8 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200 font-medium text-center">
                        <span class="mr-2">❌</span>Batal
                    </a>
                    <button type="submit"
                            class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 font-medium">
                        <span class="mr-2">💾</span>Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Cari PO -->
<div class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50" id="modalCariPO">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-6xl mx-4 max-h-[90vh] overflow-hidden">
        <div class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white p-6">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold flex items-center">
                    <span class="text-2xl mr-3">🔍</span>
                    Cari Transaksi (Purchase Order)
                </h3>
                <button type="button" class="text-white hover:text-gray-200 text-2xl" onclick="closeModal()">
                    &times;
                </button>
            </div>
        </div>

        <div class="p-6">
            <div class="mb-6">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-400 text-lg">🔍</span>
                    </div>
                    <input type="text" id="searchPO"
                           class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Ketik untuk mencari berdasarkan no bukti atau nama supplier...">
                </div>
            </div>

            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <div class="overflow-x-auto max-h-96">
                    <table class="w-full" id="po-table">
                        <thead class="bg-blue-50 sticky top-0">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                    <span class="mr-2">📄</span>No Bukti
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                    <span class="mr-2">🏢</span>Nama Supplier
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                    <span class="mr-2">🆔</span>Supplier ID
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                    <span class="mr-2">📅</span>Tanggal Kirim
                                </th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">
                                    <span class="mr-2">⚙️</span>Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex items-center justify-center">
                                        <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-500 mr-3"></div>
                                        Memuat data PO...
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 px-6 py-4 flex justify-end">
            <button type="button"
                    class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200"
                    onclick="closeModal()">
                <span class="mr-2">❌</span>Tutup
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Set tanggal terima default hari ini
    const today = new Date().toISOString().split("T")[0];
    document.getElementById("tanggal_terima").value = today;

    let poData = []; // Store PO data for search functionality

    // Modal functions
    window.openModal = function() {
        document.getElementById('modalCariPO').classList.remove('hidden');
        document.getElementById('modalCariPO').classList.add('flex');
        loadPOData();
    }

    window.closeModal = function() {
        document.getElementById('modalCariPO').classList.add('hidden');
        document.getElementById('modalCariPO').classList.remove('flex');
    }

    // Function to load PO data
    function loadPOData() {
        const tbody = document.querySelector("#po-table tbody");

        fetch("{{ url('/transaksi') }}")
            .then(res => {
                if (!res.ok) {
                    throw new Error('Network response was not ok');
                }
                return res.json();
            })
            .then(data => {
                tbody.innerHTML = "";

                if (data.success && data.pesanan && data.pesanan.length > 0) {
                    poData = data.pesanan; // simpan untuk pencarian
                    renderPOTable(poData);
                } else {
                    tbody.innerHTML = '<tr><td colspan="5" class="px-6 py-12 text-center text-gray-500"><span class="text-2xl mr-2">📭</span>Tidak ada data PO PROSES</td></tr>';
                }
            })
            .catch(error => {
                console.error('Error loading PO data:', error);
                tbody.innerHTML = '<tr><td colspan="5" class="px-6 py-12 text-center text-red-500"><span class="text-2xl mr-2">❌</span>Error memuat data PO</td></tr>';
            });
    }

    // Function to render PO table
    function renderPOTable(data) {
        const tbody = document.querySelector("#po-table tbody");
        tbody.innerHTML = "";

        if (data.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" class="px-6 py-12 text-center text-gray-500"><span class="text-2xl mr-2">🔍</span>Tidak ada data yang sesuai dengan pencarian</td></tr>';
            return;
        }

        data.forEach(item => {
            const tr = document.createElement("tr");
            tr.className = "hover:bg-gray-50 transition-colors duration-150";
            tr.innerHTML = `
                <td class="px-6 py-4 font-semibold text-gray-900">${item.no_bukti || ''}</td>
                <td class="px-6 py-4 text-gray-700">${item.supplier?.nama || 'N/A'}</td>
                <td class="px-6 py-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        ${item.supplier?.id || 'N/A'}
                    </span>
                </td>
                <td class="px-6 py-4 text-gray-700">${item.created_at ? item.created_at.split("T")[0] : 'N/A'}</td>
                <td class="px-6 py-4 text-center">
                    <button type="button"
                            class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200 font-medium pilih-po"
                            data-no_bukti="${item.no_bukti || ''}"
                            data-supplier_id="${item.supplier?.id || ''}"
                            data-kode_supplier="${item.supplier?.kode_supplier || ''}"
                            data-nama_supplier="${item.supplier?.nama || ''}">
                        <span class="mr-1">✅</span>Pilih
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    // Search functionality
    document.getElementById('searchPO').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const filteredData = poData.filter(item => {
            return (item.no_bukti && item.no_bukti.toLowerCase().includes(searchTerm)) ||
                   (item.supplier?.nama_supplier && item.supplier.nama_supplier.toLowerCase().includes(searchTerm));
        });
        renderPOTable(filteredData);
    });

    // Handle PO selection
    document.addEventListener("click", function(e) {
        if (e.target.classList.contains("pilih-po")) {
            // Fill form fields
            document.getElementById("no_bukti").value = e.target.dataset.no_bukti;
            document.getElementById("supplier_id").value = e.target.dataset.supplier_id;
            document.getElementById("kode_supplier").value = e.target.dataset.kode_supplier;
            document.getElementById("nama_supplier").value = e.target.dataset.nama_supplier;

            // Fetch detail barang
            const noBukti = e.target.dataset.no_bukti;
            if (noBukti) {
                fetch("{{ url('/barang-masuk/transaksi') }}/" + encodeURIComponent(noBukti))
                    .then(res => {
                        if (!res.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return res.json();
                    })
                    .then(data => {
                        if (data.success && data.barang) {
                            const tbody = document.querySelector("#detail-table tbody");
                            tbody.innerHTML = "";
                            data.barang.forEach((barang, idx) => {
                                const row = document.createElement("tr");
                                row.className = "hover:bg-gray-50";
                                row.innerHTML = `
                                    <td class="px-4 py-3">
                                        <input type="text" name="detail[${idx}][kode_barang]" value="${barang.kode || ''}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 bg-gray-50" readonly>
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="text" name="detail[${idx}][nama_barang]" value="${barang.nama || ''}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 bg-gray-50" readonly>
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="number" step="0.01" name="detail[${idx}][jumlah_order]" value="${barang.jumlah || 0}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-center bg-gray-50" readonly>
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="number" step="0.01" name="detail[${idx}][jumlah_terima]" value="0"
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-center" required>
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="text" name="detail[${idx}][satuan]" value="${barang.satuan || ''}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-center bg-gray-50" readonly>
                                    </td>
                                    <td class="px-4 py-3">
                                        <input type="date" name="detail[${idx}][tgl_kirim]" value="${today}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500" required>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <button type="button" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition duration-200 text-sm remove-row">
                                            🗑️ Hapus
                                        </button>
                                    </td>
                                `;
                                tbody.appendChild(row);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error loading detail barang:', error);
                        alert('Error memuat detail barang: ' + error.message);
                    });
            }

            // Hide modal
            closeModal();
        }
    });

    // Add manual row
    let rowIndex = 100;
    document.getElementById('add-row').addEventListener('click', function () {
        const table = document.querySelector("#detail-table tbody");
        const newRow = document.createElement('tr');
        newRow.className = "hover:bg-gray-50";
        newRow.innerHTML = `
            <td class="px-4 py-3">
                <input type="text" name="detail[${rowIndex}][kode_barang]"
                       class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                       required placeholder="Kode barang">
            </td>
            <td class="px-4 py-3">
                <input type="text" name="detail[${rowIndex}][nama_barang]"
                       class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                       required placeholder="Nama barang">
            </td>
            <td class="px-4 py-3">
                <input type="number" step="0.01" name="detail[${rowIndex}][jumlah_order]"
                       class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-center"
                       required placeholder="0">
            </td>
            <td class="px-4 py-3">
                <input type="number" step="0.01" name="detail[${rowIndex}][jumlah_terima]"
                       class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-center"
                       required placeholder="0">
            </td>
            <td class="px-4 py-3">
                <input type="text" name="detail[${rowIndex}][satuan]"
                       class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500 text-center"
                       required placeholder="Unit">
            </td>
            <td class="px-4 py-3">
                <input type="date" name="detail[${rowIndex}][tgl_kirim]" value="${today}"
                       class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                       required>
            </td>
            <td class="px-4 py-3 text-center">
                <button type="button" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition duration-200 text-sm remove-row">
                    🗑️ Hapus
                </button>
            </td>
        `;
        table.appendChild(newRow);
        rowIndex++;
    });

    // Remove row
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-row")) {
            if (confirm('Apakah Anda yakin ingin menghapus baris ini?')) {
                e.target.closest("tr").remove();
            }
        }
    });

ocument.querySelector('form').addEventListener('submit', function(e) {
    const detailRows = document.querySelectorAll('#detail-table tbody tr');

    // Cek apakah ada detail barang
    if (detailRows.length === 0) {
        e.preventDefault();
        alert('⚠️ Minimal harus ada 1 detail barang!');
        return false;
    }

    // Validasi setiap baris detail
    let hasError = false;
    let errorMessages = [];

    detailRows.forEach((row, index) => {
        const jumlahTerimaInput = row.querySelector('input[name*="[jumlah_terima]"]');
        const namaBarangInput = row.querySelector('input[name*="[nama_barang]"]');

        if (jumlahTerimaInput) {
            const jumlahTerima = parseFloat(jumlahTerimaInput.value) || 0;
            const namaBarang = namaBarangInput ? namaBarangInput.value : `Baris ${index + 1}`;

            if (jumlahTerima <= 0) {
                hasError = true;
                errorMessages.push(`• ${namaBarang}: Jumlah terima harus lebih dari 0`);
                jumlahTerimaInput.classList.add('border-red-500', 'bg-red-50');
            } else {
                jumlahTerimaInput.classList.remove('border-red-500', 'bg-red-50');
            }
        }
    });

    if (hasError) {
        e.preventDefault();

        // Tampilkan alert dengan daftar error
        const errorMessage = '⚠️ VALIDASI GAGAL!\n\nJumlah terima tidak boleh 0 atau kosong:\n\n' +
                            errorMessages.join('\n') +
                            '\n\nSilakan perbaiki data terlebih dahulu.';
        alert(errorMessage);

        // Scroll ke baris pertama yang error
        const firstErrorInput = document.querySelector('input[name*="[jumlah_terima]"].border-red-500');
        if (firstErrorInput) {
            firstErrorInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstErrorInput.focus();
        }

        return false;
    }
});

// Tambahkan validasi real-time saat user mengetik
document.addEventListener('input', function(e) {
    if (e.target.name && e.target.name.includes('[jumlah_terima]')) {
        const value = parseFloat(e.target.value) || 0;

        if (value <= 0) {
            e.target.classList.add('border-red-500', 'bg-red-50');

            // Tambahkan tooltip error jika belum ada
            if (!e.target.nextElementSibling || !e.target.nextElementSibling.classList.contains('error-tooltip')) {
                const errorTooltip = document.createElement('div');
                errorTooltip.className = 'error-tooltip text-red-600 text-xs mt-1';
                errorTooltip.textContent = '⚠️ Harus lebih dari 0';
                e.target.parentNode.appendChild(errorTooltip);
            }
        } else {
            e.target.classList.remove('border-red-500', 'bg-red-50');

            // Hapus tooltip error jika ada
            const errorTooltip = e.target.parentNode.querySelector('.error-tooltip');
            if (errorTooltip) {
                errorTooltip.remove();
            }
        }
    }
});
});
</script>

@endsection
