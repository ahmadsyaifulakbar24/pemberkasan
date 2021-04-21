<?php

namespace App\Http\Controllers\API\Omzetting;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\OmzettingResource;
use App\Models\Omzetting;
use App\Models\Project;

class GetOmzettingController extends Controller
{
    public function get(Omzetting $omzetting)
    {
        return ResponseFormatter::success(
            new OmzettingResource($omzetting),
            'success get data omzetting'
        );
    }

    public function by_id(Project $project)
    {
        return ResponseFormatter::success(
            OmzettingResource::collection($project->omzetting),
            'success get data omzetting'
        );
    }
}
