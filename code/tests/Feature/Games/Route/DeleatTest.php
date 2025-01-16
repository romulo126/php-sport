<?php

namespace Tests\Feature\Games\Route;

use App\Models\User;
use App\Models\Sports\GamesModel;
use App\Models\Sports\TeamsModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Response;

class DeleatTest extends TestCase
{
    use RefreshDatabase;

    private string $token;
    private string $tokenAdm;

    public function setUp(): void
    {
        parent::setUp();
        $this->createUser();
        $this->loginUser();
        $this->loginAdminUser();
    }

    /**
     * @test
     *
     * @dataProvider gameDataProvider
     */
    public function deleatGameTest(string $nameRoute, array $playload, int $status, array $expected, bool $creatGame, bool $withAuthHeaderNotAdm, bool $withAuthHeaderAdm): void
    {
        if ($creatGame) {
            $this->createTeam();
            $this->createGame();
        }

        if ($withAuthHeaderNotAdm) {
            $headers['Authorization'] = "Bearer {$this->token}";
        } elseif ($withAuthHeaderAdm) {
            $headers['Authorization'] = "Bearer {$this->tokenAdm}";
        }
        
        $headers['Accept'] = 'application/json';

        $response = $this->withHeaders($headers)->delete(route($nameRoute, $playload));

        $response->assertStatus($status);
        $response->assertJsonStructure($expected);
    }

    public static function gameDataProvider(): array
    {
        return [
            [
                'api.adm.game.deleate',
                [
                    'id' => 1
                ],
                Response::HTTP_UNAUTHORIZED,
                ['message'],
                false,
                false,
                false
            ],
            [
                'api.adm.game.deleate',
                [
                    'id' => 1,
                ],
                Response::HTTP_FORBIDDEN,
                ['message'],
                false,
                true,
                false
            ],
            [
                'api.adm.game.deleate',
                [
                    'id' => 1,
                ],
                Response::HTTP_OK,
                ['status'],
                true,
                false,
                true
            ],
        ];
    }

    private function createUser(): void
    {
        User::factory()->create([
            'email' => 'teste@teste.com',
            'password' => bcrypt('123456'),
            'is_admin' => false
        ]);

        User::factory()->create([
            'email' => 'admin@teste.com',
            'password' => bcrypt('123456'),
            'is_admin' => true
        ]);
    }

    private function loginUser(): void
    {
        $user = User::where('email', 'teste@teste.com')->first();

        $this->token = $user->createToken('role', ['update'])->plainTextToken;
    }

    private function loginAdminUser(): void
    {
        $user = User::where('email', 'admin@teste.com')->first();

        $this->tokenAdm = $user->createToken('role', ['delete'])->plainTextToken;
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
