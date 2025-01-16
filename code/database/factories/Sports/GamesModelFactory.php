<?php

namespace Database\Factories\Sports;

use App\Models\Sports\GamesModel;
use App\Models\Sports\TeamsModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppModelsSportsGamesModel>
 */
class GamesModelFactory extends Factory
{
    protected $model = GamesModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'game_bot_id' => $this->faker->randomNumber(),
            'home_team_id' => TeamsModel::factory(),
            'visitor_team_id' => TeamsModel::factory(),
            'date' => $this->faker->date(),
            'season' => $this->faker->date('Y'),
            'status' => 'finalit',
            'period' => $this->faker->randomNumber(),
            'time' => null,
            'postseason' => $this->faker->boolean(),
            'home_team_score' => $this->faker->randomNumber(),
            'visitor_team_score' => $this->faker->randomNumber(),
        ];
    }
}
