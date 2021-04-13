<?php

namespace App\Http\Controllers\API\HistoryProject;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\HistoryProject\HistoryProjectResource;
use App\Models\Project;

class GetHistoryProjectController extends Controller
{
    public function __invoke(Project $project)
    {
        return ResponseFormatter::success(
            HistoryProjectResource::collection($project->history_project),
            'success get history project'
        );
    }
}
