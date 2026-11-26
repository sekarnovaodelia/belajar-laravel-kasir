@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Jenis Barang</h2>
    <form action="{{ route('jenis.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Jenis</label>
            <input type="text" name="nama_jenis" class="form-control" required>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('jenis.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection