<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $data = Pelanggan::all();
        return view('pelanggan.index', compact('data'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
        ]);

        Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $data = Pelanggan::findOrFail($id);
        return view('pelanggan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
        ]);

        $data = Pelanggan::findOrFail($id);
        $data->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('pelanggan.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        Pelanggan::findOrFail($id)->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data berhasil dihapus');
    }
}