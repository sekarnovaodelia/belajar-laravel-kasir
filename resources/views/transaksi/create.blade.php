@extends('layouts.app')

@section('title', 'Kasir Transaksi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="fw-bold mb-0"><i class="bi bi-cart-plus text-primary me-2"></i>Kasir Transaksi</h4>
    </div>
    <span class="badge bg-light text-dark border px-3 py-2 fw-normal">
        <i class="bi bi-calendar3 me-1"></i> {{ \Carbon\Carbon::now()->translatedFormat('d M Y') }}
    </span>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show py-2 small">
        <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close py-2" data-bs-dismiss="alert"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show py-2 small">
        <i class="bi bi-exclamation-triangle me-1"></i> {{ session('error') }}
        <button type="button" class="btn-close py-2" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row g-3 align-items-start">
    {{-- KOLOM KIRI: INPUT BARANG --}}
    <div class="col-lg-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white py-2 px-3">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-box-seam me-1"></i> Pilih Barang</h6>
            </div>
            <div class="card-body p-3">
                <form action="{{ route('transaksi.cart.tambah') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label fw-bold small text-muted mb-1">Cari Barang</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" id="filterBarang" class="form-control" placeholder="Ketik nama barang...">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted mb-1">Daftar Produk</label>
                        <select name="barang_id" id="selectBarang" class="form-select" required>
                            <option value="" data-stok="999">-- Pilih Barang --</option>
                            @php
                                $barangByJenis =$barang->groupBy('jenis.nama_jenis');
                            @endphp
                            @foreach($barangByJenis as $namaJenis =>$items)
                                <optgroup label="{{ $namaJenis }}">
                                    @foreach($items as$b)
                                        <option value="{{ $b->id }}" data-stok="{{ $b->stok }}" {{ $b->stok <= 0 ? 'disabled' : '' }}>
                                            {{ $b->nama_barang }} - Rp {{ number_format($b->harga, 0, ',', '.') }} (Stok: {{$b->stok }})
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        <div id="infoStok" class="form-text text-primary small mt-1 d-none">
                            Maksimal beli: <strong id="maxStokText">0</strong> item
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted mb-1">Jumlah</label>
                        <div class="input-group">
                            <button class="btn btn-outline-secondary px-3" type="button" id="btnMinus">-</button>
                            <input type="number" id="inputJumlah" name="jumlah" class="form-control text-center fw-bold" min="1" value="1" required>
                            <button class="btn btn-outline-secondary px-3" type="button" id="btnPlus">+</button>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 fw-semibold">
                        <i class="bi bi-cart-plus me-1"></i> Tambah ke Keranjang
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- KOLOM KANAN: KERANJANG & CHECKOUT --}}
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-2 px-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-cart3 me-1"></i> Keranjang Belanja</h6>
                <span class="badge bg-white text-primary">{{ count(session('cart', [])) }} Item</span>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3 py-2 small text-uppercase text-muted">Barang</th>
                                <th width="80" class="text-center py-2 small text-uppercase text-muted">Qty</th>
                                <th class="text-end py-2 small text-uppercase text-muted">Harga</th>
                                <th class="text-end py-2 small text-uppercase text-muted">Subtotal</th>
                                <th width="60" class="text-center py-2 small text-uppercase text-muted">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @forelse(session('cart', []) as $id =>$item)
                                @php $subtotal = $item['harga'] *$item['jumlah']; $total +=$subtotal; @endphp
                                <tr>
                                    <td class="ps-3 py-2 fw-semibold">{{ $item['nama'] }}</td>
                                    <td class="text-center py-2">
                                        <span class="badge bg-secondary">{{ $item['jumlah'] }}</span>
                                    </td>
                                    <td class="text-end py-2">Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                    <td class="text-end py-2 fw-bold text-primary">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                    <td class="text-center py-2">
                                        <form action="{{ route('transaksi.cart.hapus', $id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger border-0 py-0 px-2">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="bi bi-cart-x fs-3 d-block mb-1 opacity-50"></i>
                                        <span class="small">Keranjang masih kosong. Silakan pilih barang di sebelah kiri.</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            {{-- CHECKOUT AREA --}}
            <div class="card-footer bg-white p-3 border-top">
                <div class="bg-light rounded p-2 px-3 mb-3 border d-flex justify-content-between align-items-center">
                    <span class="fw-bold text-secondary small text-uppercase">Total Bayar</span>
                    <span class="h4 mb-0 fw-bold text-success">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf
                    <div class="row g-2 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small mb-1">Pelanggan Terdaftar (Opsional)</label>
                            <select name="pelanggan_id" id="selectPelanggan" class="form-select form-select-sm">
                                <option value="">-- Tanpa Pelanggan --</option>
                                @foreach($pelanggan as$p)
                                    <option value="{{ $p->id }}">{{ $p->nama_pelanggan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small mb-1">Atau Ketik Nama Manual</label>
                            <input type="text" name="nama_manual" id="inputNamaManual" class="form-control form-control-sm" placeholder="Contoh: Budi (Walk-in)">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-100 fw-bold" {{ empty(session('cart')) ? 'disabled' : '' }}>
                        <i class="bi bi-wallet2 me-1"></i> Proses Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectBarang = document.getElementById('selectBarang');
    const filterBarang = document.getElementById('filterBarang');
    const inputJumlah = document.getElementById('inputJumlah');
    const btnMinus = document.getElementById('btnMinus');
    const btnPlus = document.getElementById('btnPlus');
    const infoStok = document.getElementById('infoStok');
    const maxStokText = document.getElementById('maxStokText');
    const selectPelanggan = document.getElementById('selectPelanggan');
    const inputNamaManual = document.getElementById('inputNamaManual');

    let maxStok = 999;

    selectBarang.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        maxStok = parseInt(selectedOption.getAttribute('data-stok')) || 999;
        
        if (this.value !== "") {
            infoStok.classList.remove('d-none');
            maxStokText.textContent = maxStok;
            inputJumlah.max = maxStok;
            if (parseInt(inputJumlah.value) > maxStok) {
                inputJumlah.value = maxStok;
            }
        } else {
            infoStok.classList.add('d-none');
            inputJumlah.removeAttribute('max');
        }
    });

    btnMinus.addEventListener('click', () => {
        let val = parseInt(inputJumlah.value) || 1;
        if (val > 1) inputJumlah.value = val - 1;
    });

    btnPlus.addEventListener('click', () => {
        let val = parseInt(inputJumlah.value) || 1;
        if (val < maxStok) inputJumlah.value = val + 1;
    });

    filterBarang.addEventListener('input', function() {
        const keyword = this.value.toLowerCase();
        selectBarang.querySelectorAll('optgroup').forEach(group => {
            let hasVisible = false;
            group.querySelectorAll('option').forEach(opt => {
                if (opt.textContent.toLowerCase().includes(keyword)) {
                    opt.style.display = '';
                    hasVisible = true;
                } else {
                    opt.style.display = 'none';
                }
            });
            group.style.display = hasVisible ? '' : 'none';
        });
    });

    selectPelanggan.addEventListener('change', function() {
        if (this.value !== "") {
            inputNamaManual.value = "";
            inputNamaManual.disabled = true;
        } else {
            inputNamaManual.disabled = false;
        }
    });
});
</script>
@endpush