<?php

namespace Tests\Feature\Player\Route;

use App\Models\User;
use App\Models\Sports\PlayersModel;
use App\Models\Sports\TeamsModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Response;


class PutTest extends TestCase
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
    public function updatePlayerTest(string $nameRoute, array $playload, int $status, array $expected, bool $creatPlayers, bool $withAuthHeader): void
    {
        if ($creatPlayers) {
            $team = $this->createTeam();
            $this->createPlayer($team->id);
        }

        $headers = $withAuthHeader
            ? ['Authorization' => "Bearer {$this->token}"]
            : ['Authorization' => "Bearer invalid-token"];
        $headers['Accept'] = 'application/json';

        $response = $this->withHeaders($headers)->put(route($nameRoute, $playload));
        
        $response->assertStatus($status);
        $response->assertJsonStructure($expected);
    }

    public static function playerDataProvider(): array
    {
        return [
            [
                'api.player.update',
                [
                    'id' => 1
                ],
                Response::HTTP_UNAUTHORIZED,
                ['message'],
                false,
                false
            ],
            [
                'api.player.update',
                [
                    'id' => 1,
                ],
                Response::HTTP_OK,
                [
                    'status'
                ],
                true,
                true
            ],
            [
                'api.player.update',
                [
                    'id' => 1,
                    'team_id' => 502222,
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY,
                [
                    'message',
                    'errors',
                    'errors' => [
                        'team_id'
                    ]
                ],
                true,
                true
            ],
            [
                'api.player.update',
                [
                    'id' => 1,
                    'first_name' => '',
                    'last_name' => ''
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY,
                [
                    'message',
                    'errors',
                    'errors' => [
                        'first_name',
                        'last_name',
                    ]
                ],
                true,
                true
            ],
            [
                'api.player.update',
                [
                    'id' => 1,
                    'team_id' => 1,
                    'position' => null,
                    'jersey_number' => 1
                ],
                Response::HTTP_OK,
                [
                    'status'
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
        return TeamsModel::factory()->state(['id' => 1])->create();
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
