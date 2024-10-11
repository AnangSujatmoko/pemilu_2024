<?php

namespace Database\Seeders;

use App\Models\Penduduk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared(
            file_get_contents(__DIR__ . '\sql\dpt_1.sql'),
        );

        DB::unprepared(
            file_get_contents(__DIR__ . '\sql\dpt_2.sql')
        );

        DB::unprepared(
            file_get_contents(__DIR__ . '\sql\dpt_3.sql')
        );

        DB::unprepared(
            file_get_contents(__DIR__ . '\sql\dpt_4.sql')
        );

        DB::unprepared(
            file_get_contents(__DIR__ . '\sql\dpt_5.sql')
        );

        DB::unprepared(
            file_get_contents(__DIR__ . '\sql\dpt_6.sql')
        );

        DB::unprepared(
            file_get_contents(__DIR__ . '\sql\dpt_7.sql')
        );

        DB::unprepared(
            file_get_contents(__DIR__ . '\sql\dpt_8.sql')
        );

        DB::unprepared(
            file_get_contents(__DIR__ . '\sql\dpt_9.sql')
        );

        DB::unprepared(
            file_get_contents(__DIR__ . '\sql\dpt_10.sql')
        );

        DB::unprepared(
            file_get_contents(__DIR__ . '\sql\dpt_11.sql')
        );

        DB::unprepared(
            file_get_contents(__DIR__ . '\sql\dps_miji.sql')
        );

        Penduduk::query()->update([
            'created_at' => now()
        ]);
    }
}
