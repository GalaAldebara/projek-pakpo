<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Satuan;

class SatuanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['kode' => 'PCS', 'nama' => 'Pcs'],
            ['kode' => 'KG',  'nama' => 'Kilogram'],
            ['kode' => 'L',   'nama' => 'Liter'],
            ['kode' => 'BOX', 'nama' => 'Box'],
            ['kode' => 'M',   'nama' => 'Meter'],
        ];

        foreach ($data as $row) {
            Satuan::firstOrCreate(['kode' => $row['kode']], $row);
        }
    }
}
