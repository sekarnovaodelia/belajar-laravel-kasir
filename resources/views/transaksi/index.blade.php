@extends('layouts.app')
@section('title', 'Riwayat Transaksi')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div class="d-flex align-items-center gap-3">
        <div class="icon-box bg-primary bg-opacity-10 text-primary"><i class="bi bi-clock-history"></i></div>
        <div>
            <h4 class="mb-0 fw-bold text-dark">Riwayat Transaksi</h4>
            <p class="text-muted small mb-0">Semua catatan penjualan yang pernah dilakukan</p>
        </div>
    </div>
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary rounded-3 fw-semibold shadow-sm"><i class="bi bi-cart-plus me-1"></i> Buat Transaksi Baru</a>
</div>

@if(session('success'))
<div class="alert alert-success border-0 shadow-sm rounded-3 alert-dismissible fade show d-flex align-items-center gap-2 mb-4">
    <i class="bi bi-check-circle-fill fs-5"></i><div>{{ session('success') }}</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card pos-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-pos align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4 py-3">No</th><th class="py-3">Pelanggan</th><th class="py-3">Item yang Dibeli</th><th class="text-end py-3">Total</th><th class="py-3">Tanggal</th><th class="text-center pe-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $i => $d)
                    <tr>
                        <td class="ps-4 py-3 text-muted">#{{ $d->id }}</td>
                        <td class="py-3">
                            <span class="fw-semibold text-dark">{{ $d->pelanggan ? $d->pelanggan->nama_pelanggan : $d->nama_pelanggan_manual }}</span>
                        </td>
                        <td class="py-3">
                            <ul class="mb-0 ps-3 text-muted small">
                                @foreach($d->detail as $detail)
                                    <li>{{ $detail->barang->nama_barang }} ({{ $detail->jumlah }}x)</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="text-end py-3 fw-bold text-success tabular-nums">Rp {{ number_format($d->total, 0, ',', '.') }}</td>
                        <td class="py-3 text-muted">{{ \Carbon\Carbon::parse($d->tanggal)->format('d-m-Y') }}</td>
                        <td class="text-center pe-4 py-3">
                            <a href="{{ route('transaksi.struk', $d->id) }}" target="_blank" class="btn btn-sm btn-light text-primary rounded-circle" title="Cetak Struk"><i class="bi bi-printer"></i></a>
                            <form action="{{ route('transaksi.destroy', $d->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus transaksi ini? Stok akan dikembalikan.')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-light text-danger rounded-circle" title="Hapus"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-5 text-muted"><i class="bi bi-cart-x fs-1 d-block mb-2"></i> Belum ada riwayat transaksi</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
