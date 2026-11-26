@extends('layouts.app')
@section('title', 'Pelanggan')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div class="d-flex align-items-center gap-3">
        <div class="icon-box bg-primary bg-opacity-10 text-primary"><i class="bi bi-people"></i></div>
        <div>
            <h4 class="mb-0 fw-bold text-dark">Pelanggan</h4>
            <p class="text-muted small mb-0">Data pelanggan setia Anda</p>
        </div>
    </div>
    <a href="{{ route('pelanggan.create') }}" class="btn btn-primary rounded-3 fw-semibold shadow-sm"><i class="bi bi-plus-lg me-1"></i> Tambah Pelanggan</a>
</div>
<div class="card pos-card col-lg-10">
    <div class="card-body p-0">
        <table class="table table-hover table-pos align-middle mb-0">
            <thead><tr><th class="ps-4 py-3">No</th><th class="py-3">Nama Pelanggan</th><th class="py-3">No HP</th><th class="text-center pe-4 py-3">Aksi</th></tr></thead>
            <tbody>
                @forelse($data as $i => $d)
                <tr>
                    <td class="ps-4 py-3 text-muted">{{ $i + 1 }}</td>
                    <td class="py-3 fw-semibold text-dark">{{ $d->nama_pelanggan }}</td>
                    <td class="py-3 text-muted"><i class="bi bi-phone me-1"></i> {{ $d->no_hp }}</td>
                    <td class="text-center pe-4 py-3">
                        <a href="{{ route('pelanggan.edit', $d->id) }}" class="btn btn-sm btn-light text-warning rounded-circle"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('pelanggan.destroy', $d->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-light text-danger rounded-circle"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center py-5 text-muted">Belum ada data pelanggan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
