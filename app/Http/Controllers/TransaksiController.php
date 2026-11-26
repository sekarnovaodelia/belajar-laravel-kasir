<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Barang;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = Transaksi::with(['pelanggan', 'barang'])->get();
        return view('transaksi.index', compact('data'));
    }

    public function create()
    {
        $pelanggan = Pelanggan::all();
        $barang    = Barang::all();
        return view('transaksi.create', compact('pelanggan', 'barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'barang_id'    => 'required|exists:barang,id',
            'jumlah'       => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        if ($barang->stok < $request->jumlah) {
            return back()->with('error', 'Stok tidak cukup. Sisa: ' . $barang->stok);
        }

        $total = $barang->harga * $request->jumlah;

        Transaksi::create([
            'pelanggan_id' => $request->pelanggan_id,
            'barang_id'    => $request->barang_id,
            'jumlah'       => $request->jumlah,
            'total'        => $total,
            'tanggal'      => now(),
        ]);

        $barang->decrement('stok', $request->jumlah);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil disimpan');
    }

    public function edit($id)
    {
        $data      = Transaksi::findOrFail($id);
        $pelanggan = Pelanggan::all();
        $barang    = Barang::all();
        return view('transaksi.edit', compact('data', 'pelanggan', 'barang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'barang_id'    => 'required|exists:barang,id',
            'jumlah'       => 'required|integer|min:1',
        ]);

        $transaksi  = Transaksi::findOrFail($id);
        $barangLama = Barang::findOrFail($transaksi->barang_id);
        $barangBaru = Barang::findOrFail($request->barang_id);

        $barangLama->increment('stok', $transaksi->jumlah);

        if ($barangBaru->stok < $request->jumlah) {
            $barangLama->decrement('stok', $transaksi->jumlah);
            return back()->with('error', 'Stok tidak cukup. Sisa: ' . $barangBaru->stok);
        }

        $total = $barangBaru->harga * $request->jumlah;

        $transaksi->update([
            'pelanggan_id' => $request->pelanggan_id,
            'barang_id'    => $request->barang_id,
            'jumlah'       => $request->jumlah,
            'total'        => $total,
            'tanggal'      => now(),
        ]);

        $barangBaru->decrement('stok', $request->jumlah);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diupdate');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        Barang::findOrFail($transaksi->barang_id)
            ->increment('stok', $transaksi->jumlah);

        $transaksi->delete();

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus, stok dikembalikan');
    }
}