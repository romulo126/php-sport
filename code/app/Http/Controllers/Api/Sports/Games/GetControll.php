<?php

namespace App\Http\Controllers\Api\Sports\Games;

use App\Http\Controllers\Controller;
use App\Services\Sports\Games\Contracts\SportGamesServiceContract;
use App\Http\Resources\Api\Sports\Games\GetResource;
use Illuminate\Http\Response;

class GetControll extends Controller
{
    private SportGamesServiceContract $sportGamesService;

    public function __construct(SportGamesServiceContract $sportGamesService)
    {
        $this->sportGamesService = $sportGamesService;
    }

    public function __invoke(int $id)
    {   
        return response()->json(
            new GetResource($this->sportGamesService->getGame($id)),
            Response::HTTP_OK
        );
    }
}
