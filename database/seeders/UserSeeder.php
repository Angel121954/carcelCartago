<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('123456'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'juan.perez@carcel.test'],
            [
                'name' => 'Guardia Juan Perez',
                'password' => Hash::make('123456'),
                'role' => 'guardia',
            ]
        );

        User::firstOrCreate(
            ['email' => 'maria.lopez@carcel.test'],
            [
                'name' => 'Guardia Maria Lopez',
                'password' => Hash::make('123456'),
                'role' => 'guardia',
            ]
        );

        User::firstOrCreate(
            ['email' => 'carlos.ruiz@carcel.test'],
            [
                'name' => 'Guardia Carlos Ruiz',
                'password' => Hash::make('123456'),
                'role' => 'guardia',
            ]
        );
    }
}
