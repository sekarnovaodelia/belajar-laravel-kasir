@extends('layouts.app')
@section('title', 'Tambah User')
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <div class="icon-box bg-primary bg-opacity-10 text-primary"><i class="bi bi-person-plus"></i></div>
    <h4 class="mb-0 fw-bold text-dark">Tambah User Baru</h4>
</div>
<div class="card pos-card col-12 col-md-8 col-lg-6 mx-auto">
    <div class="card-body p-4">
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold text-secondary">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold text-secondary">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold text-secondary">Role <span class="text-danger">*</span></label>
                <select name="role" class="form-select" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold text-secondary">Password <span class="text-danger">*</span></label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold text-secondary">Konfirmasi Password <span class="text-danger">*</span></label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button class="btn btn-primary w-100 rounded-3 fw-semibold py-2"><i class="bi bi-save me-1"></i> Simpan User</button>
            <a href="{{ route('user.index') }}" class="btn btn-light w-100 rounded-3 mt-2">Batal</a>
        </form>
    </div>
</div>
@endsection