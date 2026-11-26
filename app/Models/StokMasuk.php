<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class StokMasuk extends Model
{
    protected $table = 'stok_masuk';
    protected $fillable = ['supplier_id', 'barang_id', 'jumlah', 'tanggal'];
    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}