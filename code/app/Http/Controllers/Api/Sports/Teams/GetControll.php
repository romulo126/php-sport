<?php

namespace App\Http\Controllers\Api\Sports\Teams;

use App\Http\Controllers\Controller;
use App\Services\Sports\Teams\Contracts\SportTeamsServiceContract;
use App\Http\Resources\Api\Sports\Teams\GetResource;
use Illuminate\Http\Response;

class GetControll extends Controller
{
    private SportTeamsServiceContract $sportTeamsService;

    public function __construct(SportTeamsServiceContract $sportTeamsService)
    {
        $this->sportTeamsService = $sportTeamsService;
    }

    public function __invoke(int $id)
    {   
        return response()->json(
            new GetResource($this->sportTeamsService->getTeam($id)),
            Response::HTTP_OK
        );
    }
}
