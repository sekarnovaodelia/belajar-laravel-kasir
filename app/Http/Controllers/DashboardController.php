<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
{
    $jumlahBarang    = Barang::count();
    $jumlahPelanggan = Pelanggan::count();
    $jumlahTransaksi = Transaksi::count();
    $totalPendapatan = Transaksi::sum('total');

    // 5 transaksi terbaru (Eager load relasi detail.barang)
    $transaksiTerbaru = Transaksi::with(['pelanggan', 'detail.barang'])
        ->latest()
        ->take(5)
        ->get();

    // Transaksi 7 hari terakhir
    $grafik = [];
    for ($i = 6; $i >= 0; $i--) {
        $tgl = now()->subDays($i)->format('Y-m-d');
        $grafik[] = [
            'tanggal' => now()->subDays($i)->format('d-m'),
            'jumlah'  => Transaksi::whereDate('tanggal', $tgl)->sum('total'),
        ];
    }

    return view('dashboard', compact(
        'jumlahBarang',
        'jumlahPelanggan',
        'jumlahTransaksi',
        'totalPendapatan',
        'transaksiTerbaru',
        'grafik'
    ));
}
}
