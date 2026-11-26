'<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk #{{ $transaksi->id }}</title>
    <style>
        body { font-family: 'Courier New', monospace; font-size: 13px; }
        .struk { width: 300px; margin: 20px auto; padding: 15px; border: 1px dashed #000; }
        .center { text-align: center; }
        .line { border-top: 1px dashed #000; margin: 8px 0; }
        table { width: 100%; }
        td { padding: 2px 0; vertical-align: top; }
        .right { text-align: right; }
        .bold { font-weight: bold; }
        @media print { .no-print { display: none; } .struk { border: none; margin: 0; } }
    </style>
</head>
<body>
<div class="struk">
    <div class="center">
        <h3 style="margin:0">KASIR APP</h3>
        <small>Jl. Contoh No. 123, Indonesia</small><br>
        <small>Telp: 0812-3456-7890</small>
    </div>
    <div class="line"></div>
    <table>
        <tr><td>No. Transaksi</td><td class="right">#{{ $transaksi->id }}</td></tr>
        <tr><td>Tanggal</td><td class="right">{{ $transaksi->tanggal }}</td></tr>
        <tr><td>Kasir</td><td class="right">{{ auth()->user()->name }}</td></tr>
        <tr><td>Pelanggan</td><td class="right">{{ $transaksi->pelanggan ? $transaksi->pelanggan->nama_pelanggan : $transaksi->nama_pelanggan_manual }}</td></tr>
    </table>
    <div class="line"></div>
    <table>
        <tr class="bold"><td>Barang</td><td class="right">Total</td></tr>
        @foreach($transaksi->detail as $d)
        <tr>
            <td>
                {{ $d->barang->nama_barang }}<br>
                <small>{{ $d->jumlah }} x Rp {{ number_format($d->harga, 0, ',', '.') }}</small>
            </td>
            <td class="right">Rp {{ number_format($d->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>
    <div class="line"></div>
    <table>
        <tr class="bold"><td>TOTAL</td><td class="right">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td></tr>
    </table>
    <div class="line"></div>
    <div class="center">
        <small>Terima kasih telah berbelanja</small>
    </div>
</div>
<div class="center no-print" style="margin-top:20px">
    <button onclick="window.print()" style="padding:8px 20px;cursor:pointer">🖨️ Cetak</button>
    <a href="{{ route('transaksi.index') }}" style="padding:8px 20px;text-decoration:none;background:#eee;color:#000">Kembali</a>
</div>
</body>
</html>'