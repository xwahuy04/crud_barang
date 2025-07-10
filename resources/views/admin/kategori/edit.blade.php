@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Edit Kategori</h4>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <label for="nama_kategori" class="form-label fw-semibold">Nama Kategori</label>
                                    <input type="text" name="nama_kategori" class="form-control" id="nama_kategori"
                                        placeholder="Masukkan nama kategori" value="{{ $kategori->nama_kategori }}" required>
                                    @error('nama_kategori')
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