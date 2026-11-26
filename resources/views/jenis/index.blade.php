@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Jenis Barang</h2>
    <a href="{{ route('jenis.create') }}" class="btn btn-primary">Tambah</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jenis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $d)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $d->nama_jenis }}</td>
                <td>
                    <a href="{{ route('jenis.edit', $d->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('jenis.destroy', $d->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection