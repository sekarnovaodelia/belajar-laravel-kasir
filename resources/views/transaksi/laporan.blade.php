@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Laporan Transaksi</h2>

    <form action="{{ route('transaksi.laporan') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <label>Dari Tanggal</label>
                <input type="date" name="dari" class="form-control" value="{{ request('dari') }}">
            </div>
            <div class="col-md-4">
                <label>Sampai Tanggal</label>
                <input type="date" name="sampai" class="form-control" value="{{ request('sampai') }}">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary me-2">Filter</button>
                <a href="{{ route('transaksi.laporan') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    <div class="alert alert-info">
        <strong>Total Pendapatan:</strong> Rp {{ number_format($total, 0, ',', '.') }}
        <br>
        <strong>Jumlah Transaksi:</strong> {{ $data->count() }}
    </div>

    <table class="table table-bordered">
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
            @forelse($data as $i => $t)
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
                <td colspan="6" class="text-center">Tidak ada transaksi</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection