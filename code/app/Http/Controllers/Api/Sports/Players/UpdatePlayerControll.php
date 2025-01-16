<?php

namespace App\Http\Controllers\Api\Sports\Players;

use App\Http\Controllers\Controller;
use App\Services\Sports\Players\Contracts\SportPlayersServiceContract;
use App\Http\Resources\Api\Sports\DefaulStatusResource;
use Illuminate\Http\Response;
use App\Http\Requests\Sports\Players\UpdateRequest;

class UpdatePlayerControll extends Controller
{
    private SportPlayersServiceContract $sportPlayersService;

    public function __construct(SportPlayersServiceContract $sportPlayersService)
    {
        $this->sportPlayersService = $sportPlayersService;
    }

    public function __invoke(int $id, UpdateRequest $request)
    {   
        $data = $request->validated();
        
        return response()->json(
            new DefaulStatusResource($this->sportPlayersService->updatePlayer($id, $data)),
            Response::HTTP_OK
        );
    }
}
