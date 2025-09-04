<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    /**
     * Jalankan Seeder
     */
    public function run(): void
    {
        $supplierNames = [
            'Abadi Jaya',
            'Makmur Sejahtera',
            'Berkah Sentosa',
            'Tunas Mandiri',
            'Sumber Rejeki',
        ];

        foreach ($supplierNames as $index => $name) {
            Supplier::create([
                'kode_supplier' => str_pad($index + 1, 3, '0', STR_PAD_LEFT), // 001, 002, dst
                'nama_supplier' => $name,
            ]);
        }
    }
}
