@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Laporan Pergerakan Barang</h1>

    <!-- Container untuk Diagram -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Diagram Batang -->
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-lg font-semibold mb-4">Perbandingan Stok</h2>
            <div class="chart-container">
                <canvas id="barChart"></canvas>
            </div>
        </div>
        
        <!-- Diagram Garis -->
        <div class="bg-white shadow rounded-lg p-4">
            <h2 class="text-lg font-semibold mb-4">Pergerakan Harian</h2>
            <div class="chart-container">
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Diagram Pie -->
    <div class="bg-white shadow rounded-lg p-4">
        <h2 class="text-lg font-semibold mb-4">Distribusi Kategori</h2>
        <div class="chart-container">
            <canvas id="pieChart"></canvas>
        </div>
    </div>
</div>

<!-- Gunakan CDN Chart.js 3.7.1 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>

<style>
    .chart-container {
        position: relative;
        width: 100%;
        min-height: 250px;
    }
</style>

<script>
/// Ganti bagian data dengan:
const barData = {
    labels: @json($barLabels),
    datasets: [{
        label: 'Stok Awal',
        data: @json($stokAwal),
        backgroundColor: 'rgba(54, 162, 235, 0.7)'
    }, {
        label: 'Stok Sekarang',
        data: @json($stokSekarang),
        backgroundColor: 'rgba(75, 192, 192, 0.7)'
    }]
};

const lineData = {
    labels: @json($dates),
    datasets: [{
        label: 'Stok Masuk',
        data: @json($masukData),
        borderColor: 'rgba(75, 192, 192, 1)',
        backgroundColor: 'rgba(75, 192, 192, 0.1)',
        tension: 0.3,
        fill: true
    }, {
        label: 'Stok Keluar',
        data: @json($keluarData),
        borderColor: 'rgba(255, 99, 132, 1)',
        backgroundColor: 'rgba(255, 99, 132, 0.1)',
        tension: 0.3,
        fill: true
    }]
};

const pieData = {
    labels: @json($kategoriLabels),
    datasets: [{
        data: @json($kategoriCount),
        backgroundColor: [
            'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 206, 86, 0.7)',
            'rgba(75, 192, 192, 0.7)'
        ]
    }]
};

// Inisialisasi chart setelah halaman siap
document.addEventListener('DOMContentLoaded', function() {
    // Diagram Batang
    new Chart(
        document.getElementById('barChart'),
        {
            type: 'bar',
            data: barData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        }
    );

    // Diagram Garis
    new Chart(
        document.getElementById('lineChart'),
        {
            type: 'line',
            data: lineData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        }
    );

    // Diagram Pie
    new Chart(
        document.getElementById('pieChart'),
        {
            type: 'pie',
            data: pieData,
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        }
    );
});
</script>
@endsection