<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pelanggan;
use App\Models\Barang;
use App\Services\TransaksiService;
use Illuminate\Http\Request;
use Exception;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = Transaksi::with(['pelanggan', 'detail.barang'])->latest()->get();
        return view('transaksi.index', compact('data'));
    }

    public function create()
{
    $pelanggan = Pelanggan::all();
    // Eager load relasi 'jenis' agar tidak berat (N+1 query)
    $barang    = Barang::with('jenis')->where('stok', '>', 0)->get();
    return view('transaksi.create', compact('pelanggan', 'barang'));
}

    // --- LOGIC CART ---

    public function tambahKeCart(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barang,id',
            'jumlah'    => 'required|integer|min:1'
        ]);

        $barang = Barang::findOrFail($request->barang_id);
        $cart = session()->get('cart', []);

        // Cek apakah barang sudah ada di keranjang
        if (isset($cart[$barang->id])) {
            $cart[$barang->id]['jumlah'] += $request->jumlah;
        } else {
            $cart[$barang->id] = [
                'barang_id' => $barang->id,
                'nama'      => $barang->nama_barang,
                'harga'     => $barang->harga,
                'jumlah'    => $request->jumlah,
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Barang ditambahkan ke keranjang');
    }

    public function hapusCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return back()->with('success', 'Barang dihapus dari keranjang');
    }


    public function store(Request $request, TransaksiService $service)
    {
        $request->validate([
            'pelanggan_id' => 'nullable|exists:pelanggan,id',
            'nama_manual'  => 'nullable|string|max:255',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return back()->with('error', 'Keranjang masih kosong!');
        }

        // Jika pelanggan tidak dipilih (kosong), isi default "Umum"
        $pelangganId = $request->pelanggan_id;
        $namaManual  = $request->nama_manual;

        if (!$pelangganId && !$namaManual) {
            $namaManual = 'Pelanggan Umum';
        }

        try {
            $transaksi = $service->buatDariCart($pelangganId, $namaManual, array_values($cart));

            // Kosongkan keranjang
            session()->forget('cart');

            return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // Kembalikan stok untuk setiap detail
        foreach ($transaksi->detail as $detail) {
            Barang::findOrFail($detail->barang_id)->increment('stok', $detail->jumlah);
        }

        // Hapus transaksi (detail akan terhapus otomatis karena onDelete cascade)
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi dihapus, stok dikembalikan');
    }

    public function struk($id)
    {
        $transaksi = Transaksi::with(['pelanggan', 'detail.barang'])->findOrFail($id);
        return view('transaksi.struk', compact('transaksi'));
    }

    public function laporan(Request $request)
    {
        $query = Transaksi::with(['pelanggan', 'detail.barang']);

        if ($request->filled('dari') && $request->filled('sampai')) {
            $query->whereBetween('tanggal', [$request->dari, $request->sampai]);
        }

        $data  = $query->latest()->get();
        $total = $data->sum('total');

        return view('transaksi.laporan', compact('data', 'total'));
    }
}
