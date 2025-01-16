<?php

namespace Database\Factories\Sports;

use App\Models\Sports\TeamsModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AppModelsSportsTeamsModel>
 */
class TeamsModelFactory extends Factory
{
    protected $model = TeamsModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_bot_id' => $this->faker->randomNumber(),
            'conference' => $this->faker->word(),
            'division' => $this->faker->word(),
            'city' => $this->faker->city(),
            'name' => $this->faker->word(),
            'full_name' => $this->faker->company(),
            'abbreviation' => $this->faker->lexify('???'),
        ];
    }
}
