@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Barang Masuk - {{ $barangMasuk->no_bukti }}</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('barang-masuk.update', $barangMasuk->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="supplier" class="form-label">Supplier</label>
            <input type="text" class="form-control" value="{{ $barangMasuk->supplier->nama ?? '-' }}" readonly>
        </div>

        <div class="mb-3">
            <label for="tanggal_terima" class="form-label">Tanggal Terima</label>
            <input type="date" name="tanggal_terima" class="form-control"
                value="{{ old('tanggal_terima', $barangMasuk->tanggal_terima->format('Y-m-d')) }}">
            @error('tanggal_terima')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="surat_jalan" class="form-label">Surat Jalan</label>
            <input type="text" name="surat_jalan" class="form-control"
                value="{{ old('surat_jalan', $barangMasuk->surat_jalan) }}">
            @error('surat_jalan')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <hr>

        <h4>Detail Barang</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Order</th>
                    <th>Jumlah Terima</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($barangMasuk->details as $index => $detail)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $detail->kode_barang }}</td>
                        <td>{{ $detail->nama_barang }}</td>
                        <td>{{ $detail->jumlah_order }}</td>
                        <td>
                            <input type="number" name="details[{{ $detail->id }}][jumlah_terima]"
                                class="form-control" min="0"
                                value="{{ old('details.'.$detail->id.'.jumlah_terima', $detail->jumlah_terima) }}">
                        </td>
                        <td>
                            @if($detail->jumlah_terima < $detail->jumlah_order)
                                <span class="badge bg-warning text-dark">Kurang {{ $detail->jumlah_order - $detail->jumlah_terima }}</span>
                            @else
                                <span class="badge bg-success">Lengkap</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ old('keterangan', $barangMasuk->keterangan) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('barang-masuk.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
