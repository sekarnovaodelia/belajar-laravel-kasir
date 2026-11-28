@extends('layouts.app')
@section('title', 'Manajemen User')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div class="d-flex align-items-center gap-3">
        <div class="icon-box bg-primary bg-opacity-10 text-primary"><i class="bi bi-person-gear"></i></div>
        <div>
            <h4 class="mb-0 fw-bold text-dark">Manajemen User</h4>
            <p class="text-muted small mb-0">Kelola akun Admin dan Kasir</p>
        </div>
    </div>
    <a href="{{ route('user.create') }}" class="btn btn-primary rounded-3 fw-semibold shadow-sm"><i class="bi bi-plus-lg me-1"></i> Tambah User</a>
</div>

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm rounded-3 alert-dismissible fade show d-flex align-items-center gap-2 mb-4">
    <i class="bi bi-check-circle-fill fs-5"></i><div>{{ session('success') }}</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
@if(session('error'))
<div class="alert alert-danger border-0 shadow-sm rounded-3 alert-dismissible fade show d-flex align-items-center gap-2 mb-4">
    <i class="bi bi-exclamation-triangle-fill fs-5"></i><div>{{ session('error') }}</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card pos-card col-12">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-pos align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4 py-3">No</th>
                        <th class="py-3">Nama</th>
                        <th class="py-3">Email</th>
                        <th class="py-3">Role</th>
                        <th class="text-center pe-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $i => $u)
                    <tr>
                        <td class="ps-4 py-3 text-muted">{{ $i + 1 }}</td>
                        <td class="py-3 fw-semibold text-dark">{{ $u->name }}</td>
                        <td class="py-3 text-muted">{{ $u->email }}</td>
                        <td class="py-3">
                            @if($u->role == 'admin')
                                <span class="badge bg-primary">Admin</span>
                            @else
                                <span class="badge bg-success">Kasir</span>
                            @endif
                        </td>
                        <td class="text-center pe-4 py-3">
                            <a href="{{ route('user.edit', $u->id) }}" class="btn btn-sm btn-light text-warning rounded-circle" title="Edit"><i class="bi bi-pencil"></i></a>
                            @if($u->id !== auth()->id())
                            <form action="{{ route('user.destroy', $u->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus user ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-light text-danger rounded-circle" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-5 text-muted">Belum ada data user</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection