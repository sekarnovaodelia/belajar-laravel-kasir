@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Dashboard</h2>

    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h6>Total Barang</h6>
                    <h2>{{ $jumlahBarang }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h6>Total Pelanggan</h6>
                    <h2>{{ $jumlahPelanggan }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h6>Total Transaksi</h6>
                    <h2>{{ $jumlahTransaksi }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h6>Total Pendapatan</h6>
                    <h2>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h5 class="mb-0">5 Transaksi Terbaru</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pelanggan</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksiTerbaru as $i => $t)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $t->pelanggan->nama_pelanggan }}</td>
                        <td>{{ $t->barang->nama_barang }}</td>
                        <td>{{ $t->jumlah }}</td>
                        <td>Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                        <td>{{ $t->tanggal }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada transaksi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">Pendapatan 7 Hari Terakhir</div>
        <div class="card-body">
            <canvas id="grafik" height="80"></canvas>
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
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: @json(array_column($grafik, 'jumlah')),
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
            }]
        }
    });
</script>
@endsection