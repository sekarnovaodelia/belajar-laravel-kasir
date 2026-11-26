<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\JenisBarang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $data  = Barang::with('jenis')->get();
        $jenis = JenisBarang::all();
        return view('barang.index', compact('data', 'jenis'));
    }

    public function create()
    {
        $jenis = JenisBarang::all();
        return view('barang.create', compact('jenis'));
    }

    public function edit($id)
    {
        $data  = Barang::findOrFail($id);
        $jenis = JenisBarang::all();
        return view('barang.edit', compact('data', 'jenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_barang_id' => 'required|exists:jenis_barang,id',
            'nama_barang'     => 'required|string|max:255',
            'harga'           => 'required|numeric|min:0',
            'stok'            => 'required|integer|min:0',
        ]);

        Barang::create([
            'jenis_barang_id' => $request->jenis_barang_id,
            'nama_barang'     => $request->nama_barang,
            'harga'           => $request->harga,
            'stok'            => $request->stok,
        ]);

        return redirect()->route('barang.index')->with('success', 'Data berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_barang_id' => 'required|exists:jenis_barang,id',
            'nama_barang'     => 'required|string|max:255',
            'harga'           => 'required|numeric|min:0',
            'stok'            => 'required|integer|min:0',
        ]);

        $data = Barang::findOrFail($id);
        $data->update([
            'jenis_barang_id' => $request->jenis_barang_id,   // ✅ diperbaiki
            'nama_barang'     => $request->nama_barang,
            'harga'           => $request->harga,
            'stok'            => $request->stok,
        ]);

        return redirect()->route('barang.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Barang::findOrFail($id)->delete();
        return redirect()->route('barang.index')->with('success', 'Data berhasil dihapus');
    }
}