@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Transaksi</h2>
    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Pelanggan</label>
            <select name="pelanggan_id" class="form-control" required>
                <option value="">-- Pilih Pelanggan --</option>
                @foreach($pelanggan as $p)
                    <option value="{{ $p->id }}">{{ $p->nama_pelanggan }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Barang</label>
            <select name="barang_id" class="form-control" required>
                <option value="">-- Pilih Barang --</option>
                @foreach($barang as $b)
                    <option value="{{ $b->id }}">{{ $b->nama_barang }} - Rp {{ number_format($b->harga, 0, ',', '.') }} (Stok: {{ $b->stok }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" min="1" required>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection