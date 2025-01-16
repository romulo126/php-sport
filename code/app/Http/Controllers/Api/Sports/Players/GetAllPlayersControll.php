<?php

namespace App\Http\Controllers\Api\Sports\Players;

use App\Http\Controllers\Controller;
use App\Services\Sports\Players\Contracts\SportPlayersServiceContract;
use App\Http\Requests\Sports\GetAllRequest;
use App\Http\Resources\Api\Sports\Players\GetAllPlayersResource;
use Illuminate\Http\Response;

class GetAllPlayersControll extends Controller
{
    private SportPlayersServiceContract $sportPlayersService;

    public function __construct(SportPlayersServiceContract $sportPlayersService)
    {
        $this->sportPlayersService = $sportPlayersService;
    }

    public function __invoke(GetAllRequest $request)
    {
        $data = $request->validated();
        
        return response()->json(
            new GetAllPlayersResource($this->sportPlayersService->getPlayers($data['per_page'])),
            Response::HTTP_OK
        );
    }
}
