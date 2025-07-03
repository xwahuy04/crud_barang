@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Edit Barang</h4>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('barang.update', $barang->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="kode_barang" class="form-label fw-semibold">Kode Barang</label>
                            <input type="text" name="kode_barang" class="form-control" id="kode_barang"
                                placeholder="Masukkan kode barang" value="{{ $barang->kode_barang }}" required>
                            @error('kode_barang')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="nama_barang" class="form-label fw-semibold">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" id="nama_barang"
                                placeholder="Masukkan nama barang" value="{{ $barang->nama_barang }}" required>
                            @error('nama_barang')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi </label>
                            <input type="text" name="deskripsi" class="form-control" id="deskripsi"
                                placeholder="Masukkan deskripsi" value="{{ $barang->deskripsi }}" required>
                            @error('deskripsi')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="kategori_id" class="form-label fw-semibold">Kategori</label>
                            <select name="kategori_id" class="form-control" id="kategori_id" required>
                                @foreach ($kategori as $kat)
                                    <option value="{{ $kat->id }}"
                                        {{ $barang->kategori_id == $kat->id ? 'selected' : '' }}>
                                        {{ $kat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="stok" class="form-label fw-semibold">Stok</label>
                            <input type="number" name="stok" class="form-control" id="stok"
                                placeholder="Masukkan stok" value="{{ $barang->stok }}" required>
                            @error('stok')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <button type="reset" class="btn btn-light" onclick="window.history.back()">Kembali</button>
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
