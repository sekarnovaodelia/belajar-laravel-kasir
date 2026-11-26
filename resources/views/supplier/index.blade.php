@extends('layouts.app')
@section('title', 'Supplier')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div class="d-flex align-items-center gap-3">
        <div class="icon-box bg-primary bg-opacity-10 text-primary"><i class="bi bi-truck"></i></div>
        <div>
            <h4 class="mb-0 fw-bold text-dark">Supplier</h4>
            <p class="text-muted small mb-0">Daftar mitra pemasok barang Anda</p>
        </div>
    </div>
    <a href="{{ route('supplier.create') }}" class="btn btn-primary rounded-3 fw-semibold shadow-sm"><i class="bi bi-plus-lg me-1"></i> Tambah Supplier</a>
</div>
<div class="card pos-card">
    <div class="card-body p-0">
        <table class="table table-hover table-pos align-middle mb-0">
            <thead><tr><th class="ps-4 py-3">No</th><th class="py-3">Nama Supplier</th><th class="py-3">No HP</th><th class="py-3">Alamat</th><th class="text-center pe-4 py-3">Aksi</th></tr></thead>
            <tbody>
                @forelse($data as $i => $d)
                <tr>
                    <td class="ps-4 py-3 text-muted">{{ $i + 1 }}</td>
                    <td class="py-3 fw-semibold text-dark">{{ $d->nama_supplier }}</td>
                    <td class="py-3 text-muted">{{ $d->no_hp }}</td>
                    <td class="py-3 text-muted text-truncate" style="max-width: 200px;">{{ $d->alamat }}</td>
                    <td class="text-center pe-4 py-3">
                        <a href="{{ route('supplier.edit', $d->id) }}" class="btn btn-sm btn-light text-warning rounded-circle"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('supplier.destroy', $d->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-light text-danger rounded-circle"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-5 text-muted">Belum ada data supplier</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
