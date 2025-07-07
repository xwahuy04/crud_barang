@extends('layouts.supervisior')

@section('content')
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Selamat datang, {{ session('userName') ?? 'Supervisor' }}!</h5>
                        <form action="{{ route('logout') }}" method="POST" class="mb-0">
                            @csrf
                            <button type="submit" class="btn btn-light btn-sm">
                                <i class="ti ti-logout me-1"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="ti ti-info-circle me-2"></i> Anda memiliki akses read-only ke sistem.
                    </div>
                    
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="{{ route('supervisor.kategori') }}" class="btn btn-primary">
                            <i class="ti ti-category me-1"></i> Lihat Kategori
                        </a>
                        <a href="{{ route('supervisor.barang') }}" class="btn btn-primary">
                            <i class="ti ti-package me-1"></i> Lihat Barang
                        </a>
                        <a href="{{ route('supervisor.stok-masuk') }}" class="btn btn-primary">
                            <i class="ti ti-arrow-down me-1"></i> Stok Masuk
                        </a>
                        <a href="{{ route('supervisor.stok-keluar') }}" class="btn btn-primary">
                            <i class="ti ti-arrow-up me-1"></i> Stok Keluar
                        </a>
                        <a href="{{ route('supervisor.laporan') }}" class="btn btn-primary">
                            <i class="ti ti-report-analytics me-1"></i> Lihat Laporan
                        </a>
                        <a href="{{ route('supervisor.riwayat-stok') }}" class="btn btn-primary">
                            <i class="ti ti-report-analytics me-1"></i> Lihat Riwayat Stok
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    // Smooth logout confirmation
    document.querySelectorAll('form[action="{{ route('logout') }}"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Konfirmasi Logout',
                text: 'Anda yakin ingin logout?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading state
                    const button = this.querySelector('button');
                    const originalHtml = button.innerHTML;
                    button.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Logging out...';
                    button.disabled = true;
                    
                    // Submit form after short delay
                    setTimeout(() => {
                        this.submit();
                    }, 500);
                }
            });
        });
    });
</script>
@endsection
@endsection