@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Daftar Supplier</h3>
    <a href="{{ route('suppliers.create') }}" class="btn btn-primary mb-3">Tambah Supplier</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
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
                    <td>{{ $supplier->kode_supplier }}</td>
                    <td>{{ $supplier->nama }}</td>
                    <td>{{ $supplier->alamat ?? '-' }}</td>
                    <td>{{ $supplier->no_telp ?? '-' }}</td>
                    <td>{{ $supplier->items->count() }}</td>
                    <td>
                        <!-- Tombol Detail -->
                        <button type="button"
                                class="btn btn-sm btn-info"
                                data-bs-toggle="modal"
                                data-bs-target="#detailModal{{ $supplier->id }}">
                            Detail
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada supplier</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal Detail Supplier (Dipindahkan ke luar loop tbody) -->
@foreach($suppliers as $supplier)
<div class="modal fade" id="detailModal{{ $supplier->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Supplier: {{ $supplier->nama }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Kode:</strong> {{ $supplier->kode_supplier }}</p>
                <p><strong>Alamat:</strong> {{ $supplier->alamat ?? '-' }}</p>
                <p><strong>No. Telp:</strong> {{ $supplier->no_telp ?? '-' }}</p>

                <hr>
                <h6>Daftar Item</h6>

                <!-- Search box -->
                <input type="text"
                       class="form-control mb-2"
                       placeholder="Cari item..."
                       onkeyup="filterItems(this, 'tableItems{{ $supplier->id }}')">

                <table class="table table-bordered" id="tableItems{{ $supplier->id }}">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Nama Item</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($supplier->items as $item)
                            <tr>
                                <td>{{ $item->sku }}</td>
                                <td>{{ $item->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada item</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
