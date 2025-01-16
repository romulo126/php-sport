<?php

namespace Tests\Feature\Games\Route;

use App\Models\User;
use App\Models\Sports\GamesModel;
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
     * @dataProvider gameDataProvider
     */
    public function updateGameTest(string $nameRoute, array $playload, int $status, array $expected, bool $creatGame, bool $withAuthHeader): void
    {
        if ($creatGame) {
            $this->createTeam();
            $this->createGame();
        }

        $headers = $withAuthHeader
            ? ['Authorization' => "Bearer {$this->token}"]
            : ['Authorization' => "Bearer invalid-token"];
        $headers['Accept'] = 'application/json';

        $response = $this->withHeaders($headers)->put(route($nameRoute, $playload));

        $response->assertStatus($status);
        $response->assertJsonStructure($expected);
    }

    public static function gameDataProvider(): array
    {
        return [
            [
                'api.game.update',
                [
                    'id' => 1
                ],
                Response::HTTP_UNAUTHORIZED,
                ['message'],
                false,
                false
            ],
            [
                'api.game.update',
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
                'api.game.update',
                [
                    'id' => 1,
                    'home_team_id' => 502222,
                    'visitor_team_id' => 52222222,
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY,
                [
                    'message',
                    'errors',
                    'errors' => [
                        'home_team_id',
                        'visitor_team_id'
                    ]
                ],
                true,
                true
            ],
            [
                'api.game.update',
                [
                    'id' => 1,
                    'date' => '',
                    'season' => ''
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY,
                [
                    'message',
                    'errors',
                    'errors' => [
                        'date',
                        'season',
                    ]
                ],
                true,
                true
            ],
            [
                'api.game.update',
                [
                    'id' => 1,
                    'home_team_score' => 1,
                    'period' => null,
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

    private function createTeam(): void
    {
        TeamsModel::factory()->state(['id' => 1])->create();
        TeamsModel::factory()->state(['id' => 2])->create();
    }

    private function createGame(): void
    {
        GamesModel::factory()->state(['id' => 1])->create([
            'game_bot_id' => fake()->randomNumber(),
            'home_team_id' => 1,
            'visitor_team_id' => 2,
            'date' => fake()->date(),
            'season' => fake()->date('Y'),
            'status' => 'finalit',
            'period' => fake()->randomNumber(),
            'time' => null,
            'postseason' => fake()->boolean(),
            'home_team_score' => fake()->randomNumber(),
            'visitor_team_score' => fake()->randomNumber(),
        ]);
    }
}
