@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Barang</h2>
    <form action="{{ route('barang.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Jenis</label>
            <select name="jenis_barang_id" class="form-control" required>
                <option value="">-- Pilih Jenis --</option>
                @foreach($jenis as $j)
                    <option value="{{ $j->id }}">{{ $j->nama_jenis }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" required>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('barang.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection