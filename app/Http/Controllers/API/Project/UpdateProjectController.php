<?php

namespace App\Http\Controllers\API\Project;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateProjectController extends Controller
{
    public function __invoke(Request $request, Project $project)
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

        if($project->status->order != 1) {
            return ResponseFormatter::error([
                'message' => "can't update this project"
            ], 'update project failed', 400);
        }

        $inputProject = $request->all();
        $project->update($inputProject);

        return ResponseFormatter::success(
            new ProjectResource($project),
            'success update project'
        );
    }
}
