<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 5px; }
        p { text-align: center; margin-top: 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background-color: #f0f0f0; }
        .right { text-align: right; }
        .bold { font-weight: bold; }
    </style>
</head>
<body>

<h2>LAPORAN TRANSAKSI</h2>
<p>Kasir App — Dicetak: {{ date('d-m-Y H:i') }}</p>

<table>
    <thead>
        <tr>
            <th width="30">No</th>
            <th>Pelanggan</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $i => $t)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $t->pelanggan->nama_pelanggan }}</td>
            <td>{{ $t->barang->nama_barang }}</td>
            <td>{{ $t->jumlah }}</td>
            <td class="right">Rp {{ number_format($t->total, 0, ',', '.') }}</td>
            <td>{{ $t->tanggal }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Tidak ada transaksi</td>
        </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr class="bold">
            <td colspan="4" class="right">TOTAL PENDAPATAN</td>
            <td class="right">Rp {{ number_format($total, 0, ',', '.') }}</td>
            <td></td>
        </tr>
    </tfoot>
</table>

</body>
</html>