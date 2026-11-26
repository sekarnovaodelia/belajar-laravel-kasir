<?php

namespace App\Services;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;
use Exception;

class TransaksiService
{
    /**
     * Membuat transaksi dari keranjang (cart)
     */
    public function buatDariCart($pelangganId, $namaManual, array $items)
    {
        DB::beginTransaction();
        try {
            $total = 0;

            // 1. Cek stok & hitung total
            foreach ($items as $item) {
                $barang = Barang::findOrFail($item['barang_id']);
                if ($barang->stok < $item['jumlah']) {
                    throw new Exception("Stok {$barang->nama_barang} tidak cukup. Sisa: {$barang->stok}");
                }
                $total += $barang->harga * $item['jumlah'];
            }

            // 2. Simpan header transaksi
            $transaksi = Transaksi::create([
                'pelanggan_id'           => $pelangganId,
                'nama_pelanggan_manual'  => $namaManual,
                'total'                  => $total,
                'tanggal'                => now(),
            ]);

            // 3. Simpan detail transaksi & kurangi stok
            foreach ($items as $item) {
                $barang = Barang::findOrFail($item['barang_id']);
                
                // Simpan detail (OOP: menggunakan relasi hasMany)
                $transaksi->detail()->create([
                    'barang_id' => $barang->id,
                    'jumlah'    => $item['jumlah'],
                    'harga'     => $barang->harga,
                    'subtotal'  => $barang->harga * $item['jumlah'],
                ]);

                // Kurangi stok (OOP: method bawaan Eloquent)
                $barang->decrement('stok', $item['jumlah']);
            }

            DB::commit();
            return $transaksi;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}