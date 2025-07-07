<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\StokMasuk;
use App\Models\StokKeluar;
use App\Models\Kategori;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'kode_barang';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['kode_barang', 'nama_barang', 'deskripsi', 'kategori_id', 'stok_awal', 'stok', 'gambar'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function stok_masuk()
    {
        return $this->hasMany(StokMasuk::class, 'kode_barang_id', 'kode_barang');
    }

    public function stok_keluar()
    {
        return $this->hasMany(StokKeluar::class, 'kode_barang_id', 'kode_barang');
    }

    public function riwayatStok()
    {
        return $this->hasMany(RiwayatStok::class, 'kode_barang_id', 'kode_barang')
        ->orderBy('created_at', 'desc');
    }

    public function getStokSaatIniAttribute()
    {
        $stok_masuk_total = $this->stok_masuk()->sum('jumlah');
        $stok_keluar_total = $this->stok_keluar()->sum('jumlah');
        return $this->stok_awal + $stok_masuk_total - $stok_keluar_total;
    }

    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            return asset('images/' . $this->gambar);
        }
        return asset('images/default-image.png');
    }
}
