<?php

namespace App\Http\Controllers\Api\Sports\Teams;

use App\Http\Controllers\Controller;
use App\Services\Sports\Teams\Contracts\SportTeamsServiceContract;
use App\Http\Requests\Sports\GetAllRequest;
use App\Http\Resources\Api\Sports\Teams\GetAllResource;
use Illuminate\Http\Response;

class GetAllControll extends Controller
{
    private SportTeamsServiceContract $sportTeamsService;

    public function __construct(SportTeamsServiceContract $sportTeamsService)
    {
        $this->sportTeamsService = $sportTeamsService;
    }

    public function __invoke(GetAllRequest $request)
    {
        $data = $request->validated();
        
        return response()->json(
            new GetAllResource($this->sportTeamsService->getTeams($data['per_page'])),
            Response::HTTP_OK
        );
    }
}
