<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Kategori;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'deskripsi',
        'kategori_id',
        'stok',
        'user_id'
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

   
}
