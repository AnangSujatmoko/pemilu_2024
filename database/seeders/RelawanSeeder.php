<?php

namespace Database\Seeders;

use App\Models\Relawan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RelawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared(
            file_get_contents(__DIR__ . '\sql\relawans.sql'),
        );

        Relawan::query()->update([
            'created_at' => now()
        ]);
    }
}
