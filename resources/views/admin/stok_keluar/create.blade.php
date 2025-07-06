@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Tambah Stok Keluar</h4>
            </div>
        </div>
    </div>

    <!-- Card utama dengan margin top -->
    <div class="row mt-2">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('stok-keluar.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <!-- Kolom 1 -->
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="kode_barang_id" class="form-label fw-semibold">Barang <span
                                            class="text-danger">*</span></label>
                                    <select name="kode_barang_id" id="kode_barang_id" class="form-select" required>
                                        <option value="">Pilih Barang</option>
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->kode_barang }}" @selected(old('kode_barang_id') == $barang->kode_barang)>
                                                {{ $barang->nama_barang }} ({{ $barang->kode_barang }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('kode_barang_id')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="tanggal_keluar" class="form-label fw-semibold">Tanggal keluar <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_keluar" id="tanggal_keluar" class="form-control"
                                        required value="{{ old('tanggal_keluar', date('Y-m-d')) }}">
                                    @error('tanggal_keluar')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>



                            </div>

                            <!-- Kolom 2 -->
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label for="jumlah" class="form-label fw-semibold">Jumlah <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="jumlah" id="jumlah" min="1" class="form-control"
                                        required placeholder="keluarkan jumlah" value="{{ old('jumlah') }}">
                                    @error('jumlah')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>




                            </div>
                        </div>



                        <div class="mb-4">
                            <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" rows="3" class="form-control"
                                placeholder="keluarkan keterangan (opsional)">{{ old('keterangan') }}</textarea>
                            @error('keterangan')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <button type="button" class="btn btn-light" onclick="window.history.back()">Kembali</button>
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
