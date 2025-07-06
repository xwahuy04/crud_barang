<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\StokMasuk;
use App\Models\StokKeluar;
use App\Models\Kategori;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
public function index()
{
    // Data untuk diagram batang
    $barangData = Barang::limit(5)->get();
    $barLabels = $barangData->pluck('nama_barang');
    $stokAwal = $barangData->pluck('stok_awal');
    $stokSekarang = $barangData->pluck('stok_saat_ini');

    // Data untuk diagram garis (7 hari terakhir)
    $dates = [];
    $masukData = [];
    $keluarData = [];

    for ($i = 6; $i >= 0; $i--) {
        $date = now()->subDays($i);
        $dates[] = $date->isoFormat('dddd');
        $masukData[] = StokMasuk::whereDate('tanggal_masuk', $date)->sum('jumlah');
        $keluarData[] = StokKeluar::whereDate('tanggal_keluar', $date)->sum('jumlah');
    }

    // Data untuk diagram pie
    $kategoriData = Kategori::withCount('barang')->get();
    $kategoriLabels = $kategoriData->pluck('nama_kategori');
    $kategoriCount = $kategoriData->pluck('barang_count');

    return view('admin.laporan.index', compact(
        'barLabels', 'stokAwal', 'stokSekarang',
        'dates', 'masukData', 'keluarData',
        'kategoriLabels', 'kategoriCount'
    ));
}
}
