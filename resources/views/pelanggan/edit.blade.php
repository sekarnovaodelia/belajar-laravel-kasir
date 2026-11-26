@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pelanggan</h2>
    <form action="{{ route('pelanggan.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama_pelanggan" class="form-control" value="{{ $data->nama_pelanggan }}" required>
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $data->no_hp }}" required>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection