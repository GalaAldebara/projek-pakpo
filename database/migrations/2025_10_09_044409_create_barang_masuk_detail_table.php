<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang_masuk_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_masuk_id')->constrained('barang_masuk')->cascadeOnDelete();
            $table->foreignId('order_pembelian_id')->nullable()->constrained('order_pembelian')->cascadeOnDelete();
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->integer('jumlah_order'); // jumlah yang dipesan (dari PO)
            $table->integer('jumlah_terima'); // jumlah diterima di pengiriman ini
            $table->foreignId('satuan_id')->nullable()->constrained('satuan')->nullOnDelete();
            $table->date('tgl_kirim')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk_detail');
    }
};
