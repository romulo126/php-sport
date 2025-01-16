<?php

namespace Tests\Feature\Games\Route;

use App\Models\User;
use App\Models\Sports\GamesModel;
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
     * @dataProvider gameDataProvider
     */
    public function getGameTest(string $nameRoute, int $status, array $expected, bool $creatGame, bool $withAuthHeader): void
    {
        if ($creatGame) {
            $this->createTeam();
            $this->createGame();
        }

        $headers = $withAuthHeader
            ? ['Authorization' => "Bearer {$this->token}"]
            : ['Authorization' => "Bearer invalid-token"];
        $headers['Accept'] = 'application/json';

        $response = $this->withHeaders($headers)->get(route($nameRoute, 1));

        $response->assertStatus($status);
        $response->assertJsonStructure($expected);
    }

    public static function gameDataProvider(): array
    {
        return [
            [
                'api.game.get',
                Response::HTTP_UNAUTHORIZED,
                ['message'],
                false,
                false
            ],
            [
                'api.game.get',
                Response::HTTP_OK,
                [],
                false,
                true
            ],
            [
                'api.game.get',
                Response::HTTP_OK,
                [
                    'data',
                    'data' => [
                        'id',
                        'date',
                        'season',
                        'status',
                        'period',
                        'time',
                        'postseason',
                        'home_team_score',
                        'visitor_team_score',
                        'home_team',
                        'visitor_team',
                        'home_team' => [
                            'team_id',
                            'conference',
                            'division',
                            'city',
                            'name',
                            'full_name',
                            'abbreviation'
                        ],
                        'visitor_team' => [
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
