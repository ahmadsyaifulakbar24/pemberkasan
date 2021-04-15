<?php

namespace App\Http\Controllers\API\TeamProject;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\TeamProject\TeamProjectResource;
use App\Models\Project;
use App\Models\TeamProject;
use Illuminate\Http\Request;

class GetTeamProjectController extends Controller
{
    public function team_project(Project $project)
    {
        $team_project = TeamProject::where('project_id', $project->id)->get();
        return ResponseFormatter::success(
            TeamProjectResource::collection($team_project),
            'success get date team project'
        );
    }
}
