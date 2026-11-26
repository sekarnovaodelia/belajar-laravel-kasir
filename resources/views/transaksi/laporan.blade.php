@extends('layouts.app')
@section('title', 'Laporan Transaksi')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div class="d-flex align-items-center gap-3">
        <div class="icon-box bg-primary bg-opacity-10 text-primary"><i class="bi bi-file-earmark-text"></i></div>
        <div>
            <h4 class="mb-0 fw-bold text-dark">Laporan Transaksi</h4>
            <p class="text-muted small mb-0">Rekapitulasi pendapatan berdasarkan periode</p>
        </div>
    </div>
</div>

<div class="card pos-card mb-4">
    <div class="card-body p-4">
        <form action="{{ route('transaksi.laporan') }}" method="GET">
            <div class="row align-items-end g-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold text-secondary small">Dari Tanggal</label>
                    <input type="date" name="dari" class="form-control form-control-lg" value="{{ request('dari') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold text-secondary small">Sampai Tanggal</label>
                    <input type="date" name="sampai" class="form-control form-control-lg" value="{{ request('sampai') }}">
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button class="btn btn-primary btn-lg rounded-3 w-100 fw-semibold"><i class="bi bi-funnel me-1"></i> Filter</button>
                    <a href="{{ route('transaksi.laporan') }}" class="btn btn-light btn-lg rounded-3 border"><i class="bi bi-arrow-clockwise"></i></a>
                </div>
            </div>
        </form>
        <div class="mt-3">
            <a href="{{ route('transaksi.exportPdf', request()->only('dari','sampai')) }}" class="btn btn-danger rounded-3 fw-semibold shadow-sm"><i class="bi bi-file-earmark-pdf me-1"></i> Export PDF</a>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card pos-card bg-success bg-gradient text-white border-0">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-1">Total Pendapatan</h6>
                    <h3 class="mb-0 fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</h3>
                </div>
                <i class="bi bi-cash-stack fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card pos-card bg-primary bg-gradient text-white border-0">
            <div class="card-body p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-1">Jumlah Transaksi</h6>
                    <h3 class="mb-0 fw-bold">{{ $data->count() }} Transaksi</h3>
                </div>
                <i class="bi bi-receipt fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="card pos-card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-pos align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4 py-3">No</th><th class="py-3">Pelanggan</th><th class="py-3">Item</th><th class="text-end py-3">Total</th><th class="py-3">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $i => $t)
                    <tr>
                        <td class="ps-4 py-3 text-muted">{{ $i + 1 }}</td>
                        <td class="py-3 fw-semibold text-dark">{{ $t->pelanggan ? $t->pelanggan->nama_pelanggan : $t->nama_pelanggan_manual }}</td>
                        <td class="py-3">
                            <ul class="mb-0 ps-3 text-muted small">
                                @foreach($t->detail as $d)
                                    <li>{{ $d->barang->nama_barang }} ({{ $d->jumlah }}x)</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="text-end py-3 fw-bold text-success tabular-nums">Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                        <td class="py-3 text-muted">{{ \Carbon\Carbon::parse($t->tanggal)->format('d-m-Y') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-5 text-muted">Tidak ada transaksi pada periode ini</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
