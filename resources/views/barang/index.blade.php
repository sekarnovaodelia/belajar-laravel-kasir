@extends('layouts.app')
@section('title', 'Daftar Barang')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div class="d-flex align-items-center gap-3">
        <div class="icon-box bg-primary bg-opacity-10 text-primary"><i class="bi bi-box-seam"></i></div>
        <div>
            <h4 class="mb-0 fw-bold text-dark">Daftar Barang</h4>
            <p class="text-muted small mb-0">Kelola katalog produk Anda</p>
        </div>
    </div>
    <a href="{{ route('barang.create') }}" class="btn btn-primary rounded-3 fw-semibold shadow-sm"><i class="bi bi-plus-lg me-1"></i> Tambah Barang</a>
</div>

<form action="{{ route('barang.index') }}" method="GET" class="mb-4">
    <div class="input-group input-group-lg shadow-sm rounded-3 overflow-hidden">
        <input type="text" name="search" class="form-control border-0 bg-white" placeholder="Cari nama barang..." value="{{ request('search') }}">
        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
        @if(request('search'))
            <a href="{{ route('barang.index') }}" class="btn btn-light border-start"><i class="bi bi-x-lg"></i></a>
        @endif
    </div>
</form>

<div class="card pos-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-pos align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4 py-3">No</th><th class="py-3">Jenis</th><th class="py-3">Nama Barang</th><th class="py-3">Harga</th><th class="py-3">Stok</th><th class="text-center pe-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $i => $d)
                    <tr>
                        <td class="ps-4 py-3 text-muted">{{ $i + 1 }}</td>
                        <td class="py-3"><span class="badge bg-light text-dark border">{{ $d->jenis->nama_jenis }}</span></td>
                        <td class="py-3 fw-semibold text-dark">{{ $d->nama_barang }}</td>
                        <td class="py-3 tabular-nums text-muted">Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
                        <td class="py-3 fw-bold {{ $d->stok <= 5 ? 'text-danger' : 'text-success' }}">{{ $d->stok }}</td>
                        <td class="text-center pe-4 py-3">
                            <a href="{{ route('barang.edit', $d->id) }}" class="btn btn-sm btn-light text-warning rounded-circle" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('barang.destroy', $d->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-light text-danger rounded-circle" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-5 text-muted"><i class="bi bi-box-seam fs-1 d-block mb-2"></i> Belum ada data barang</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
