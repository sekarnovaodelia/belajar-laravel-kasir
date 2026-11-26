<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'pelanggan_id',
        'barang_id',
        'jumlah',
        'total',
        'tanggal',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
