<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatStok extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_barang_id',
        'user_id',
        'jenis_transaksi',
        'jumlah',
        'stok_sebelum',
        'stok_sesudah',
        'keterangan',
    ];

     public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stok_masuk()
    {
        return $this->belongsTo(StokMasuk::class);
    }

    public function stok_keluar()
    {
        return $this->belongsTo(StokKeluar::class);
    }
    
}
