<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'A Team Leader',
            'company_name' => 'A Team',
            'email' => 'ateam@test.com',
            'phone' => '2812812288',
            'roles' => 'lead_agent',
            'address' => '123 Street',
            'city' => 'Brooklyn',
            'state' => 'NY',
            'zip' => '12122',
            'agency_id' => 1,
            'password' => bcrypt('password')
        ]);
        
        User::factory()->create([
            'name' => 'B Team Leader',
            'company_name' => 'B Team',
            'email' => 'bteam@test.com',
            'phone' => '2813813388',
            'roles' => 'lead_agent',
            'address' => '456 Street',
            'city' => 'Brooklyn',
            'state' => 'NY',
            'zip' => '12122',
            'agency_id' => 2,
            'password' => bcrypt('password')
        ]);

        User::factory()->create([
            'name' => 'Profesone',
            'company_name' => '',
            'email' => 'admin@TextiFYI.com',
            'phone' => '2813231333',
            'roles' => 'admin',
            'address' => '123 Street',
            'city' => 'Brooklyn',
            'state' => 'NY',
            'zip' => '12122',
            'password' => bcrypt('M3t@1V$$t331')
        ]);

        User::factory(10)->create();
    }
}
