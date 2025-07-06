<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokMasuk extends Model
{
    use HasFactory;
    protected $table = 'stok_masuk';
    protected $casts = [
        'tanggal_masuk' => 'date',
];
    protected $fillable = [
        'kode_transaksi',
        'kode_barang_id',
        'jumlah',
        'tanggal_masuk',
        'keterangan',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang_id', 'kode_barang');
    }


    public function riwayatStok()
{
    return $this->hasOne(RiwayatStok::class, 'stok_masuk_id');
}
// Model StokMasuk
protected static function booted()
{
    static::created(function ($stokMasuk) {
        $barang = $stokMasuk->barang;

        RiwayatStok::create([
            'kode_barang_id' => $stokMasuk->kode_barang_id,
            'jenis_transaksi' => 'masuk',
            'jumlah' => $stokMasuk->jumlah,
            'stok_sebelum' => $barang->stok,
            'stok_sesudah' => $barang->stok + $stokMasuk->jumlah,
            'keterangan' => $stokMasuk->keterangan,
            'stok_masuk_id' => $stokMasuk->id,
            'stok_keluar_id' => null,
            'created_at' => $stokMasuk->tanggal_masuk, // Gunakan tanggal masuk
            'updated_at' => now()
        ]);

        $barang->increment('stok', $stokMasuk->jumlah);
    });
}
}
