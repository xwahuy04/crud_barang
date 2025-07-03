@extends('layouts.app')

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
                        <h3 class="mb-0 fw-bolder">1,245</h3>
                        <span class="text-muted">Barang Masuk Hari Ini</span>
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
                        <i class="ti ti-arrow-bar-to-down fs-7 text-white"></i>
                    </div>
                    <div class="ms-3">
                        <h3 class="mb-0 fw-bolder">8,752</h3>
                        <span class="text-muted">Barang Masuk Minggu Ini</span>
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
                        <i class="ti ti-calendar-stats fs-7 text-white"></i>
                    </div>
                    <div class="ms-3">
                        <h3 class="mb-0 fw-bolder">32,489</h3>
                        <span class="text-muted">Barang Masuk Bulan Ini</span>
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
                        <i class="ti ti-database fs-7 text-white"></i>
                    </div>
                    <div class="ms-3">
                        <h3 class="mb-0 fw-bolder">124,567</h3>
                        <span class="text-muted">Total Barang Masuk</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection