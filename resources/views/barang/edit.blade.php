@extends('layouts.app')
@section('title', 'Edit Barang')
@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <div class="icon-box bg-warning bg-opacity-10 text-warning"><i class="bi bi-pencil-square"></i></div>
    <h4 class="mb-0 fw-bold text-dark">Edit Barang</h4>
</div>
<div class="card pos-card col-12">
    <div class="card-body p-4">
        <form action="{{ route('barang.update', $data->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold text-secondary">Jenis Barang <span class="text-danger">*</span></label>
                <select name="jenis_barang_id" class="form-select form-select-lg" required>
                    @foreach($jenis as $j) <option value="{{ $j->id }}" {{ $j->id == $data->jenis_barang_id ? 'selected' : '' }}>{{ $j->nama_jenis }}</option> @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold text-secondary">Nama Barang <span class="text-danger">*</span></label>
                <input type="text" name="nama_barang" class="form-control form-control-lg" value="{{ $data->nama_barang }}" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-secondary">Harga (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="harga" class="form-control form-control-lg" value="{{ $data->harga }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold text-secondary">Stok <span class="text-danger">*</span></label>
                    <input type="number" name="stok" class="form-control form-control-lg" value="{{ $data->stok }}" required>
                </div>
            </div>
            <div class="mt-4 border-top pt-3">
                <button class="btn btn-warning btn-lg rounded-3 text-white fw-semibold"><i class="bi bi-save me-1"></i> Update</button>
                <a href="{{ route('barang.index') }}" class="btn btn-light btn-lg rounded-3">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
