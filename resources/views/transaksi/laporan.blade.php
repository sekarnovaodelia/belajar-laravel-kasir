@extends('layouts.app')

@section('title', 'Laporan Transaksi')

@section('content')
{{-- HEADER HALAMAN --}}
<div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
    <div class="d-flex align-items-center gap-3">
        <div class="bg-primary bg-opacity-10 text-primary rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
            <i class="bi bi-file-earmark-text fs-5"></i>
        </div>
        <div>
            <h5 class="mb-0 fw-bold text-dark">Laporan Transaksi</h5>
            <p class="text-muted small mb-0">Rekapitulasi pendapatan berdasarkan periode</p>
        </div>
    </div>
    <div>
        <a href="{{ route('transaksi.exportPdf', request()->only('dari','sampai')) }}" class="btn btn-danger btn-sm px-3 py-2 rounded-3 fw-semibold shadow-sm">
            <i class="bi bi-file-earmark-pdf me-1"></i> Export PDF
        </a>
    </div>
</div>

{{-- FILTER PERIODE (Ramping & Full Width) --}}
<div class="card border-0 shadow-sm rounded-3 mb-3 w-100">
    <div class="card-body p-3">
        <form action="{{ route('transaksi.laporan') }}" method="GET">
            <div class="row align-items-end g-2">
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-secondary small mb-1">Dari Tanggal</label>
                    <input type="date" name="dari" class="form-control" value="{{ request('dari') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-secondary small mb-1">Sampai Tanggal</label>
                    <input type="date" name="sampai" class="form-control" value="{{ request('sampai') }}">
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100 fw-semibold">
                        <i class="bi bi-funnel me-1"></i> Filter Data
                    </button>
                    <a href="{{ route('transaksi.laporan') }}" class="btn btn-light border px-3" title="Reset Filter">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- RINGKASAN STATISTIK (Compact) --}}
<div class="row g-3 mb-3">
    <div class="col-md-6">
        <div class="card bg-success bg-gradient text-white border-0 shadow-sm rounded-3">
            <div class="card-body p-3 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-white-50 small fw-semibold text-uppercase d-block">Total Pendapatan</span>
                    <h4 class="mb-0 fw-bold mt-1">Rp {{ number_format($total, 0, ',', '.') }}</h4>
                </div>
                <i class="bi bi-cash-stack fs-2 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-primary bg-gradient text-white border-0 shadow-sm rounded-3">
            <div class="card-body p-3 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-white-50 small fw-semibold text-uppercase d-block">Jumlah Transaksi</span>
                    <h4 class="mb-0 fw-bold mt-1">{{ $data->count() }} Transaksi</h4>
                </div>
                <i class="bi bi-receipt fs-2 opacity-50"></i>
            </div>
        </div>
    </div>
</div>

{{-- TABEL LAPORAN (Full Width & Rata Kiri) --}}
<div class="card border-0 shadow-sm rounded-3 w-100 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="60" class="ps-4 py-2 small text-uppercase text-muted">No</th>
                        <th class="py-2 small text-uppercase text-muted">Pelanggan</th>
                        <th class="py-2 small text-uppercase text-muted">Detail Item</th>
                        <th class="text-end py-2 small text-uppercase text-muted">Total</th>
                        <th width="140" class="ps-4 py-2 small text-uppercase text-muted">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $i =>$t)
                    <tr>
                        <td class="ps-4 py-2 text-muted">{{ $i + 1 }}</td>
                        <td class="py-2 fw-semibold text-dark">
                            {{ $t->pelanggan ? $t->pelanggan->nama_pelanggan : ($t->nama_pelanggan_manual ?? 'Umum') }}
                        </td>
                        <td class="py-2">
                            <ul class="mb-0 ps-3 text-muted small">
                                @foreach($t->detail as$d)
                                    <li>{{ $d->barang->nama_barang }} <span class="fw-semibold text-dark">({{ $d->jumlah }}x)</span></li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="text-end py-2 fw-bold text-success">
                            Rp {{ number_format($t->total, 0, ',', '.') }}
                        </td>
                        <td class="ps-4 py-2 text-muted small">
                            <i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::parse($t->tanggal)->format('d-m-Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-4 ps-4 text-muted">
                            <i class="bi bi-inbox me-2"></i> Tidak ada transaksi pada periode ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection