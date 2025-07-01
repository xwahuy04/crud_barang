<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori_id',
        'stok',
        'satuan',
        'deskripsi',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function stok_masuk()
    {
        return $this->hasMany(StokMasuk::class, 'barang_id');
    }

    public function stok_keluar()
    {
        return $this->hasMany(StokKeluar::class, 'barang_id');
    }

   
}
