<?php

namespace App\Http\Controllers\Api\Sports\Players;

use App\Http\Controllers\Controller;
use App\Services\Sports\Players\Contracts\SportPlayersServiceContract;
use App\Http\Resources\Api\Sports\Players\GetPlayerResource;
use Illuminate\Http\Response;

class GetPlayerControll extends Controller
{
    private SportPlayersServiceContract $sportPlayersService;

    public function __construct(SportPlayersServiceContract $sportPlayersService)
    {
        $this->sportPlayersService = $sportPlayersService;
    }

    public function __invoke(int $id)
    {   
        return response()->json(
            new GetPlayerResource($this->sportPlayersService->getPlayer($id)),
            Response::HTTP_OK
        );
    }
}
