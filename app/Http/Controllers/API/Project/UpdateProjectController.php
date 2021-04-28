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
        ]);

        $inputProject = $request->all();
        $project->update($inputProject);

        return ResponseFormatter::success(
            new ProjectResource($project),
            'success update project'
        );
    }
}
