<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Users\LoginRequest;
use App\Services\Users\Contracts\UserServiceContract;
use Illuminate\Http\Response;


class LoginController extends Controller
{
    private UserServiceContract $userService;

    public function __construct(UserServiceContract $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(LoginRequest $request)
    {
        $data = $request->validated();

        $token = $this->userService->login($data);

        if ($token) {
            return response()->json(
                [
                    'token' => $token,
                ],
                Response::HTTP_OK
            );
        }

        return response()->json(
            [
                'message' => 'Not Autorized',
            ],
            Response::HTTP_FORBIDDEN
        );
    }
}
