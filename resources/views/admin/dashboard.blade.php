@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="row">
    <!-- Card Jumlah Barang Masuk -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-primary rounded-circle p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-package fs-7 text-white"></i>
                    </div>
                    <div class="ms-3">
                        <h3 class="mb-0 fw-bolder">{{ number_format($jumlahBarang, 0, ',', '.') }}</h3>
                        <span class="text-muted">Jumlah Barang</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-success rounded-circle p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-tags fs-7 text-white"></i>
                    </div>
                    <div class="ms-3">
                        <h3 class="mb-0 fw-bolder">{{ number_format($jumlahKategori, 0, ',', '.') }}</h3>
                        <span class="text-muted">Jumlah Kategori</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-info rounded-circle p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-package fs-7 text-white"></i>
                    </div>
                    <div class="ms-3">
                        <h3 class="mb-0 fw-bolder">{{ number_format($jumlahStokMasuk, 0, ',', '.') }}</h3>
                        <span class="text-muted">Jumlah Stok Masuk</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-warning rounded-circle p-6 d-flex align-items-center justify-content-center">
                        <i class="ti ti-package-off fs-7 text-white"></i>
                    </div>
                    <div class="ms-3">
                        <h3 class="mb-0 fw-bolder">{{ number_format($jumlahStokKeluar, 0, ',', '.') }}</h3>
                        <span class="text-muted">Jumlah Stok Keluar</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
