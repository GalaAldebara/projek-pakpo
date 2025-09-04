<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_supplier',
        'nama_supplier',
    ];

    public function items()
    {
        return $this->hasMany(SupplierItem::class);
    }

    // Fixed: Changed from hasOne to hasMany
    public function laporan()
    {
        return $this->hasMany(LaporanTerimaBarang::class, 'supplier_id');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'supplier_id');
    }
}
