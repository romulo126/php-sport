<?php

namespace Database\Seeders;

use App\Models\Sports\GamesModel;
use Illuminate\Database\Seeder;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GamesModel::factory()->count(30)->create();
    }
}
