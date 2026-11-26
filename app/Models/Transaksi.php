<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    // Tambahkan nama_pelanggan_manual
    protected $fillable = [
        'pelanggan_id', 
        'nama_pelanggan_manual', 
        'total', 
        'tanggal'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    // Relasi Baru: 1 transaksi punya banyak detail
    public function detail()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');
    }
}