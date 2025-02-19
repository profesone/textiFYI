<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'                => 1,
                'name'              => 'Admin',
                'email'             => 'admin@admin.com',
                'password'          => bcrypt('password'),
                'remember_token'    => null,
                'role_id'           => 1,
                'email_verified_at' => now(),
            ],            
            [
                'id'                => 2,
                'name'              => 'Agent',
                'email'             => 'agent@agent.com',
                'password'          => bcrypt('password'),
                'remember_token'    => null,
                'role_id'           => 2,
                'email_verified_at' => now(),
            ],
            [
                'id'                => 3,
                'name'              => 'Client',
                'email'             => 'client@client.com',
                'password'          => bcrypt('password'),
                'remember_token'    => null,
                'role_id'           => 3,
                'email_verified_at' => now(),
            ],
        ];

        User::insert($users);
    }
}
