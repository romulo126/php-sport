<?php

namespace App\Http\Controllers\Api\Sports\Teams;

use App\Http\Controllers\Controller;
use App\Services\Sports\Teams\Contracts\SportTeamsServiceContract;
use App\Http\Resources\Api\Sports\DefaulStatusResource;
use Illuminate\Http\Response;
use App\Http\Requests\Sports\Teams\UpdateRequest;

class UpdateControll extends Controller
{
    private SportTeamsServiceContract $sportTeamsService;

    public function __construct(SportTeamsServiceContract $sportTeamsService)
    {
        $this->sportTeamsService = $sportTeamsService;
    }

    public function __invoke(int $id, UpdateRequest $request)
    {   
        $data = $request->validated();

        return response()->json(
            new DefaulStatusResource($this->sportTeamsService->updateTeam($id, $data)),
            Response::HTTP_OK
        );
    }
}
