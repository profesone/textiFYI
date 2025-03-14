<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'A Team Leader',
            'email' => 'ateam@test.com',
            'phone' => '2812812288',
            'roles' => 'lead_agent',
            'team_id' => 1,
            'password' => bcrypt('password')
        ]);
        
        User::factory()->create([
            'name' => 'B Team Leader',
            'email' => 'bteam@test.com',
            'phone' => '2813813388',
            'roles' => 'lead_agent',
            'team_id' => 2,
            'password' => bcrypt('password')
        ]);
    }
}
