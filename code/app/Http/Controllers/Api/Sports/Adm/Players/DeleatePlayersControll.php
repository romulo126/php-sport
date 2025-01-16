<?php

namespace App\Http\Controllers\Api\Sports\Adm\Players;

use App\Http\Controllers\Controller;
use App\Services\Sports\Players\Contracts\SportPlayersServiceContract;
use App\Http\Resources\Api\Sports\DefaulStatusResource;
use Illuminate\Http\Response;

class DeleatePlayersControll extends Controller
{
    private SportPlayersServiceContract $sportPlayersService;

    public function __construct(SportPlayersServiceContract $sportPlayersService)
    {
        $this->sportPlayersService = $sportPlayersService;
    }

    public function __invoke(int $id)
    {
        return response()->json(
            new DefaulStatusResource($this->sportPlayersService->deletePlayer($id)),
            Response::HTTP_OK
        );
    }
}
