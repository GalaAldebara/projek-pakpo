<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;
use App\Models\SupplierItem;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SupplierItemSeeder extends Seeder
{
    /**
     * Jalankan Seeder
     */
    public function run(): void
    {
        $items = [
            'Rokok',
            'Semangka',
            'Beras',
            'Gula Pasir',
            'Minyak Goreng',
            'Kopi Bubuk',
            'Teh Celup',
            'Sabun Cuci',
            'Mie Instan',
            'Air Mineral',
        ];

        $suppliers = Supplier::all();

        foreach ($suppliers as $supplier) {
            // Ambil 5 item secara acak TANPA duplikat untuk supplier ini
            $randomItems = collect($items)->shuffle()->take(5);

            $counter = 1;
            foreach ($randomItems as $itemName) {
                SupplierItem::create([
                    'supplier_id'    => $supplier->id,
                    'kode_item'      => 'ITM-' . strtoupper(Str::random(3)) . '-' . str_pad($counter, 3, '0', STR_PAD_LEFT),
                    'nama_item'      => $itemName,
                    'tgl_kadaluarsa' => rand(0, 1) ? Carbon::now()->addMonths(rand(1, 12)) : null,
                ]);
                $counter++;
            }
        }
    }
}
