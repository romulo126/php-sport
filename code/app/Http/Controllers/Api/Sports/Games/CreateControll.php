<?php

namespace App\Http\Controllers\Api\Sports\Games;

use App\Http\Controllers\Controller;
use App\Services\Sports\Games\Contracts\SportGamesServiceContract;
use App\Http\Resources\Api\Sports\Games\GetResource;
use Illuminate\Http\Response;
use App\Http\Requests\Sports\Games\CreateRequest;

class CreateControll extends Controller
{
    private SportGamesServiceContract $sportGamesService;

    public function __construct(SportGamesServiceContract $sportGamesService)
    {
        $this->sportGamesService = $sportGamesService;
    }

    public function __invoke(CreateRequest $request)
    {   
        $data = $request->validated();
        
        return response()->json(
            new GetResource($this->sportGamesService->createGame($data)),
            Response::HTTP_OK
        );
    }
}
