<?php

namespace Database\Seeders;

use App\Models\Agency;
use Illuminate\Database\Seeder;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Agency::factory()->create([
            'name' => 'A Team',
            'description' => 'A Team Description',
            'website' => 'https://www.ateam.com',
            'owner_id' => 1,
        ]);

        Agency::factory()->create([
            'name' => 'B Team',
            'description' => 'B Team Description. And we are better thatn the A Team!',
            'website' => 'https://www.bteam.com',
            'owner_id' => 2,
        ]);

    }
}
