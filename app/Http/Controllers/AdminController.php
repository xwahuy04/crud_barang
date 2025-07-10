<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StokMasuk;
use App\Models\StokKeluar;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $jumlahBarang = Barang::count();
        $jumlahKategori = Kategori::count();
        $jumlahStokMasuk = StokMasuk::count();
        $jumlahStokKeluar = StokKeluar::count();

        return view('admin.dashboard', compact('jumlahBarang', 'jumlahKategori', 'jumlahStokMasuk', 'jumlahStokKeluar'));
    }
    
}

