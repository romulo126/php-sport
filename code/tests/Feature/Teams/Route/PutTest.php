<?php

namespace Tests\Feature\Teams\Route;

use App\Models\User;
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
     * @dataProvider teamDataProvider
     */
    public function updateTeamTest(string $nameRoute, array $playload, int $status, array $expected, bool $creatTeam, bool $withAuthHeader): void
    {
        if ($creatTeam) {
            $this->createTeam();
        }

        $headers = $withAuthHeader
            ? ['Authorization' => "Bearer {$this->token}"]
            : ['Authorization' => "Bearer invalid-token"];
        $headers['Accept'] = 'application/json';

        $response = $this->withHeaders($headers)->put(route($nameRoute, $playload));
        
        $response->assertStatus($status);
        $response->assertJsonStructure($expected);
    }

    public static function teamDataProvider(): array
    {
        return [
            [
                'api.team.update',
                [
                    'id' => 1
                ],
                Response::HTTP_UNAUTHORIZED,
                ['message'],
                false,
                false
            ],
            [
                'api.team.update',
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
                'api.team.update',
                [
                    'id' => 1,
                    'full_name' => '',
                    'name' => ''
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY,
                [
                    'message',
                    'errors',
                    'errors' => [
                        'full_name',
                        'name',
                    ]
                ],
                true,
                true
            ],
            [
                'api.team.update',
                [
                    'id' => 1,
                    'full_name' => 'ssss',
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
    }
}
