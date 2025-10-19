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
        Schema::create('barang_masuk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->string('no_bukti'); // No bukti PO yang diambil dari order_pembelian
            $table->date('tanggal_terima');
            $table->string('surat_jalan')->nullable();
            $table->enum('status', ['BARANG KURANG', 'DITERIMA', 'BELUM DITERIMA'])->default('DITERIMA');
            $table->text('keterangan')->nullable();
            $table->timestamps();

            $table->index(['no_bukti']);
            $table->index(['supplier_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuk');
    }
};
