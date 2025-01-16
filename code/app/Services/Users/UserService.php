<?php

namespace App\Services\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\Users\Contracts\UserServiceContract;

class UserService implements UserServiceContract
{
    private User $user;
    private array $abilities = ['read', 'updade', 'store'];
    private string $token;

    public function login(array $data): ?string
    {
        if (! Auth::attempt($data)) {
            return false;
        }

        $this->user = Auth::user();

        $this->checkOtherAbilities();
        $this->creatToken();

        return $this->token;
    }

    public function logout(): void
    {
        $this->user = Auth::user();

        if ($this->user) {
            $token = $this->user->currentAccessToken();

            if ($token) {
                $token->delete();
            }
        }
    }

    private function checkOtherAbilities(): void
    {
        if ($this->user->isAdmin()) {
            $this->abilities[] = 'delete';
        }
    }

    private function creatToken(): void
    {
        $this->token = $this->user->createToken('role', $this->abilities)->plainTextToken;
    }
}
