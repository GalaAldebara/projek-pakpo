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
    }

    .section-divider {
        border-top: 2px solid #f3f4f6;
        margin: 2rem 0;
        padding-top: 2rem;
    }

    .section-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-title i {
        color: #6366f1;
    }

    .form-group {
        margin-bottom: 1.5rem;
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

    .form-control-custom::placeholder {
        color: #9ca3af;
    }

    .input-icon-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        font-size: 1rem;
        pointer-events: none;
    }

    .input-icon-wrapper .form-control-custom {
        padding-left: 2.75rem;
    }

    .form-control-custom:focus ~ .input-icon {
        color: #6366f1;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        padding-top: 2rem;
        border-top: 1px solid #e5e7eb;
        margin-top: 2rem;
    }

    .btn-custom {
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

    .btn-primary-custom {
        background: #6366f1;
        color: white;
    }

    .btn-primary-custom:hover {
        background: #4f46e5;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .btn-secondary-custom {
        background: #f3f4f6;
        color: #374151;
    }

    .btn-secondary-custom:hover {
        background: #e5e7eb;
        color: #1a1a1a;
    }

    .info-box {
        background: #eff6ff;
        border: 1px solid #bfdbfe;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        display: flex;
        gap: 0.75rem;
    }

    .info-box i {
        color: #3b82f6;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .info-box-content {
        font-size: 0.875rem;
        color: #1e40af;
    }

    @media (max-width: 768px) {
        .form-card {
            padding: 1.5rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn-custom {
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
        <a href="{{ route('suppliers.index') }}">Suppliers</a>
        <i class="bi bi-chevron-right"></i>
        <span>Tambah Supplier</span>
    </div>
    <h1 class="page-title">Tambah Supplier Baru</h1>
</div>

<div class="form-card">
    <form method="POST" action="{{ route('suppliers.store') }}">
        @csrf

        <!-- Supplier Information Section -->
        <div class="section-title">
            <i class="bi bi-building"></i>
            <span>Informasi Supplier</span>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">
                        Nama Supplier
                        <span class="required">*</span>
                    </label>
                    <div class="input-icon-wrapper">
                        <input
                            type="text"
                            name="nama"
                            class="form-control-custom"
                            placeholder="Contoh: PT. Supplier Jaya"
                            value="{{ old('nama') }}"
                            required
                        >
                        <i class="bi bi-building input-icon"></i>
                    </div>
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">
                        Alamat
                        <span class="optional">(Opsional)</span>
                    </label>
                    <div class="input-icon-wrapper">
                        <input
                            type="text"
                            name="alamat"
                            class="form-control-custom"
                            placeholder="Contoh: Jl. Sudirman No. 123, Jakarta"
                            value="{{ old('alamat') }}"
                        >
                        <i class="bi bi-geo-alt input-icon"></i>
                    </div>
                    @error('alamat')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">
                        No. Telepon
                        <span class="optional">(Opsional)</span>
                    </label>
                    <div class="input-icon-wrapper">
                        <input
                            type="text"
                            name="no_telp"
                            class="form-control-custom"
                            placeholder="Contoh: 081-12345678"
                            value="{{ old('no_telp') }}"
                        >
                        <i class="bi bi-telephone input-icon"></i>
                    </div>
                    @error('no_telp')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Item Information Section -->
        <div class="section-divider">
            <div class="section-title">
                <i class="bi bi-box-seam"></i>
                <span>Informasi Item (Opsional)</span>
            </div>

            <div class="info-box">
                <i class="bi bi-info-circle"></i>
                <div class="info-box-content">
                    Anda dapat menambahkan item yang disediakan oleh supplier ini. Item dapat ditambahkan sekarang atau nanti.
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label class="form-label">
                            Nama Item
                            <span class="optional">(Opsional)</span>
                        </label>
                        <div class="input-icon-wrapper">
                            <input
                                type="text"
                                name="item_name"
                                class="form-control-custom"
                                placeholder="Contoh: Pisang Kipas"
                                value="{{ old('item_name') }}"
                            >
                            <i class="bi bi-tag input-icon"></i>
                        </div>
                        @error('item_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label class="form-label">
                            Satuan
                            <span class="required">*</span>
                        </label>
                        <select name="satuan_id" class="form-control-custom" required>
                            <option value="">-- Pilih Satuan --</option>
                            @foreach($satuan as $s)
                                <option value="{{ $s->id }}" {{ old('satuan_id') == $s->id ? 'selected' : '' }}>
                                    {{ $s->kode }} - {{ $s->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('satuan_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <button type="submit" class="btn-custom btn-primary-custom">
                <i class="bi bi-check-circle"></i>
                Simpan Supplier
            </button>
            <a href="{{ route('suppliers.index') }}" class="btn-custom btn-secondary-custom">
                <i class="bi bi-x-circle"></i>
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
