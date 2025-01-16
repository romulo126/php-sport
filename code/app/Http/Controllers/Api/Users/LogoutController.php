<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Services\Users\Contracts\UserServiceContract;
use Illuminate\Http\Response;


class LogoutController extends Controller
{
    private UserServiceContract $userService;

    public function __construct(UserServiceContract $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke()
    {
        $this->userService->logout();

        return response()->json(
            [
                'message' => 'Logout',
            ],
            Response::HTTP_OK
        );
    }
}
