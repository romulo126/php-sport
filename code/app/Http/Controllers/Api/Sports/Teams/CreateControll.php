<?php

namespace App\Http\Controllers\Api\Sports\Teams;

use App\Http\Controllers\Controller;
use App\Services\Sports\Teams\Contracts\SportTeamsServiceContract;
use App\Http\Resources\Api\Sports\Teams\GetResource;
use Illuminate\Http\Response;
use App\Http\Requests\Sports\Teams\CreateRequest;

class CreateControll extends Controller
{
    private SportTeamsServiceContract $sportTeamsService;

    public function __construct(SportTeamsServiceContract $sportTeamsService)
    {
        $this->sportTeamsService = $sportTeamsService;
    }

    public function __invoke(CreateRequest $request)
    {   
        $data = $request->validated();
        
        return response()->json(
            new GetResource($this->sportTeamsService->createTeam($data)),
            Response::HTTP_OK
        );
    }
}
