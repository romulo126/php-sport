<?php

namespace Tests\Feature\Player\Route;

use App\Models\User;
use App\Models\Sports\PlayersModel;
use App\Models\Sports\TeamsModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Response;


class GetTest extends TestCase
{
    use RefreshDatabase;

    private string $token;

    public function setUp(): void
    {
        parent::setUp();
        $this->createUser();
        $this->loginUser();
    }

    /**
     * @test
     *
     * @dataProvider playerDataProvider
     */
    public function getPlayerTest(string $nameRoute, int $status, array $expected, bool $creatPlayers, bool $withAuthHeader): void
    {
        if ($creatPlayers) {
            $team = $this->createTeam();
            $this->createPlayer($team->id);
        }

        $headers = $withAuthHeader
            ? ['Authorization' => "Bearer {$this->token}"]
            : ['Authorization' => "Bearer invalid-token"];
        $headers['Accept'] = 'application/json';

        $response = $this->withHeaders($headers)->get(route($nameRoute, 1));

        $response->assertStatus($status);
        $response->assertJsonStructure($expected);
    }

    public static function playerDataProvider(): array
    {
        return [
            [
                'api.player.get',
                Response::HTTP_UNAUTHORIZED,
                ['message'],
                false,
                false
            ],
            [
                'api.player.get',
                Response::HTTP_OK,
                [],
                false,
                true
            ],
            [
                'api.player.get',
                Response::HTTP_OK,
                [
                    'data',
                    'data' => [
                        'id',
                        'first_name',
                        'last_name',
                        'position',
                        'height',
                        'weight',
                        'jersey_number',
                        'college',
                        'country',
                        'draft_year',
                        'draft_round',
                        'draft_number',
                        'team',
                        'team' => [
                            'team_id',
                            'conference',
                            'division',
                            'city',
                            'name',
                            'full_name',
                            'abbreviation'
                        ]
                    ]
                ],
                true,
                true
            ]
        ];
    }

    private function createUser(): void
    {
        User::factory()->create([
            'email' => 'teste@teste.com',
            'password' => bcrypt('123456'),
            'is_admin' => false
        ]);
    }

    private function loginUser(): void
    {
        $user = User::where('email', 'teste@teste.com')->first();

        $this->token = $user->createToken('TestToken')->plainTextToken;
    }

    private function createTeam(): TeamsModel
    {
        return TeamsModel::factory()->create();;
    }

    private function createPlayer(int $idTeeam): void
    {
        PlayersModel::factory()->state(['id' => 1])->create([
            'player_bot_id' => fake()->randomNumber(),
            'team_id' => $idTeeam,
            'first_name' => fake()->word(),
            'last_name' => fake()->word(),
            'position' => fake()->word(),
            'height' => fake()->word(),
            'weight' => fake()->randomNumber(),
            'jersey_number' => fake()->word(),
            'college' => fake()->word(),
            'country' => fake()->word(),
            'draft_year' => fake()->randomNumber(),
            'draft_round' => fake()->randomNumber(),
            'draft_number' => fake()->randomNumber(),
        ]);
    }
}
