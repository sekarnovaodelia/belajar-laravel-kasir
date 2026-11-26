@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div class="d-flex align-items-center gap-3">
        <div class="icon-box bg-primary bg-opacity-10 text-primary"><i class="bi bi-speedometer2"></i></div>
        <div>
            <h4 class="mb-0 fw-bold text-dark">Dashboard</h4>
            <p class="text-muted small mb-0">Ringkasan aktivitas toko Anda hari ini</p>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card pos-card h-100 bg-primary bg-gradient text-white border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 text-white-50">Total Barang</h6>
                        <h2 class="mb-0 fw-bold">{{ $jumlahBarang }}</h2>
                    </div>
                    <i class="bi bi-box-seam fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card pos-card h-100 bg-success bg-gradient text-white border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 text-white-50">Total Pelanggan</h6>
                        <h2 class="mb-0 fw-bold">{{ $jumlahPelanggan }}</h2>
                    </div>
                    <i class="bi bi-people fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card pos-card h-100 bg-warning bg-gradient text-white border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 text-white-50">Total Transaksi</h6>
                        <h2 class="mb-0 fw-bold">{{ $jumlahTransaksi }}</h2>
                    </div>
                    <i class="bi bi-cart fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card pos-card h-100 bg-danger bg-gradient text-white border-0">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 text-white-50">Pendapatan</h6>
                        <h4 class="mb-0 fw-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
                    </div>
                    <i class="bi bi-cash-stack fs-1 opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card pos-card h-100">
            <div class="card-header pos-header">
                <h6 class="mb-0 fw-bold"><i class="bi bi-bar-chart text-primary me-2"></i> Pendapatan 7 Hari Terakhir</h6>
            </div>
            <div class="card-body p-4">
                <canvas id="grafik" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card pos-card h-100">
            <div class="card-header pos-header">
                <h6 class="mb-0 fw-bold"><i class="bi bi-clock-history text-primary me-2"></i> 5 Transaksi Terbaru</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-pos align-middle mb-0">
                        <tbody>
                            @forelse($transaksiTerbaru as $t)
                            <tr>
                                <td class="ps-4 py-3">
                                    <span class="fw-semibold d-block text-dark">{{ $t->pelanggan ? $t->pelanggan->nama_pelanggan : $t->nama_pelanggan_manual }}</span>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($t->tanggal)->format('d M Y') }}</small>
                                </td>
                                <td class="text-end pe-4 fw-bold text-success tabular-nums">Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr><td class="text-center py-4 text-muted">Belum ada transaksi</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('grafik');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json(array_column($grafik, 'tanggal')),
            datasets: [{ label: 'Pendapatan (Rp)', data: @json(array_column($grafik, 'jumlah')), backgroundColor: 'rgba(13, 110, 253, 0.5)', borderColor: 'rgba(13, 110, 253, 1)', borderWidth: 1, borderRadius: 5 }]
        },
        options: { scales: { y: { beginAtZero: true } }, plugins: { legend: { display: false } } }
    });
</script>
@endsection
