<?php

namespace Database\Seeders;

use App\Models\Wilayah;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WilayahSeeder extends Seeder
{
    /**
     * Seed the database with the SQL file that contains the wilayah data.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(
            file_get_contents(__DIR__ . '\sql\wilayahs.sql')
        );

        Wilayah::query()->update([
            'created_at' => now()
        ]);
    }
}
