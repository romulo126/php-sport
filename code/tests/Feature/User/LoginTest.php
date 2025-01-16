<?php

namespace Tests\Feature\User;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    private string $route;

    public function setUp(): void
    {
        parent::setUp();
        $this->createUser();
        $this->route = route('api.login');
    }

    /**
     * @test
     *
     * @dataProvider loginDataProvider
     */
    public function loginTest(int $status, array $expected, array $credentials): void
    {
        $response = $this->postJson($this->route, $credentials);

        $response->assertStatus($status);
        $response->assertJsonStructure($expected);
    }

    public static function loginDataProvider(): array
    {
        return [
            [
                Response::HTTP_OK,
                ['token'],
                [
                    'email' => 'teste@teste.com',
                    'password' => '123456',
                ],
            ],
            [
                Response::HTTP_FORBIDDEN,
                ['message'],
                [
                    'email' => 'teste@teste.com',
                    'password' => '1234567',
                ],
            ],
            [
                Response::HTTP_UNPROCESSABLE_ENTITY,
                [
                    'message',
                    'errors',
                    'errors' => ['password']
                ],
                [
                    'email' => 'teste@teste.com',
                ],
            ],
            [
                Response::HTTP_UNPROCESSABLE_ENTITY,
                [
                    'message',
                    'errors',
                    'errors' => ['email']
                ],
                [
                    'password' => '1234567',
                ],
            ],
            [
                Response::HTTP_UNPROCESSABLE_ENTITY,
                [
                    'message',
                    'errors',
                    'errors' => [
                        'email',
                        'password'
                    ]
                ],
                [],
            ]
        ];
    }

    private function createUser(): void
    {
        User::factory()->create([
            'email' => 'teste@teste.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
