<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('riwayat_stok', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang_id');
            $table->foreign('kode_barang_id')->references('kode_barang')->on('barang')->onDelete('cascade');
            $table->enum('jenis_transaksi', ['masuk', 'keluar']);
            $table->integer('jumlah');
            $table->integer('stok_sebelum');
            $table->integer('stok_sesudah');
            $table->text('keterangan')->nullable();
            $table->foreignId('stok_masuk_id')->nullable()->constrained('stok_masuk')->onDelete('cascade');
            $table->foreignId('stok_keluar_id')->nullable()->constrained('stok_keluar')->onDelete('cascade');

            $table->index(['kode_barang_id', 'jenis_transaksi', 'created_at']);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_stoks');
    }
};
