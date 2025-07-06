@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="mb-1">Riwayat Stok Keluar</h1>
            <p class="text-muted">Mode Supervisor (Hanya View)</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>#</th>
                            <th>Kode Transaksi</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Tujuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stokKeluar as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->kode_transaksi }}</td>
                            <td>{{ $item->barang->nama_barang }}</td>
                            <td class="text-center">{{ $item->jumlah }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->tanggal_keluar)) }}</td>
                            <td>{{ $item->tujuan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection