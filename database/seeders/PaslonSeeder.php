<?php

namespace Database\Seeders;

use App\Models\Paslon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaslonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'uraian' => '01 Junaedi Malik - Khusnun Amin',
                'created_at' => now(),
            ],
            [
                'uraian' => '02 Ika Puspitasari - Rachman Sidharta Arisandi',
                'created_at' => now(),
            ],
        ];

        Paslon::insert($data);
    }
}
