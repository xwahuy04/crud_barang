<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Kategori;
use App\Models\Barang;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('isLoggedIn');
    }

    // Generate kode barang otomatis
    private function generateKodeBarang()
    {
        $prefix = 'BRG-';
        $date = date('Ymd');
        $random = Str::upper(Str::random(4));

        do {
            $kode = $prefix . $date . '-' . $random;
            $exists = Barang::where('kode_barang', $kode)->exists();

            if ($exists) {
                $random = Str::upper(Str::random(4));
            }
        } while ($exists);

        return $kode;
    }

    public function index()
    {
        $barangs = Barang::with(['kategori'])->get();

        if (session('userRole') === 'supervisor') {
            return view('supervisior.barang.index', compact('barangs'));
        }

        return view('admin.barang.index', compact('barangs'));
    }

    public function create()
    {
        if (session('userRole') !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $kategori = Kategori::all();
        $kode_barang = $this->generateKodeBarang();
        return view('admin.barang.create', compact('kategori', 'kode_barang'));
    }

    public function uploadTemp(Request $request)
{
    $request->validate([
        'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000'
    ]);

    try {
        $path = public_path('temp_uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $fileName = time().'_'.$file->getClientOriginalName();

        $file->move($path, $fileName);

        return response()->json([
            'success' => true,
            'file_name' => $fileName,
            'file_path' => asset('temp_uploads/'.$fileName)
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Gagal mengunggah gambar: '.$e->getMessage()
        ], 500);
    }
}

public function store(Request $request)
{
    $request->validate([
        'nama_barang' => 'required|string|max:255',
        'deskripsi' => 'nullable|string|max:1000',
        'kategori_id' => 'required|exists:kategori,id',
        'stok' => 'required|integer|min:0',
        'gambar' => 'nullable|string'
    ]);

    try {
        $data = [
            'kode_barang' => $this->generateKodeBarang(),
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'stok_awal' => $request->stok,
            'user_id' => Session::get('loginId'),
        ];

        // Handle file yang sudah diupload via Dropzone
        if ($request->gambar) {
            $tempPath = public_path('temp_uploads/'.$request->gambar);
            $newPath = public_path('images/'.$request->gambar);

            // Pastikan direktori images ada
            if (!file_exists(public_path('images'))) {
                mkdir(public_path('images'), 0777, true);
            }

            if (file_exists($tempPath)) {
                rename($tempPath, $newPath);
                $data['gambar'] = $request->gambar;
            }
        }

        Barang::create($data);

        return redirect()->route('barang')->with('success', 'Barang berhasil ditambahkan.');

    } catch (\Exception $e) {
        return back()->withInput()->with('error', 'Gagal menyimpan barang: '.$e->getMessage());
    }
}

    public function edit($kode_barang)
    {
        if (session('userRole') !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $barang = Barang::findOrFail($kode_barang);
        $kategori = Kategori::all();
        return view('admin.barang.edit', compact('barang', 'kategori'));
    }
public function update(Request $request, $kode_barang)
{
    if (session('userRole') !== 'admin') {
        return redirect()->back()->with('error', 'Akses ditolak');
    }

    $barang = Barang::findOrFail($kode_barang);

    $request->validate([
        'kode_barang' => 'required|string|max:255|unique:barang,kode_barang,'.$kode_barang.',kode_barang',
        'nama_barang' => 'required|string|max:255',
        'deskripsi' => 'nullable|string|max:1000',
        'kategori_id' => 'required|exists:kategori,id',
        'stok' => 'required|integer',
        'stok_awal' => 'required|integer',
        'gambar' => 'nullable|string'
    ]);

    try {
        $data = $request->except('_token', '_method');

        // Handle image upload via Dropzone
        if ($request->gambar && $request->gambar !== $barang->gambar) {
            $tempPath = public_path('temp_uploads/'.$request->gambar);
            $newPath = public_path('images/'.$request->gambar);

            // Pastikan direktori images ada
            if (!file_exists(public_path('images'))) {
                mkdir(public_path('images'), 0777, true);
            }

            // Hapus gambar lama jika ada
            if ($barang->gambar && file_exists(public_path('images/'.$barang->gambar))) {
                unlink(public_path('images/'.$barang->gambar));
            }

            // Pindahkan dari temp ke permanent
            if (file_exists($tempPath)) {
                rename($tempPath, $newPath);
                $data['gambar'] = $request->gambar;
            }
        } elseif (empty($request->gambar)) {
            // Jika gambar dihapus
            if ($barang->gambar && file_exists(public_path('images/'.$barang->gambar))) {
                unlink(public_path('images/'.$barang->gambar));
            }
            $data['gambar'] = null;
        }

        $barang->update($data);

        return redirect()->route('barang')->with('success', 'Barang berhasil diperbarui.');

    } catch (\Exception $e) {
        return back()->withInput()->with('error', 'Gagal memperbarui barang: '.$e->getMessage());
    }
}

    public function destroy($kode_barang)
    {
        if (session('userRole') !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        try {
            $barang = Barang::findOrFail($kode_barang);
            $barang->delete();

            return redirect()->route('barang')->with('success', 'Barang berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus barang: '.$e->getMessage());
        }
    }
}
