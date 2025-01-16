<?php

namespace Database\Seeders;

use App\Models\Sports\PlayersModel;
use Illuminate\Database\Seeder;

class PlayersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PlayersModel::factory()->count(30)->create();
    }
}
