@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Transaksi</h2>
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary mb-3">Tambah Transaksi</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $d)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $d->pelanggan->nama_pelanggan }}</td>
                <td>{{ $d->barang->nama_barang }}</td>
                <td>{{ $d->jumlah }}</td>
                <td>Rp {{ number_format($d->total, 0, ',', '.') }}</td>
                <td>{{ $d->tanggal }}</td>
                <td>
                    <form action="{{ route('transaksi.destroy', $d->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection