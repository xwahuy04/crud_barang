@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="row">
            <div class="">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Tambah Kategori Baru</h4>
                </div>
            </div>
        </div>

        <!-- Card utama dengan margin top -->
        <div class="row mt-2">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('kategori.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="nama_kategori" class="form-label fw-semibold">Nama Kategori</label>
                                <input type="text" name="nama_kategori" class="form-control" id="nama_kategori" 
                                    placeholder="Masukkan nama kategori" required>
                                @error('nama_kategori')
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