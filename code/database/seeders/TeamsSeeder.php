<?php

namespace Database\Seeders;

use App\Models\Sports\TeamsModel;
use Illuminate\Database\Seeder;

class TeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TeamsModel::factory()->count(30)->create();
    }
}
