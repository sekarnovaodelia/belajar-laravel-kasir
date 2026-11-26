@extends('layouts.app')
@section('title', 'Stok Masuk')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div class="d-flex align-items-center gap-3">
        <div class="icon-box bg-primary bg-opacity-10 text-primary"><i class="bi bi-box-arrow-in-down"></i></div>
        <div>
            <h4 class="mb-0 fw-bold text-dark">Riwayat Stok Masuk</h4>
            <p class="text-muted small mb-0">Catatan barang datang dari supplier</p>
        </div>
    </div>
    <a href="{{ route('stok-masuk.create') }}" class="btn btn-primary rounded-3 fw-semibold shadow-sm"><i class="bi bi-plus-lg me-1"></i> Input Stok Masuk</a>
</div>
<div class="card pos-card">
    <div class="card-body p-0">
        <table class="table table-hover table-pos align-middle mb-0">
            <thead><tr><th class="ps-4 py-3">No</th><th class="py-3">Tanggal</th><th class="py-3">Supplier</th><th class="py-3">Barang</th><th class="text-end pe-4 py-3">Jumlah</th></tr></thead>
            <tbody>
                @forelse($data as $i => $d)
                <tr>
                    <td class="ps-4 py-3 text-muted">{{ $i + 1 }}</td>
                    <td class="py-3 text-muted">{{ \Carbon\Carbon::parse($d->tanggal)->format('d-m-Y') }}</td>
                    <td class="py-3"><span class="badge bg-light text-dark border"><i class="bi bi-truck me-1"></i> {{ $d->supplier->nama_supplier }}</span></td>
                    <td class="py-3 fw-semibold text-dark">{{ $d->barang->nama_barang }}</td>
                    <td class="text-end pe-4 py-3"><span class="badge bg-success bg-opacity-10 text-success fs-6">+ {{ $d->jumlah }}</span></td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-5 text-muted">Belum ada riwayat stok masuk</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
