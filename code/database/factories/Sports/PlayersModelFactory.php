<?php

namespace Database\Factories\Sports;

use App\Models\Sports\PlayersModel;
use App\Models\Sports\TeamsModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppModelsSportsPlayersModel>
 */
class PlayersModelFactory extends Factory
{
    protected $model = PlayersModel::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'player_bot_id' => $this->faker->unique()->randomNumber(),
            'team_id' => TeamsModel::factory(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'position' => $this->faker->randomElement(['G', 'F', 'C']),
            'height' => $this->faker->randomElement(['6-1', '6-5', '7-0']),
            'weight' => $this->faker->numberBetween(180, 250),
            'jersey_number' => $this->faker->numberBetween(1, 99),
            'college' => $this->faker->company(),
            'country' => $this->faker->country(),
            'draft_year' => $this->faker->numberBetween(2000, 2025),
            'draft_round' => $this->faker->numberBetween(1, 3),
            'draft_number' => $this->faker->numberBetween(1, 60),
        ];
    }
}
