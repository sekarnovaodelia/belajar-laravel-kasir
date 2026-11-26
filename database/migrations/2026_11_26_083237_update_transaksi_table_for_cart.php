<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Buat tabel transaksi_detail (Keranjang)
        Schema::create('transaksi_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksi')->onDelete('cascade');
            $table->foreignId('barang_id')->constrained('barang')->onDelete('cascade');
            $table->integer('jumlah');
            $table->double('harga');
            $table->double('subtotal');
            $table->timestamps();
        });

        // 2. Ubah tabel transaksi (Hapus kolom lama, tambah kolom baru)
        Schema::table('transaksi', function (Blueprint $table) {
            // Hapus relasi lama
            $table->dropForeign(['barang_id']);
            $table->dropColumn(['barang_id', 'jumlah']);
            
            // Tambahkan kolom untuk input manual (pelanggan tanpa daftar)
            $table->string('nama_pelanggan_manual')->nullable()->after('pelanggan_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_detail');
        
        Schema::table('transaksi', function (Blueprint $table) {
            $table->foreignId('barang_id')->constrained('barang');
            $table->integer('jumlah');
            $table->dropColumn('nama_pelanggan_manual');
        });
    }
};