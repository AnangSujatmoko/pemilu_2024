<?php

namespace Database\Seeders;

use App\Models\Domisili;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DomisiliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'uraian' => 'Kota Mojokerto',
                'created_at' => now(),
            ],
            [
                'uraian' => 'Kab Mojokerto',
                'created_at' => now(),
            ],
            [
                'uraian' => 'Luar Kota Dalam Provinsi',
                'created_at' => now(),
            ],
            [
                'uraian' => 'Luar Kota Luar Provinsi',
                'created_at' => now(),
            ],
        ];

        Domisili::insert($data);
    }
}
