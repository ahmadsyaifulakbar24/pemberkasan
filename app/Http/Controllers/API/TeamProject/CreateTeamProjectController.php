<?php

namespace App\Http\Controllers\API\TeamProject;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\TeamProject\TeamProjectResource;
use App\Models\Project;
use App\Models\TeamProject;
use App\Models\User;
use Illuminate\Http\Request;

class CreateTeamProjectController extends Controller
{
    public function __invoke(Request $request, Project $project)
    {
        $this->validate($request, [
            'team_id' => ['required', 'exists:users,id'],
        ]);

        $user = User::find($request->user()->id);

        $team_project_cek = TeamProject::where([['team_id', $request->team_id], ['project_id', $project->id]])->count();
        if($team_project_cek > 0) {
            return ResponseFormatter::error([
                'message' => 'user already exists in this project'
            ], 'invite user failed', 404);
        }
        $inputTeam = $request->all();
        $inputTeam['parent_user_id'] = $user->id;
        $inputTeam['project_id'] = $project->id;

        $team_project = TeamProject::create($inputTeam);
        return ResponseFormatter::success(
            new TeamProjectResource($team_project),
            'success get data team project'
        );
    }
}
