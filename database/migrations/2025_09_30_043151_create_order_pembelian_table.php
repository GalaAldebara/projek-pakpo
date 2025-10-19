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
        Schema::create('order_pembelian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers')->cascadeOnDelete();
            $table->foreignId('item_id')->constrained('items')->cascadeOnDelete();
            $table->string('sku');
            $table->string('no_bukti')->index();
            $table->integer('jumlah');
            $table->foreignId('satuan_id')->constrained('satuan')->cascadeOnDelete();
            $table->decimal('harga', 15, 2);
            $table->decimal('total', 15, 2);
            $table->date('tgl_kirim');
            $table->decimal('discount', 5, 2)->nullable();
            $table->decimal('ppn', 5, 2)->nullable();
            $table->decimal('pph', 5, 2)->nullable();
            $table->enum('is_kredit', ['CASH', 'KREDIT'])->default('CASH');
            $table->enum('status', ['PROSES', 'SELESAI'])->default('PROSES');
            $table->integer('hari_kredit')->nullable();
            $table->timestamps();

            // Index tambahan
            $table->index('supplier_id');
            $table->index('item_id');
            $table->index('satuan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_pembelian');
    }
};
