@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Item</h3>
    <form method="POST" action="{{ route('items.store') }}">
        @csrf
        <div class="mb-3">
            <label>Nama Item</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Supplier</label>
            <select name="supplier_id" class="form-control" required>
                <option value="">-- Pilih Supplier --</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}">{{ $supplier->nama }}</option>
                @endforeach
            </select>
        </div>
                <div class="mb-3">
            <label>Satuan</label>
            <select name="satuan_id" class="form-control" required>
                <option value="">-- Pilih Satuan --</option>
                @foreach($satuan as $satuan)
                    <option value="{{ $satuan->id }}">{{ $satuan->nama }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
