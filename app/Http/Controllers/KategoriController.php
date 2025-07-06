<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Session;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::withCount('barang')->get();
        
        if (session('userRole') === 'supervisor') {
            return view('supervisior.kategori.index', compact('kategori'));
        }
        
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        if (session('userRole') !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }
        
        $kategori = Kategori::all();
        return view('admin.kategori.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        if (session('userRole') !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        if (session('userRole') !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }
        
        $kategori = Kategori::all();
        $data = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori', 'data'));
    }

    public function update(Request $request, $id)
    {
        if (session('userRole') !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $kategori = Kategori::find($id);
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);
        
        $kategori->update($request->all());
        return redirect()->route('kategori')->with('success','Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        if (session('userRole') !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }
        
        $kategori = Kategori::find($id);
        $kategori->delete();
        return redirect()->route('kategori')->with('success', 'Kategori deleted successfully');
    }
}