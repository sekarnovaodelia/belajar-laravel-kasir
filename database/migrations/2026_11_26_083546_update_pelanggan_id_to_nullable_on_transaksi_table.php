<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            // Ubah pelanggan_id agar boleh null (kosong)
            $table->foreignId('pelanggan_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->foreignId('pelanggan_id')->nullable(false)->change();
        });
    }
};