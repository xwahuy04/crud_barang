@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Riwayat Stok Barang</h2>
            <a href="{{ route('supervisor.riwayat-stok.export', request()->query()) }}" class="btn btn-primary">
                <i class="ti ti-file-spreadsheet me-2"></i> Export Excel
            </a>
        </div>

        <div class="card-body">
            <form method="GET" action="{{ route('supervisor.riwayat-stok') }}">
                <div class="row">
                    <div class="col-md-3">
                        <label>Barang</label>
                        <select name="kode_barang" class="form-control">
                            <option value="">Semua Barang</option>
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->kode_barang }}" {{ request('kode_barang') == $barang->kode_barang ? 'selected' : '' }}>
                                    {{ $barang->kode_barang }} - {{ $barang->nama_barang }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Jenis Transaksi</label>
                        <select name="jenis_transaksi" class="form-control">
                            <option value="">Semua Jenis</option>
                            <option value="masuk" {{ request('jenis_transaksi') == 'masuk' ? 'selected' : '' }}>Stok Masuk</option>
                            <option value="keluar" {{ request('jenis_transaksi') == 'keluar' ? 'selected' : '' }}>Stok Keluar</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Tanggal Awal</label>
                        <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
                    </div>

                    <div class="col-md-3">
                        <label>Tanggal Akhir</label>
                        <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('riwayat-stok') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Barang</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Stok Sebelum</th>
                            <th>Stok Sesudah</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayatStoks as $riwayat)
                        <tr>
                            <td>{{ $riwayat->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $riwayat->barang->nama_barang }}</td>
                            <td>{{ ($riwayat->jenis_transaksi) }}</td>
                            <td>{{ $riwayat->jumlah }}</td>
                            <td>{{ $riwayat->stok_sebelum }}</td>
                            <td>{{ $riwayat->stok_sesudah }}</td>
                            <td>{{ $riwayat->keterangan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $riwayatStoks->links() }}
        </div>
    </div>
</div>
@endsection
