<?php

namespace App\Http\Controllers\API\Omzetting;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\OmzettingResource;
use App\Models\Project;

class GetOmzettingController extends Controller
{
    public function __invoke(Project $project)
    {
        return ResponseFormatter::success(
            OmzettingResource::collection($project->omzetting),
            'success get data omzetting'
        );
    }
}
