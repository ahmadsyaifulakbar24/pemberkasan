<?php

namespace App\Http\Controllers\API\Project;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;

class GetProjectController extends Controller
{
    public function __invoke($project_id = NULL)
    {
        if(!$project_id) {
            $project = Project::orderBy('id', 'desc')->paginate(15);
            return ProjectResource::collection($project);
        }
        
        return ResponseFormatter::success(
            new ProjectResource(Project::find($project_id)),
            'success get project'
        );

    }


}
