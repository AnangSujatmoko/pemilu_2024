<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * This seeder will create some users as follows:
     * 1. Superadmin
     * 2. Operator Kranggan
     * 3. Operator Magersari
     * 4. Operator Prajurit Kulon
     */
    public function run(): void
    {
        // ========== Superadmin ==========
        $userSuperadmin = User::create([
            'name' => 'Administrator',
            'username' => 'administrator',
            'email' => 'admin@mail.com',
            'password' => Hash::make('administrator'),
            'created_at' => now()
        ]);

        $roleSuperadmin = Role::where('name', 'Administrator')->first();

        $userSuperadmin->assignRole([$roleSuperadmin->id]);
        // ========== End Superadmin ==========

        // ========== Operator ==========
        $roleOperator = Role::where('name', 'Operator')->first();

        // Operator Kranggan
        $userOperatorKranggan = User::create([
            'name' => 'Operator Kranggan 001',
            'username' => 'opkranggan01',
            'email' => 'opkranggan01@mail.com',
            'password' => Hash::make('opkranggan'),
            'created_at' => now()
        ]);
        $userOperatorKranggan->assignRole([$roleOperator->id]);

        // Operator Magersari
        $userOperatorMagersari = User::create([
            'name' => 'Operator Magersari 001',
            'username' => 'opmagersari01',
            'email' => 'opmagersari01@mail.com',
            'password' => Hash::make('opkmagersari'),
            'created_at' => now()
        ]);
        $userOperatorMagersari->assignRole([$roleOperator->id]);

        // Operator Prajurit Kulon
        $userOperatorPralon = User::create([
            'name' => 'Operator Prajurit Kulon 001',
            'username' => 'oppralon01',
            'email' => 'oppralon01@mail.com',
            'password' => Hash::make('oppralon'),
            'created_at' => now()
        ]);
        $userOperatorPralon->assignRole([$roleOperator->id]);
        // ========== End Operator ==========
    }
}
