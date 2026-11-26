<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Illuminate\Http\Request;

class JenisBarangController extends Controller
{
    // tampil semua
    public function index()
    {
        $data= JenisBarang::all();
        return view('jenis.index', compact('data'));
    }

    public function create()
{
    return view('jenis.create');
}

    // simpan
     public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);
        
        JenisBarang::create([
            'nama_jenis' => $request->nama_jenis,
        ]);
        
        return redirect()->route('jenis.index')->with('success', 'Data berhasil disimpan');
        
    }

    // edit
        public function edit($id)
    {
        $data = JenisBarang::findOrFail($id);
        return view('jenis.edit', compact('data'));
    }

    // update
        public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255',
        ]);
        
        $data = JenisBarang::findOrFail($id);
        $data->update([
            'nama_jenis' => $request->nama_jenis,
        ]);
        
        return redirect()->route('jenis.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        JenisBarang::findOrFail($id)->delete();
        return redirect()->route('jenis.index')->with('success', 'Data berhasil dihapus');
    }
}
