<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Kategori;
use App\Models\Barang;


class BarangController extends Controller
{

     public function __construct()
    {
        $this->middleware('isLoggedIn'); // Gunakan middleware custom
    }

    public function index()
    {
        $barangs = Barang::with('kategori', 'user')->get();
        return view('admin.barang.index', compact('barangs'));
    }

    public function create()
    {
        $kategori = Kategori::all(); // Ambil semua kategori
        return view('admin.barang.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'kategori_id' => 'required|exists:kategori,id',
            'stok' => 'required|integer',
        ]);

         // Pastikan user sudah login via session
        if (!Session::has('loginId')) {
            return redirect('/')->with('fail', 'Anda harus login terlebih dahulu');
        }

        // Simpan data barang
        Barang::create([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'user_id' => Session::get('loginId'),  
        ]);



        return redirect()->route('barang')->with('success', 'Kategori berhasil ditambahkan.');

    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategori = Kategori::all();
        return view('admin.barang.edit', compact('barang', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        $request->validate([
           'kode_barang' => 'required|string|max:255|unique:barang,kode_barang,'.$id,
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:1000',
            'kategori_id' => 'required|exists:kategori,id',
            'stok' => 'required|integer',
        ]);

        $barang->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'stok' => $request->stok,
        ]);

        return redirect()->route('barang')->with('success', 'Barang berhasil diperbarui.');
    }
}
