<?php

namespace Database\Seeders;

use App\Models\Kendaraan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KendaraanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kendaraan::create([
            'nama'=>'Motor',
            'harga'=>2000.00
        ]);
        Kendaraan::create([
            'nama'=>'Minibus',
            'harga'=>4000.00
        ]);
        Kendaraan::create([
            'nama'=>'Truck',
            'harga'=>6000.00
        ]);
    }
}
