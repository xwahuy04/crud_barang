@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Riwayat Stok {{ $barang->nama_barang }}</h1>
                <a href="{{ route('riwayat-barang') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>

    <!-- Summary Card -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Stok Awal</h5>
                    <h2>{{ $barang->stok_awal }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Masuk</h5>
                    <h2>{{ $totalMasuk }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Keluar</h5>
                    <h2>{{ $totalKeluar }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Riwayat Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jenis Transaksi</th>
                            <th>Jumlah</th>
                            <th>Stok Sebelum</th>
                            <th>Stok Sesudah</th>
                            <th>User</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($barang->riwayatStok as $riwayat)
                        <tr>
                            <td>{{ $riwayat->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge {{ $riwayat->jenis_transaksi == 'masuk' ? 'bg-success' : 'bg-danger' }}">
                                    {{ strtoupper($riwayat->jenis_transaksi) }}
                                </span>
                            </td>
                            <td>{{ $riwayat->jumlah }}</td>
                            <td>{{ $riwayat->stok_sebelum }}</td>
                            <td>{{ $riwayat->stok_sesudah }}</td>
                            <td>{{ $riwayat->user->name }}</td>
                            <td>{{ $riwayat->keterangan }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data riwayat</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection