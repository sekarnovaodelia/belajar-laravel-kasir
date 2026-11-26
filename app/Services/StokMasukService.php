<?php
namespace App\Services;

use App\Models\Barang;
use App\Models\StokMasuk;
use Illuminate\Support\Facades\DB;

class StokMasukService
{
    public function tambahStok(array $data)
    {
        DB::beginTransaction();
        try {
            $stokMasuk = StokMasuk::create([
                'supplier_id' => $data['supplier_id'],
                'barang_id'   => $data['barang_id'],
                'jumlah'      => $data['jumlah'],
                'tanggal'     => now(),
            ]);

            $barang = Barang::findOrFail($data['barang_id']);
            $barang->increment('stok', $data['jumlah']);

            DB::commit();
            return $stokMasuk;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
