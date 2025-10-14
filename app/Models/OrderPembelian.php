<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPembelian extends Model
{
    protected $table = 'order_pembelian';

    protected $fillable = [
        'supplier_id',
        'sku',
        'item_id',
        'no_bukti',
        'jumlah',
        'satuan_id',
        'harga',
        'total',
        'tgl_kirim',
        'discount',
        'ppn',
        'pph',
        'is_kredit',
        'status',
        'hari_kredit',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }
}
