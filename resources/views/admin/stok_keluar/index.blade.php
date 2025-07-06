@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Daftar Stok Keluar</h1>
            <a href="{{ route('stok-keluar.create') }}"
                class="btn btn-primary bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-colors mb-3 mt-5">
                + Tambah Stok Keluar
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">

            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <form action="{{ route('stok-masuk') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center">
                    <!-- Search Input -->
                    <div class="flex-1 w-full md:w-auto">
                        <input type="text" name="search" placeholder="Cari barang atau kode..."
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            value="{{ request('search') }}">
                    </div>

                    <!-- Date Range Input -->
                    <div class="flex flex-col md:flex-row gap-2 w-full md:w-auto">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dari Tanggal</label>
                            <input type="date" name="start_date"
                                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                value="{{ request('start_date') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sampai Tanggal</label>
                            <input type="date" name="end_date"
                                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                value="{{ request('end_date') }}">
                        </div>
                    </div>

                    <!-- Filter Button -->
                    <button type="submit"
                        class="w-full md:w-auto px-4 py-2 bg-blue-600 rounded-md hover:bg-blue-700 transition-colors dark:bg-blue-700 dark:hover:bg-blue-800">
                        Filter
                    </button>

                    <!-- Reset Button -->
                    @if (request()->has('search') || request()->has('start_date') || request()->has('end_date'))
                        <a href="{{ route('stok-masuk') }}"
                            class="w-full md:w-auto px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition-colors dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th>Kode Transaksi</th>
                            <th>Barang</th>
                            <th>Jumlah</th>
                            <th>Tanggal Keluar</th>
                            <th>Keterangan</th>

                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stokKeluar as $item)
                            <tr class="text-center">
                                <td>{{ $item->kode_transaksi }}</td>
                                <td>
                                    {{ $item->barang->nama_barang }} ({{ $item->kode_barang_id }})
                                </td>
                                <td>-{{ $item->jumlah }}</td>
                                <td>{{ $item->tanggal_keluar->format('d/m/Y') }}</td>
                                <td>{{ $item->keterangan ?? '-' }}</td>
                                {{-- <td>{{ $item->user->name }}</td> --}}
                                <td>
                                    <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');"
                                        action="{{ route('stok-keluar.destroy', $item->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                    Tidak ada data stok keluar yang ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="">
                {{ $stokKeluar->links() }}
            </div>
        </div>
    </div>
@endsection
