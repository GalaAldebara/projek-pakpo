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
        max-width: 800px;
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

    select.form-control-custom {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%236b7280' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 16px;
        padding-right: 2.5rem;
    }

    .input-icon-wrapper select.form-control-custom {
        padding-left: 2.75rem;
        padding-right: 2.5rem;
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

    .error-message {
        display: block;
        font-size: 0.8125rem;
        color: #dc2626;
        margin-top: 0.375rem;
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
        <a href="{{ route('items.index') }}">Items</a>
        <i class="bi bi-chevron-right"></i>
        <span>Tambah Item</span>
    </div>
    <h1 class="page-title">Tambah Item Baru</h1>
</div>

<div class="form-card">
    <form method="POST" action="{{ route('items.store') }}">
        @csrf

        <!-- Section Title -->
        <div class="section-title">
            <i class="bi bi-box-seam"></i>
            <span>Informasi Item</span>
        </div>

        <div class="info-box">
            <i class="bi bi-info-circle"></i>
            <div class="info-box-content">
                Pastikan semua informasi item diisi dengan benar. Item yang ditambahkan akan terhubung dengan supplier yang dipilih.
            </div>
        </div>

        <!-- Nama Item -->
        <div class="form-group">
            <label class="form-label">
                Nama Item
                <span class="required">*</span>
            </label>
            <div class="input-icon-wrapper">
                <input
                    type="text"
                    name="name"
                    class="form-control-custom"
                    placeholder="Contoh: Laptop Dell XPS 13"
                    value="{{ old('name') }}"
                    required
                >
                <i class="bi bi-tag input-icon"></i>
            </div>
            @error('name')
                <span class="error-message">
                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                </span>
            @enderror
        </div>

        <!-- Supplier -->
        <div class="form-group">
            <label class="form-label">
                Supplier
                <span class="required">*</span>
            </label>
            <div class="input-icon-wrapper">
                <select name="supplier_id" class="form-control-custom" required>
                    <option value="">-- Pilih Supplier --</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->kode_supplier }} - {{ $supplier->nama }}
                        </option>
                    @endforeach
                </select>
                <i class="bi bi-building input-icon"></i>
            </div>
            @error('supplier_id')
                <span class="error-message">
                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                </span>
            @enderror
        </div>

        <!-- Satuan -->
        <div class="form-group">
            <label class="form-label">
                Satuan
                <span class="required">*</span>
            </label>
            <div class="input-icon-wrapper">
                <select name="satuan_id" class="form-control-custom" required>
                    <option value="">-- Pilih Satuan --</option>
                    @foreach($satuan as $s)
                        <option value="{{ $s->id }}" {{ old('satuan_id') == $s->id ? 'selected' : '' }}>
                            {{ $s->kode }} - {{ $s->nama }}
                        </option>
                    @endforeach
                </select>
                <i class="bi bi-rulers input-icon"></i>
            </div>
            @error('satuan_id')
                <span class="error-message">
                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                </span>
            @enderror
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <button type="submit" class="btn-custom btn-primary-custom">
                <i class="bi bi-check-circle"></i>
                Simpan Item
            </button>
            <a href="{{ route('items.index') }}" class="btn-custom btn-secondary-custom">
                <i class="bi bi-x-circle"></i>
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
