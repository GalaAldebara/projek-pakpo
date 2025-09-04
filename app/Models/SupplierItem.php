<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'nama_item',
        'tgl_kadaluarsa',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
