@extends('layouts.app')

@section('title', 'Stok Masuk')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="mb-1">Riwayat Stok Masuk</h1>
            <p class="text-muted">Mode Supervisor (Hanya View)</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-light">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stokMasuk as $index => $item)
                        <tr class="text-center">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->kode_transaksi }}</td>
                            <td>{{ $item->barang->nama_barang }}</td>
                            <td class="text-center">{{ $item->jumlah }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->tanggal_masuk)) }}</td>
                            <td>{{ $item->keterangan ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
