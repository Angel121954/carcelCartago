<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Guardia;

class GuardiaSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(3)->create([
            'role' => 'guardia'
        ])->each(function ($user) {
            Guardia::factory()->create([
                'user_id' => $user->id
            ]);
        });
    }
}