@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Daftar Barang</h1>
            <a href="{{ route('barang.create') }}"
                class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors mb-3 mt-5">
                + Tambah Barang
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th>Gambar</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Stok Awal</th>
                        <th>Stok Saat Ini</th>
                        {{-- <th>Ditambahkan Oleh</th> --}}
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $barang)
                        <tr class="text-center">
                            <td>
                                <img src="{{ $barang->gambar_url }}" alt="{{ $barang->nama_barang }}" class="img-thumbnail"
                                    style="max-width: 60px; max-height: 60px;">
                            </td>
                            <td>{{ $barang->kode_barang }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->deskripsi }}</td>
                            <td>{{ $barang->kategori->nama_kategori }}</td>
                            <td>{{ $barang->stok }}</td>
                            <td class="
                                @if ($barang->stok_saat_ini > $barang->stok_awal) text-green-600 dark:text-green-400
                                @elseif($barang->stok_saat_ini < $barang->stok_awal)
                                    text-red-600 dark:text-red-400
                                @else
                                    text-gray-600 dark:text-gray-300 @endif">
                                {{ $barang->stok_saat_ini }}
                            </td>
                            {{-- <td>{{ $barang->user->name }}</td> --}}
                            <td class="text-center">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                    action="{{ route('barang.destroy', $barang->kode_barang) }}" method="POST">
                                    <a href="{{ route('barang.edit', $barang->kode_barang) }}"
                                        class="btn btn-sm btn-primary">EDIT</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
