<?php

namespace App\Services\Users\Contracts;

interface UserServiceContract
{
    public function login(array $data) : ?string;
    public function logout (): void;
}