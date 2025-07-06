<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokKeluar extends Model
{
    use HasFactory;
    protected $table = 'stok_keluar';
    protected $casts = [
        'tanggal_keluar' => 'date',
    ];
    protected $fillable = [
        'kode_transaksi',
        'kode_barang_id',
        'jumlah',
        'tanggal_keluar',
        'keterangan',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang_id', 'kode_barang');
    }

    public function riwayatStok()
{
    return $this->hasOne(RiwayatStok::class, 'stok_keluar_id');
}

// Model StokKeluar
protected static function booted()
{
    static::created(function ($stokKeluar) {
        $barang = $stokKeluar->barang;

        RiwayatStok::create([
            'kode_barang_id' => $stokKeluar->kode_barang_id,
            'jenis_transaksi' => 'keluar',
            'jumlah' => $stokKeluar->jumlah,
            'stok_sebelum' => $barang->stok,
            'stok_sesudah' => $barang->stok - $stokKeluar->jumlah,
            'keterangan' => $stokKeluar->keterangan,
            'stok_masuk_id' => null,
            'stok_keluar_id' => $stokKeluar->id,
            'created_at' => $stokKeluar->tanggal_keluar, // Gunakan tanggal keluar
            'updated_at' => now()
        ]);

        $barang->decrement('stok', $stokKeluar->jumlah);
    });
}

}
