<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatStok extends Model
{
    use HasFactory;

    protected $table = 'riwayat_stok';
    protected $fillable = [
        'kode_barang_id',
        'jenis_transaksi',
        'jumlah',
        'stok_sebelum',
        'stok_sesudah',
        'keterangan',
        'stok_masuk_id',
        'stok_keluar_id',
        'stok_awal'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang_id', 'kode_barang');
    }

    public function stokMasuk()
    {
        return $this->belongsTo(StokMasuk::class, 'stok_masuk_id');
    }

    public function stokKeluar()
    {
        return $this->belongsTo(StokKeluar::class, 'stok_keluar_id');
    }

    // Scope untuk filter
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['kode_barang'] ?? false, fn($query, $kode_barang) =>
            $query->where('kode_barang_id', $kode_barang)
        );

        $query->when($filters['jenis_transaksi'] ?? false, fn($query, $jenis_transaksi) =>
            $query->where('jenis_transaksi', $jenis_transaksi)
        );

        $query->when($filters['tanggal_awal'] ?? false, fn($query, $tanggal_awal) =>
            $query->whereDate('created_at', '>=', $tanggal_awal)
        );

        $query->when($filters['tanggal_akhir'] ?? false, fn($query, $tanggal_akhir) =>
            $query->whereDate('created_at', '<=', $tanggal_akhir)
        );
    }
}
