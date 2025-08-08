<?php

namespace Database\Seeders;

use App\Models\TextifyiNumber;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TextifyiNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TextifyiNumber::factory(10)->create();
    }
}
