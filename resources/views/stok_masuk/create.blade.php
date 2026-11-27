@extends('layouts.app')
@section('title', 'Input Stok Masuk')
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <div class="icon-box bg-primary bg-opacity-10 text-primary"><i class="bi bi-box-arrow-in-down"></i></div>
    <h4 class="mb-0 fw-bold text-dark">Input Stok Masuk</h4>
</div>
<div class="card pos-card col-12">
    <div class="card-body p-4">
        <form action="{{ route('stok-masuk.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold text-secondary">Supplier <span class="text-danger">*</span></label>
                <select name="supplier_id" class="form-select form-select-lg" required>
                    <option value="">-- Pilih Supplier --</option>
                    @foreach($supplier as $s) <option value="{{ $s->id }}">{{ $s->nama_supplier }}</option> @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold text-secondary">Barang <span class="text-danger">*</span></label>
                <select name="barang_id" class="form-select form-select-lg" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach($barang as $b) <option value="{{ $b->id }}">{{ $b->nama_barang }} (Stok: {{ $b->stok }})</option> @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold text-secondary">Jumlah Masuk <span class="text-danger">*</span></label>
                <input type="number" name="jumlah" class="form-control form-control-lg" min="1" required>
            </div>
            <button class="btn btn-primary btn-lg rounded-3 w-100 fw-semibold"><i class="bi bi-save me-1"></i> Tambah Stok</button>
            <a href="{{ route('stok-masuk.index') }}" class="btn btn-light btn-lg rounded-3 w-100 mt-2">Batal</a>
        </form>
    </div>
</div>
@endsection
