<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokMasukController;
use App\Http\Controllers\StokKeluarController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SupervisiorController;
use App\Http\Controllers\RiwayatStokController;

/*
|----------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['isLoggedIn', 'adminRedirect'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/destroy/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    Route::get('/barang', [BarangController::class, 'index'])->name('barang');
    Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/barang/edit/{kode_barang}', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/barang/update/{kode_barang}', [BarangController::class, 'update'])->name('barang.update');
    Route::post('/barang/upload-temp', [BarangController::class, 'uploadTemp'])->name('barang.upload-temp');
    // Route::delete('/barang/delete-temp', [BarangController::class, 'deleteTemp'])->name('barang.delete-temp');
    Route::delete('/barang/destroy/{kode_barang}', [BarangController::class, 'destroy'])
    ->name('barang.destroy');

    Route::get('/user', [AdminController::class, 'user'])->name('user');
    Route::post('/user', [AdminController::class, 'store'])->name('user.store');
    Route::delete('user/delete-user/{id}', [AdminController::class, 'destroy'])->name('user.destroy');

    Route::get('/stok-masuk', [StokMasukController::class, 'index'])->name('stok-masuk');
    Route::get('/stok-masuk/create', [StokMasukController::class, 'create'])->name('stok-masuk.create');
    Route::post('/stok-masuk/store', [StokMasukController::class, 'store'])->name('stok-masuk.store');
    Route::delete('/stok-masuk/delete/{id}', [StokMasukController::class, 'destroy'])->name('stok-masuk.destroy');


    Route::get('/stok-keluar', [StokKeluarController::class, 'index'])->name('stok-keluar');
    Route::get('/stok-keluar/create', [StokKeluarController::class, 'create'])->name('stok-keluar.create');
    Route::post('/stok-keluar/store', [StokKeluarController::class, 'store'])->name('stok-keluar.store');
    Route::delete('/stok-keluar/delete/{id}', [StokKeluarController::class, 'destroy'])->name('stok-keluar.destroy');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
    Route::get('/riwayat-stok', [RiwayatStokController::class, 'index'])->name('riwayat-stok');



});

Route::middleware(['isLoggedIn', 'supervisorCheck'])->prefix('supervisor')->group(function () {
    Route::get('/', [SupervisiorController::class, 'index'])->name('supervisor.dashboard');

    // Read-only routes
    Route::get('/kategori', [KategoriController::class, 'index'])->name('supervisor.kategori');
    Route::get('/barang', [BarangController::class, 'index'])->name('supervisor.barang');
    Route::get('/stok-masuk', [StokMasukController::class, 'index'])->name('supervisor.stok-masuk');
    Route::get('/stok-keluar', [StokKeluarController::class, 'index'])->name('supervisor.stok-keluar');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('supervisor.laporan');
});


 Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
