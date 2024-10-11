<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Administrator',
                'guard_name' => 'web',
                'created_at' => now(),
            ],
            [
                'name' => 'Operator',
                'guard_name' => 'web',
                'created_at' => now(),
            ]
        ];

        Role::insert($data);
    }
}
