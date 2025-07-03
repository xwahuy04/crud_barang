@extends('layouts.app')

@section('content')
    <div class="row">
            <div class="">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Tambah Barang Baru</h4>
                </div>
            </div>
        </div>

        <!-- Card utama dengan margin top -->
        <div class="row mt-2">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('barang.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="kode_barang" class="form-label fw-semibold">Kode Barang</label>
                                <input type="text" name="kode_barang" class="form-control" id="kode_barang" 
                                    placeholder="Masukkan kode barang" required>
                                @error('kode_barang')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="nama_barang" class="form-label fw-semibold">Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control" id="nama_barang" 
                                    placeholder="Masukkan nama barang" required>
                                @error('nama_barang')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                                <input type="text" name="deskripsi" class="form-control" id="deskripsi" 
                                    placeholder="Masukkan deskripsi" required>
                                @error('deskripsi')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="kategori_barang" class="form-label fw-semibold">Kategori Barang</label>
                                <select name="kategori_id" class="form-select" id="kategori_barang" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_barang')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="stok" class="form-label fw-semibold">Stok</label>
                                <input type="number" name="stok" class="form-control" id="stok" 
                                    placeholder="Masukkan stok" required>
                                @error('stok')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end gap-3 mt-4">
                                <button type="reset" class="btn btn-light"onclick="window.history.back()">Kembali</button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-check me-2"></i>Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection