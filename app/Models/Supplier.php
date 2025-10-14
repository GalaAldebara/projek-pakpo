<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['nama', 'kode_supplier', 'alamat', 'no_telp'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function orderPembelian()
    {
        return $this->hasMany(\App\Models\OrderPembelian::class, 'supplier_id');
    }
}
