<?php

namespace Database\Seeders;

use App\Models\Lingkungan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LingkunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::unprepared(
            file_get_contents(__DIR__ . '\sql\lingkungans.sql'),
        );

        Lingkungan::query()->update([
            'created_at' => now()
        ]);
    }
}
