<?php

namespace App\Http\Controllers\API\Project;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CreateProjectController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
            'keterangan' => ['required', 'string'],
            'type_id' => [
                'required',
                Rule::exists('params', 'id')->where(function ($query) {
                    return $query->where('category_param', 'type_project');
                }),
            ],
        ]);
        
        $status_id = ($request->type_id == 11) ? 15 : 1;
        $requestProject = $request->all();
        $requestProject['status_id'] = $status_id;
        $project = Project::create($requestProject);

        $historyProject['user_id'] = $request->user()->id;
        $historyProject['status_id'] = $project->status_id;
        $historyProject['type'] = 'create';
        $project->history_project()->create($historyProject);

        return ResponseFormatter::success(
            new ProjectResource($project),
            'success create project'
        );
    }
}
