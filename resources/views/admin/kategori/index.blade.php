@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Daftar Kategori</h1>
            <a href="{{ route('kategori.create') }}"
                class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors mb-3 mt-5">
                 + Tambah Kategori
            </a>
        </div>

        @include('layouts.partials.error-message')

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <table class="table table-striped">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Jumlah Barang</th>
                    <th >Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kategori as $item)
                    <tr class="text-center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_kategori }}</td>
                        <td >{{ $item->barang->count() ?? 0 }}</td>
                      <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('kategori.destroy', $item->id) }}" method="POST">
                                            <a href="{{ route('kategori.edit', $item->id) }}" class="btn btn-sm btn-primary">EDIT</a>
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
