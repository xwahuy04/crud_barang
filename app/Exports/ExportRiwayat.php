<?php

namespace App\Exports;

use App\Models\RiwayatStok;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportRiwayat implements FromCollection, WithHeadings, WithMapping
{
    protected $riwayatStoks;

    public function __construct($riwayatStoks)
    {
        $this->riwayatStoks = $riwayatStoks;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->riwayatStoks;
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Kode Barang',
            'Nama Barang',
            'Jenis Transaksi',
            'Jumlah',
            'Stok Sebelum',
            'Stok Sesudah',
            'Keterangan',
        ];
    }

    public function map($riwayat): array
    {
        return [
            $riwayat->created_at->format('Y-m-d H:i:s'),
            $riwayat->kode_barang_id,
            $riwayat->barang->nama_barang,
            ucfirst($riwayat->jenis_transaksi),
            $riwayat->jumlah,
            $riwayat->stok_sebelum,
            $riwayat->stok_sesudah,
            $riwayat->keterangan,
        ];
    }
}
