<?php

namespace App\Http\Controllers\API\Project;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Param;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;

class AcceptStatusProjectController extends Controller
{
    public function __invoke(Request $request, Project $project)
    {
        try {
            $project->history_project()->create([
                'user_id' => $request->user()->id,
                'status_id' => $project->status_id,
            ]);
    
            $next_status_order = $project->status->order + 1;
            $next_status_project = Param::where([['category_param', 'status_project'], ['order', $next_status_order]])->first();
            if(!$next_status_project) {
                return ResponseFormatter::error([
                    'message' => 'last status in project'
                ], 'accept status project failde', 400);
            }
    
            $project->update([
                'status_id' => $next_status_project->id
            ]);
    
            return ResponseFormatter::success(
                new ProjectResource(Project::find($project->id)),
                'success accept status project'
            );
        } catch (Exception $e) {
            return ResponseFormatter::error([
                'message' => 'someting went wrong',
                'error' => $e->getMessage(),
            ], 'accept status project failde', 500);
        }
    }
}
