<?php

namespace App\Http\Controllers\API\Project;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\TeamProject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GetProjectController extends Controller
{
    public function get($project_id = NULL)
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

    public function by_leader(Request $request)
    {
        $this->validate($request, [
            'user_leader_id' => [
                'required',
                Rule::exists('users', 'id')->where(function ($query) {
                    return $query->where('role_id', '202');
                })
            ],
            'limit' => ['nullable', 'numeric'],
         ]);

        $team_project = TeamProject::where('team_id', $request->user_leader_id)->pluck('project_id');

        $limit = $request->input('limit', 15);
        $project = Project::whereIn('id', $team_project)->paginate($limit);
        return ProjectResource::collection($project);
    }


}
