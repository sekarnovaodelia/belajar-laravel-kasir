@extends('layouts.app')
@section('title', 'Tambah Pelanggan')
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <div class="icon-box bg-primary bg-opacity-10 text-primary"><i class="bi bi-person-plus"></i></div>
    <h4 class="mb-0 fw-bold text-dark">Tambah Pelanggan</h4>
</div>
<div class="card pos-card col-12">
    <div class="card-body p-4">
        <form action="{{ route('pelanggan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold text-secondary">Nama Pelanggan <span class="text-danger">*</span></label>
                <input type="text" name="nama_pelanggan" class="form-control form-control-lg" value="{{ old('nama_pelanggan') }}" required>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold text-secondary">No HP <span class="text-danger">*</span></label>
                <input type="text" name="no_hp" class="form-control form-control-lg" value="{{ old('no_hp') }}" required>
            </div>
            <button class="btn btn-primary btn-lg rounded-3 w-100 fw-semibold"><i class="bi bi-save me-1"></i> Simpan</button>
            <a href="{{ route('pelanggan.index') }}" class="btn btn-light btn-lg rounded-3 w-100 mt-2">Batal</a>
        </form>
    </div>
</div>
@endsection
