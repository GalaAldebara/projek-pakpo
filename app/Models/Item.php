<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['supplier_id', 'name', 'sku', 'satuan_id'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            // ambil item terakhir
            $lastId = Item::max('id') ?? 0;
            $nextId = $lastId + 1;

            // format SKU: ITEM-0001
            $item->sku = 'ITEM-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        });
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }
}
