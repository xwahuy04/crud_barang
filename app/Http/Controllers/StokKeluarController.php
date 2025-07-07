<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokKeluar;
use Illuminate\Support\Facades\Session;
use App\Models\Barang;
use Carbon\Carbon;

class StokKeluarController extends Controller
{
    public function index(Request $request)
    {
        $query = StokKeluar::with(['barang'])->orderBy('tanggal_keluar', 'desc');

        // Filter pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('barang', function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%$search%")->orWhere('kode_barang', 'like', "%$search%");
            });
        }

        // Filter tanggal
        if ($request->has('date')) {
            $date = Carbon::parse($request->input('date'))->format('Y-m-d');
            $query->whereDate('tanggal_keluar', $date);
        }

        // Filter rentang tanggal
        if ($request->has('start_date') && $request->has('end_date')) {
            $start = Carbon::parse($request->input('start_date'))->startOfDay();
            $end = Carbon::parse($request->input('end_date'))->endOfDay();
            $query->whereBetween('tanggal_keluar', [$start, $end]);
        }

        $stokKeluar = $query->paginate(10);

        if (session('userRole') === 'supervisor') {
            return view('supervisior.stok_keluar.index', compact('stokKeluar'));
        }

        return view('admin.stok_keluar.index', compact('stokKeluar'));
    }

    public function create()
    {
        if (session('userRole') !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $barangs = Barang::all();
        return view('admin.stok_keluar.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        if (session('userRole') !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $validated = $request->validate([
            'kode_barang_id' => 'required|exists:barang,kode_barang',
            'jumlah' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        try {

            $barang = Barang::where('kode_barang', $validated['kode_barang_id'])->first();
            if ($barang->getStokSaatIniAttribute() < $validated['jumlah']) {
            return back()->with('error', 'Stok tidak mencukupi! Stok tersedia: ' . $barang->getStokSaatIniAttribute());
            }

            $stokKeluar = StokKeluar::create([
                'kode_transaksi' => 'SK-' . date('YmdHis'),
                'kode_barang_id' => $validated['kode_barang_id'],
                'user_id' => Session::get('loginId'),
                'jumlah' => $validated['jumlah'],
                'tanggal_keluar' => $validated['tanggal_keluar'],
                'keterangan' => $validated['keterangan'],
            ]);

            return redirect()->route('stok-keluar')->with('success', 'Stok keluar berhasil dicatat');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Gagal mencatat stok keluar: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        if (session('userRole') !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak');
        }

        $stokKeluar = StokKeluar::findOrFail($id);
        $stokKeluar->delete();
        return redirect()->route('stok-keluar')->with('success', 'Stok keluar berhasil dihapus');
    }
}
