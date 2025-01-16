<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\Response;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    private string $route;
    private string $token;

    public function setUp(): void
    {
        parent::setUp();
        $this->createUser();
        $this->loginUser();
        $this->route = route('api.logout');
    }
    
    /**
     * @test
     *
     * @dataProvider logoutDataProvider
     */
    public function logoutTest(int $status, array $expected, bool $withAuthHeader): void
    {
        $headers = $withAuthHeader
            ? ['Authorization' => "Bearer {$this->token}"]
            : ['Authorization' => "Bearer invalid-token"];
        $headers['Accept'] = 'application/json';
        $response = $this->withHeaders($headers)->get($this->route);
        

        $response->assertStatus($status);
        $response->assertJsonStructure($expected);
    }

    public static function logoutDataProvider(): array
    {
        return [
            [
                Response::HTTP_UNAUTHORIZED,
                ['message'],
                false,
            ],
            [
                Response::HTTP_OK,
                ['message'],
                true,
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

    private function loginUser(): void
    {
        $user = User::where('email', 'teste@teste.com')->first();

        $this->token = $user->createToken('TestToken')->plainTextToken;
    }
}
