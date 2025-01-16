<?php

namespace App\Http\Controllers\Api\Sports\Adm\Games;

use App\Http\Controllers\Controller;
use App\Services\Sports\Games\Contracts\SportGamesServiceContract;
use App\Http\Resources\Api\Sports\DefaulStatusResource;
use Illuminate\Http\Response;

class DeleateControll extends Controller
{
    private SportGamesServiceContract $sportGamesService;

    public function __construct(SportGamesServiceContract $sportGamesService)
    {
        $this->sportGamesService = $sportGamesService;
    }

    public function __invoke(int $id)
    {
        return response()->json(
            new DefaulStatusResource($this->sportGamesService->deleteGame($id)),
            Response::HTTP_OK
        );
    }
}
