<?php

namespace App\Http\Controllers\Api\Sports\Adm\Teams;

use App\Http\Controllers\Controller;
use App\Services\Sports\Teams\Contracts\SportTeamsServiceContract;
use App\Http\Resources\Api\Sports\DefaulStatusResource;
use Illuminate\Http\Response;

class DeleateControll extends Controller
{
    private SportTeamsServiceContract $sportTeamsService;

    public function __construct(SportTeamsServiceContract $sportTeamsService)
    {
        $this->sportTeamsService = $sportTeamsService;
    }

    public function __invoke(int $id)
    {
        return response()->json(
            new DefaulStatusResource($this->sportTeamsService->deleteTeam($id)),
            Response::HTTP_OK
        );
    }
}
