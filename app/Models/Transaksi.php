<?php
// Updated Transaksi Model
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'supplier_id',
        'no_bukti',
        'kode',
        'nama',
        'jumlah',
        'satuan',
        'harga',
        'total',
        'tgl_kirim',
        'discount',
        'ppn',
        'pph',
        'is_kredit',
        'hari_kredit',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'total' => 'decimal:2',
        'discount' => 'decimal:2',
        'ppn' => 'decimal:2',
        'pph' => 'decimal:2',
        'tgl_kirim' => 'date',
    ];

    const CASH = 'CASH';
    const KREDIT = 'KREDIT';

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function laporanTerimaBarang()
    {
        return $this->belongsTo(LaporanTerimaBarang::class, 'no_bukti', 'no_bukti');
    }

    // Scope for filtering by no_bukti
    public function scopeByNoBukti($query, $noBukti)
    {
        return $query->where('no_bukti', $noBukti);
    }
}
