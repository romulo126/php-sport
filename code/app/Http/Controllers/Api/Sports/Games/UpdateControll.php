<?php

namespace App\Http\Controllers\Api\Sports\Games;

use App\Http\Controllers\Controller;
use App\Services\Sports\Games\Contracts\SportGamesServiceContract;
use App\Http\Resources\Api\Sports\DefaulStatusResource;
use Illuminate\Http\Response;
use App\Http\Requests\Sports\Games\UpdateRequest;

class UpdateControll extends Controller
{
    private SportGamesServiceContract $sportTGamesService;

    public function __construct(SportGamesServiceContract $sportTGamesService)
    {
        $this->sportTGamesService = $sportTGamesService;
    }

    public function __invoke(int $id, UpdateRequest $request)
    {   
        $data = $request->validated();
        
        return response()->json(
            new DefaulStatusResource($this->sportTGamesService->updateGame($id, $data)),
            Response::HTTP_OK
        );
    }
}
