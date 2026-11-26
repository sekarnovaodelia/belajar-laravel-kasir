@extends('layouts.app')

@section('title', 'Kasir Transaksi')

@section('content')
{{-- HEADER HALAMAN --}}
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div class="d-flex align-items-center gap-3">
        <div class="icon-box bg-primary bg-opacity-10 text-primary">
            <i class="bi bi-shop"></i>
        </div>
        <div>
            <h4 class="mb-0 fw-bold text-dark">Kasir Transaksi</h4>
            <p class="text-muted small mb-0">Pilih barang, atur jumlah, dan selesaikan pembayaran pelanggan</p>
        </div>
    </div>
    <div class="d-flex align-items-center gap-2 text-muted small bg-white px-3 py-2 rounded-pill shadow-sm">
        <i class="bi bi-calendar3 text-primary"></i>
        <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
    </div>
</div>

{{-- NOTIFIKASI ALERT --}}
@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-3 alert-dismissible fade show d-flex align-items-center gap-2 mb-4">
        <i class="bi bi-check-circle-fill fs-5"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger border-0 shadow-sm rounded-3 alert-dismissible fade show d-flex align-items-center gap-2 mb-4">
        <i class="bi bi-exclamation-triangle-fill fs-5"></i>
        <div>{{ session('error') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="row g-4">
    {{-- KOLOM KIRI: FORM TAMBAH BARANG --}}
    <div class="col-lg-4">
        <div class="card pos-card h-100">
            <div class="card-header pos-header d-flex align-items-center gap-2">
                <span class="icon-box bg-dark bg-opacity-10 text-dark" style="width: 34px; height: 34px; font-size: 1rem;">
                    <i class="bi bi-box-seam"></i>
                </span>
                <h6 class="mb-0 fw-bold">Input Barang</h6>
            </div>
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <form action="{{ route('transaksi.cart.tambah') }}" method="POST" id="formTambahBarang">
                    @csrf
                    {{-- Quick Filter Input --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold small text-secondary">Cari Cepat Barang</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" id="filterBarang" class="form-control bg-light border-start-0 ps-0" placeholder="Ketik nama barang...">
                        </div>
                    </div>

                    {{-- Select Barang --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold small text-secondary">Pilih Produk <span class="text-danger">*</span></label>
                        <select name="barang_id" id="selectBarang" class="form-select form-select-lg fs-6" required>
                            <option value="" data-stok="999">-- Pilih dari Daftar --</option>
                            @php
                                $barangByJenis = $barang->groupBy('jenis.nama_jenis');
                            @endphp
                            @foreach($barangByJenis as $namaJenis => $items)
                                <optgroup label="{{ $namaJenis }}">
                                    @foreach($items as $b)
                                        <option value="{{ $b->id }}" data-stok="{{ $b->stok }}" {{ $b->stok <= 0 ? 'disabled' : '' }}>
                                            {{ $b->nama_barang }} — Rp {{ number_format($b->harga, 0, ',', '.') }} (Stok: {{ $b->stok }})
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        <div id="infoStok" class="form-text mt-2 text-primary fw-medium d-none">
                            <i class="bi bi-info-circle"></i> Maksimal pembelian: <span id="maxStokText">0</span> item
                        </div>
                    </div>
                    
                    {{-- Input Jumlah --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold small text-secondary">Jumlah (Qty)</label>
                        <div class="input-group input-group-lg qty-control">
                            <button class="btn btn-outline-secondary fw-bold" type="button" id="btnMinus">
                                <i class="bi bi-dash"></i>
                            </button>
                            <input type="number" id="inputJumlah" name="jumlah" class="form-control text-center fw-bold tabular-nums" min="1" value="1" required>
                            <button class="btn btn-outline-secondary fw-bold" type="button" id="btnPlus">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3 fw-semibold shadow-sm py-3">
                        <i class="bi bi-cart-plus me-1"></i> Tambah ke Keranjang
                    </button>
                </form>

                <div class="mt-4 pt-3 border-top text-center">
                    <small class="text-muted"><i class="bi bi-lightbulb text-warning"></i> Tips: Barang dengan stok 0 otomatis dinonaktifkan.</small>
                </div>
            </div>
        </div>
    </div>

    {{-- KOLOM KANAN: KERANJANG & CHECKOUT --}}
    <div class="col-lg-8">
        <div class="card pos-card h-100">
            <div class="card-header pos-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <span class="icon-box bg-primary bg-opacity-10 text-primary" style="width: 34px; height: 34px; font-size: 1rem;">
                        <i class="bi bi-bag-check"></i>
                    </span>
                    <h6 class="mb-0 fw-bold">Daftar Belanja</h6>
                </div>
                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-semibold">
                    {{ count(session('cart', [])) }} Item
                </span>
            </div>

            {{-- TABEL KERANJANG --}}
            <div class="card-body p-0">
                <div class="table-responsive" style="min-height: 260px;">
                    <table class="table table-hover table-pos align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4 py-3">Produk</th>
                                <th width="100" class="text-center py-3">Qty</th>
                                <th class="text-end py-3">Harga Satuan</th>
                                <th class="text-end py-3">Subtotal</th>
                                <th width="70" class="text-center py-3">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @forelse(session('cart', []) as $id => $item)
                                @php $subtotal = $item['harga'] * $item['jumlah']; $total += $subtotal; @endphp
                                <tr>
                                    <td class="ps-4 py-3">
                                        <span class="fw-semibold text-dark d-block">{{ $item['nama'] }}</span>
                                    </td>
                                    <td class="text-center py-3">
                                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill tabular-nums fs-6">
                                            {{ $item['jumlah'] }}
                                        </span>
                                    </td>
                                    <td class="text-end text-muted tabular-nums py-3">
                                        Rp {{ number_format($item['harga'], 0, ',', '.') }}
                                    </td>
                                    <td class="text-end fw-bold text-dark tabular-nums py-3">
                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center py-3">
                                        <form action="{{ route('transaksi.cart.hapus', $id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light text-danger rounded-circle" title="Hapus item" style="width: 32px; height: 32px;">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="py-4">
                                            <div class="icon-box bg-light text-secondary mx-auto mb-3" style="width: 64px; height: 64px; font-size: 1.75rem; border-radius: 50%;">
                                                <i class="bi bi-cart-x"></i>
                                            </div>
                                            <h6 class="fw-bold text-dark mb-1">Keranjang Belanja Kosong</h6>
                                            <p class="text-muted small mb-0">Pilih produk di panel sebelah kiri untuk memulai transaksi.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            {{-- CHECKOUT AREA --}}
            <div class="card-footer bg-white p-4 border-top-0">
                {{-- Banner Total Harga --}}
                <div class="total-banner p-3 px-4 mb-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div>
                        <span class="text-uppercase text-muted fw-bold small d-block" style="letter-spacing: 0.05em;">Total Tagihan</span>
                        <span class="text-muted small">Sudah termasuk pajak (jika berlaku)</span>
                    </div>
                    <h2 class="mb-0 fw-bolder text-success tabular-nums">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </h2>
                </div>

                {{-- Form Pelanggan & Submit --}}
                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary small">
                                <i class="bi bi-person-badge me-1"></i> Pelanggan Terdaftar (Opsional)
                            </label>
                            <select name="pelanggan_id" id="selectPelanggan" class="form-select">
                                <option value="">-- Umum / Tanpa Member --</option>
                                @foreach($pelanggan as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_pelanggan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary small">
                                <i class="bi bi-pencil-square me-1"></i> Nama Pelanggan Manual
                            </label>
                            <input type="text" name="nama_manual" id="inputNamaManual" class="form-control" placeholder="Contoh: Budi (Walk-in)">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg w-100 rounded-3 fw-bold py-3 shadow-sm d-flex justify-content-center align-items-center gap-2" {{ empty(session('cart')) ? 'disabled' : '' }}>
                        <i class="bi bi-wallet2 fs-5"></i>
                        <span>Proses Pembayaran Sekarang</span>
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

    // 1. Update batasan stok saat barang dipilih
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

    // 2. Kontrol tombol +/- jumlah
    btnMinus.addEventListener('click', () => {
        let val = parseInt(inputJumlah.value) || 1;
        if (val > 1) inputJumlah.value = val - 1;
    });

    btnPlus.addEventListener('click', () => {
        let val = parseInt(inputJumlah.value) || 1;
        if (val < maxStok) inputJumlah.value = val + 1;
    });

    // 3. Live Filter Dropdown Barang
    filterBarang.addEventListener('input', function() {
        const keyword = this.value.toLowerCase();
        const optgroups = selectBarang.querySelectorAll('optgroup');
        
        optgroups.forEach(group => {
            let hasVisibleOption = false;
            const options = group.querySelectorAll('option');
            
            options.forEach(opt => {
                const text = opt.textContent.toLowerCase();
                if (text.includes(keyword)) {
                    opt.style.display = '';
                    hasVisibleOption = true;
                } else {
                    opt.style.display = 'none';
                }
            });
            group.style.display = hasVisibleOption ? '' : 'none';
        });
    });

    // 4. Disable nama manual jika member dipilih (dan sebaliknya)
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