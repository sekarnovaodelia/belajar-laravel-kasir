@extends('layouts.app')
@section('title', 'Tambah Supplier')
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <div class="icon-box bg-primary bg-opacity-10 text-primary"><i class="bi bi-plus-circle"></i></div>
    <h4 class="mb-0 fw-bold text-dark">Tambah Supplier</h4>
</div>
<div class="card pos-card col-12">
    <div class="card-body p-4">
        <form action="{{ route('supplier.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold text-secondary">Nama Supplier <span class="text-danger">*</span></label>
                <input type="text" name="nama_supplier" class="form-control form-control-lg" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold text-secondary">No HP</label>
                <input type="text" name="no_hp" class="form-control form-control-lg">
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold text-secondary">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3"></textarea>
            </div>
            <button class="btn btn-primary btn-lg rounded-3 w-100 fw-semibold"><i class="bi bi-save me-1"></i> Simpan</button>
            <a href="{{ route('supplier.index') }}" class="btn btn-light btn-lg rounded-3 w-100 mt-2">Batal</a>
        </form>
    </div>
</div>
@endsection
