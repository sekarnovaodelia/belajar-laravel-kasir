<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = [
        'jenis_barang_id',
        'nama_barang',
        'harga',
        'stok',
    ];

    // relasi Barang dimiliki JenisBarang
    public function jenis()
    {
        return $this->belongsTo(JenisBarang::class, 'jenis_barang_id');
    }

    // relasi Barang banyak Transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'barang_id');
    }
}
