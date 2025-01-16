<?php

namespace Tests\Feature\Teams\Route;

use App\Models\User;
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
     * @dataProvider teamDataProvider
     */
    public function getTeamTest(string $nameRoute, int $status, array $expected, bool $creatTeam, bool $withAuthHeader): void
    {
        if ($creatTeam) {
            $team = $this->createTeam();
        }

        $headers = $withAuthHeader
            ? ['Authorization' => "Bearer {$this->token}"]
            : ['Authorization' => "Bearer invalid-token"];
        $headers['Accept'] = 'application/json';

        $response = $this->withHeaders($headers)->get(route($nameRoute, 1));

        $response->assertStatus($status);
        $response->assertJsonStructure($expected);
    }

    public static function teamDataProvider(): array
    {
        return [
            [
                'api.team.get',
                Response::HTTP_UNAUTHORIZED,
                ['message'],
                false,
                false
            ],
            [
                'api.team.get',
                Response::HTTP_OK,
                [],
                false,
                true
            ],
            [
                'api.team.get',
                Response::HTTP_OK,
                [
                    'data',
                    'data' => [
                        'id',
                        'conference',
                        'division',
                        'city',
                        'name',
                        'full_name',
                        'abbreviation'
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
}
