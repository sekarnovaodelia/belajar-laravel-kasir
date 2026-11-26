@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Barang</h2>
    <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">Tambah Barang</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('barang.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" 
               placeholder="Cari nama barang..." value="{{ request('search') }}">
        <button class="btn btn-primary">Cari</button>
        @if(request('search'))
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Reset</a>
        @endif
    </div>
</form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $d)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $d->jenis->nama_jenis }}</td>
                <td>{{ $d->nama_barang }}</td>
                <td>Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
                <td>{{ $d->stok }}</td>
                <td>
                    <a href="{{ route('barang.edit', $d->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('barang.destroy', $d->id) }}" method="POST" style="display:inline">
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