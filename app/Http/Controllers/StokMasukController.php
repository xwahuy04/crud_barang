<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokMasuk;
use Illuminate\Support\Facades\Session;
use App\Models\Barang;
use Carbon\Carbon;

class StokMasukController extends Controller
{
    public function index(Request $request)
    {
        $query = StokMasuk::with(['barang'])
            ->orderBy('created_at', 'desc');

        // Filter pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('barang', function($q) use ($search) {
                $q->where('nama_barang', 'like', "%$search%")
                  ->orWhere('kode_barang', 'like', "%$search%");
            });
        }

        // Filter tanggal
        if ($request->has('date')) {
            $date = Carbon::parse($request->input('date'))->format('Y-m-d');
            $query->whereDate('tanggal_masuk', $date);
        }

        // Filter rentang tanggal
        if ($request->has('start_date') && $request->has('end_date')) {
            $start = Carbon::parse($request->input('start_date'))->startOfDay();
            $end = Carbon::parse($request->input('end_date'))->endOfDay();
            $query->whereBetween('tanggal_masuk', [$start, $end]);
        }

        $stokMasuk = $query->paginate(10);

        if (session('userRole') === 'supervisor') {
            return view('supervisior.stok_masuk.index', compact('stokMasuk'));
        }

        return view('admin.stok_masuk.index', compact('stokMasuk'));
    }

    public function create()
    {
        if (session('userRole') !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $barangs = Barang::all();
        return view('admin.stok_masuk.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        if (session('userRole') !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $validated = $request->validate([
            'kode_barang_id' => 'required|exists:barang,kode_barang',
            'jumlah' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        try {
            $stokMasuk = StokMasuk::create([
                'kode_transaksi' => 'SM-' . date('YmdHis'),
                'kode_barang_id' => $validated['kode_barang_id'],
                'user_id' => Session::get('loginId'),
                'jumlah' => $validated['jumlah'],
                'tanggal_masuk' => $validated['tanggal_masuk'],
                'keterangan' => $validated['keterangan'],
            ]);


            return redirect()->route('stok-masuk')->with('success', 'Stok masuk berhasil dicatat');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal mencatat stok masuk: '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        if (session('userRole') !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }
        $stokMasuk = StokMasuk::findOrFail($id);
        $stokMasuk->delete();

        return redirect()->route('stok-masuk')->with('success', 'Stok masuk berhasil dihapus');
    }
}
