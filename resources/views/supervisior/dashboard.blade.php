@extends('layouts.supervisior')

@section('title', 'Dashboard Supervisor')

@push('styles')
<style>
    .card-link {
        text-decoration: none;
        color: inherit;
    }
    .card-link .card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .card-link .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .icon-bg {
        font-size: 2.5rem;
        opacity: 0.2;
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
    }
</style>
@endpush

@section('content')
    <!-- Welcome Header -->
    <div class="card bg-primary text-white mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title mb-1 text-white">Selamat Datang, {{ session('userName') ?? 'Supervisor' }}!</h4>
                    <p class="mb-0">Anda memiliki akses read-only ke sistem.</p>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="mb-0">
                    @csrf
                    <button type="submit" class="btn btn-light btn-sm">
                        <i class="ti ti-logout me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <a href="{{ route('supervisor.barang') }}" class="card-link">
                <div class="card border-left-primary shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Barang</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahBarang ?? 'N/A' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="ti ti-package icon-bg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <a href="{{ route('supervisor.kategori') }}" class="card-link">
                <div class="card border-left-success shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Kategori</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahKategori ?? 'N/A' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="ti ti-category icon-bg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <a href="{{ route('supervisor.stok-masuk') }}" class="card-link">
                <div class="card border-left-info shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Stok Masuk (Bulan Ini)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stokMasukBulanan ?? 'N/A' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="ti ti-arrow-down icon-bg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <a href="{{ route('supervisor.stok-keluar') }}" class="card-link">
                <div class="card border-left-warning shadow-sm h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Stok Keluar (Bulan Ini)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stokKeluarBulanan ?? 'N/A' }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="ti ti-arrow-up icon-bg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Navigation Links -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Akses Cepat</h5>
        </div>
        <div class="card-body">
            <div class="d-flex flex-wrap gap-3">
                <a href="{{ route('supervisor.laporan') }}" class="btn btn-outline-primary">
                    <i class="ti ti-report-analytics me-1"></i> Lihat Laporan
                </a>
                <a href="{{ route('supervisor.riwayat-stok') }}" class="btn btn-outline-primary">
                    <i class="ti ti-history me-1"></i> Lihat Riwayat Stok
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const logoutForm = document.querySelector('form[action="{{ route('logout') }}"]');
        if (logoutForm) {
            logoutForm.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Konfirmasi Logout',
                    text: 'Anda yakin ingin logout?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#0d6efd',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Logout',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const button = this.querySelector('button');
                        const originalHtml = button.innerHTML;
                        button.innerHTML = `<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Logging out...`;
                        button.disabled = true;
                        
                        setTimeout(() => {
                            this.submit();
                        }, 500);
                    }
                });
            });
        }
    });
</script>
@endpush
