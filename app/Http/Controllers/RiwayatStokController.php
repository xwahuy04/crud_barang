<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\RiwayatStok;

class RiwayatStokController extends Controller
{
    public function index(Request $request)
    {


        $barangs = Barang::all();

        $riwayatStoks = RiwayatStok::with(['barang', 'stokMasuk', 'stokKeluar'])
            ->filter($request->only(['kode_barang', 'jenis_transaksi', 'tanggal_awal', 'tanggal_akhir']))
            ->orderBy('created_at', 'desc')
            ->paginate(10);



        return view('admin.riwayat-stok.index', compact('riwayatStoks', 'barangs'));
    }
}
