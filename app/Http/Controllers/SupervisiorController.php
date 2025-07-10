<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\StokMasuk;
use App\Models\StokKeluar;
use Carbon\Carbon;

class SupervisiorController extends Controller
{
    public function index()
    {
        $jumlahBarang = Barang::count();
        $jumlahKategori = Kategori::count();

        $stokMasukBulanan = StokMasuk::whereMonth('tanggal_masuk', Carbon::now()->month)
            ->whereYear('tanggal_masuk', Carbon::now()->year)
            ->sum('jumlah');

        $stokKeluarBulanan = StokKeluar::whereMonth('tanggal_keluar', Carbon::now()->month)
            ->whereYear('tanggal_keluar', Carbon::now()->year)
            ->sum('jumlah');

        return view('supervisior.dashboard', [
            'title' => 'Dashboard Supervisor',
            'jumlahBarang' => $jumlahBarang,
            'jumlahKategori' => $jumlahKategori,
            'stokMasukBulanan' => $stokMasukBulanan,
            'stokKeluarBulanan' => $stokKeluarBulanan
        ]);
    }
}
