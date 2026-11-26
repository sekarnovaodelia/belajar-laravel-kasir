<?php
namespace App\Http\Controllers;

use App\Models\StokMasuk;
use App\Models\Supplier;
use App\Models\Barang;
use App\Services\StokMasukService;
use Illuminate\Http\Request;

class StokMasukController extends Controller
{
    public function index()
    {
        $data = StokMasuk::with(['supplier', 'barang'])->latest()->get();
        return view('stok_masuk.index', compact('data'));
    }

    public function create()
    {
        $supplier = Supplier::all();
        $barang   = Barang::all();
        return view('stok_masuk.create', compact('supplier', 'barang'));
    }

    public function store(Request $request, StokMasukService $service)
    {
        $request->validate([
            'supplier_id' => 'required|exists:supplier,id',
            'barang_id'   => 'required|exists:barang,id',
            'jumlah'      => 'required|integer|min:1',
        ]);

        try {
            $service->tambahStok($request->all());
            return redirect()->route('stok-masuk.index')->with('success', 'Stok berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}