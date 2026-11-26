@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Jenis</h2>
    <form action="{{ route('jenis.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama Jenis</label>
            <input type="text" name="nama_jenis" class="form-control" value="{{ $data->nama_jenis }}" required>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('jenis.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection