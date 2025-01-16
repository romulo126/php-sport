<?php

namespace App\Http\Controllers\Api\Sports\Games;

use App\Http\Controllers\Controller;
use App\Services\Sports\Games\Contracts\SportGamesServiceContract;
use App\Http\Requests\Sports\GetAllRequest;
use App\Http\Resources\Api\Sports\Games\GetAllResource;
use Illuminate\Http\Response;

class GetAllControll extends Controller
{
    private SportGamesServiceContract $sportGamesService;

    public function __construct(SportGamesServiceContract $sportGamesService)
    {
        $this->sportGamesService = $sportGamesService;
    }

    public function __invoke(GetAllRequest $request)
    {
        $data = $request->validated();
        
        return response()->json(
            new GetAllResource($this->sportGamesService->getGames($data['per_page'])),
            Response::HTTP_OK
        );
    }
}
