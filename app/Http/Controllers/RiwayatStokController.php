<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\RiwayatStok;
use App\Exports\ExportRiwayat;
use Maatwebsite\Excel\Facades\Excel;

class RiwayatStokController extends Controller
{
    public function index(Request $request)
    {
    
        $barangs = Barang::all();

        $riwayatStoks = RiwayatStok::with(['barang', 'stokMasuk', 'stokKeluar'])
            ->filter($request->only(['kode_barang', 'jenis_transaksi', 'tanggal_awal', 'tanggal_akhir']))
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if (session('userRole') === 'supervisor') {
            return view('supervisior.riwayat-stok.index', compact('riwayatStoks' , 'barangs'));
        }

        return view('admin.riwayat-stok.index', compact('riwayatStoks', 'barangs'));
    }

    public function export(Request $request)
    {
        $riwayatStoks = RiwayatStok::with(['barang'])
            ->filter($request->only(['kode_barang', 'jenis_transaksi', 'tanggal_awal', 'tanggal_akhir']))
            ->orderBy('created_at', 'desc')
            ->get();

        return Excel::download(new ExportRiwayat($riwayatStoks), 'riwayat-stok.xlsx');
    }
}
