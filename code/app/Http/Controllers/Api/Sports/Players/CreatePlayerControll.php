<?php

namespace App\Http\Controllers\Api\Sports\Players;

use App\Http\Controllers\Controller;
use App\Services\Sports\Players\Contracts\SportPlayersServiceContract;
use App\Http\Resources\Api\Sports\Players\GetPlayerResource;
use Illuminate\Http\Response;
use App\Http\Requests\Sports\Players\CreateRequest;

class CreatePlayerControll extends Controller
{
    private SportPlayersServiceContract $sportPlayersService;

    public function __construct(SportPlayersServiceContract $sportPlayersService)
    {
        $this->sportPlayersService = $sportPlayersService;
    }

    public function __invoke(CreateRequest $request)
    {   
        $data = $request->validated();
        
        return response()->json(
            new GetPlayerResource($this->sportPlayersService->createPlayer($data)),
            Response::HTTP_OK
        );
    }
}
