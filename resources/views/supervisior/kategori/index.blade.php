@extends('layouts.app')

@section('title', 'List Kategori')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="mb-1">Daftar Kategori</h1>
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
                            <th>Nama Kategori</th>
                            <th>Jumlah Barang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $index => $item)
                        <tr class="text-center">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->nama_kategori }}</td>
                            <td class="text-center">{{ $item->barang_count }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
