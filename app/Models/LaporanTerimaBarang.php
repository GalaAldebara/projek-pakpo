<?php
// Updated LaporanTerimaBarang Model
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanTerimaBarang extends Model
{
    use HasFactory;

    protected $table = 'laporan_terima_barang';

    protected $fillable = [
        'no_bukti',
        'supplier_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'no_bukti', 'no_bukti');
    }

    // Calculate total amount for this laporan
    public function getTotalAmountAttribute()
    {
        return $this->transaksi()->sum('total');
    }

    // Get formatted no_bukti
    public function getFormattedNoBuktiAttribute()
    {
        return $this->no_bukti;
    }

    // Static method to get next number for specific supplier and date
    public static function getNextNumber($kodeSupplier, $date = null)
    {
        if (!$date) {
            $date = now();
        }

        $tanggal = $date->format('dmY');
        $prefix = 'OR' . $kodeSupplier . $tanggal;

        $lastReport = static::where('no_bukti', 'like', $prefix . '%')
            ->orderBy('no_bukti', 'desc')
            ->first();

        if ($lastReport) {
            $lastNumber = (int)substr($lastReport->no_bukti, -3);
            $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '001';
        }

        return $prefix . $nextNumber;
    }
}
