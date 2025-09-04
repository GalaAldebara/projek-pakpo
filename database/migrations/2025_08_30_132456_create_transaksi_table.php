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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->string('no_bukti')->nullable();
            $table->string('kode');
            $table->string('nama');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->decimal('harga', 15, 2);
            $table->decimal('total', 15, 2);
            $table->date('tgl_kirim');
            $table->decimal('discount', 5, 2)->nullable();
            $table->decimal('ppn', 5, 2)->nullable();
            $table->decimal('pph', 5, 2)->nullable();
            $table->enum('is_kredit', ['CASH', 'KREDIT'])->default('CASH');
            $table->integer('hari_kredit')->nullable();
            $table->timestamps();

            $table->index(['no_bukti']);
            $table->index(['supplier_id', 'no_bukti']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
