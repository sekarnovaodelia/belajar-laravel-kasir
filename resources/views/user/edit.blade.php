@extends('layouts.app')
@section('title', 'Edit User')
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <div class="icon-box bg-warning bg-opacity-10 text-warning"><i class="bi bi-pencil-square"></i></div>
    <h4 class="mb-0 fw-bold text-dark">Edit User</h4>
</div>
<div class="card pos-card col-12 col-md-8 col-lg-6 mx-auto">
    <div class="card-body p-4">
        <form action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold text-secondary">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold text-secondary">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold text-secondary">Role <span class="text-danger">*</span></label>
                <select name="role" class="form-select" required>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="kasir" {{ $user->role == 'kasir' ? 'selected' : '' }}>Kasir</option>
                </select>
            </div>
            <div class="alert alert-info py-2 small">
                <i class="bi bi-info-circle"></i> Biarkan password kosong jika tidak ingin mengubahnya.
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold text-secondary">Password Baru (Opsional)</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold text-secondary">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            <button class="btn btn-warning text-white w-100 rounded-3 fw-semibold py-2"><i class="bi bi-save me-1"></i> Update User</button>
            <a href="{{ route('user.index') }}" class="btn btn-light w-100 rounded-3 mt-2">Batal</a>
        </form>
    </div>
</div>
@endsection