@extends('layouts.app')

@section('title', 'List Barang')


@section('content')

    <div class="row mb-4">
        <div class="col-12">
            <h1 class="mb-1">Daftar Barang</h1>
            <p class="text-muted">Mode Supervisor (Hanya View)</p>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="bg-light">
                        <tr class="text-center">
                            <th>Gambar</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Stok Awal</th>
                            <th>Stok Saat Ini</th>
                            <th>Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barangs as $index => $barang)
                        <tr class="text-center">
                            <td>
                                <img src="{{ $barang->gambar_url }}" alt="{{ $barang->nama_barang }}" class="img-thumbnail"
                                    style="max-width: 60px; max-height: 60px;">
                            </td>
                            <td>{{ $barang->kode_barang }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->kategori->nama_kategori }}</td>
                            <td>{{ $barang->stok_awal }}</td>
                            <td>
                                {{ $barang->stok_saat_ini }}
                            </td>
                            <td>{{ $barang->deskripsi }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
