@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pelanggan</h2>
    <a href="{{ route('pelanggan.create') }}" class="btn btn-primary mb-3">Tambah Pelanggan</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $i => $d)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $d->nama_pelanggan }}</td>
                <td>{{ $d->no_hp }}</td>
                <td>
                    <a href="{{ route('pelanggan.edit', $d->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('pelanggan.destroy', $d->id) }}" method="POST" style="display:inline">
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