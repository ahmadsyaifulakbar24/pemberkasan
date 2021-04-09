<?php

namespace App\Http\Controllers\API\Project;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Project;

class DeleteProjectController extends Controller
{
    public function __invoke(Project $project)
    {
        if($project->status->order != 1) {
            return ResponseFormatter::error([
                'message' => "can't delete this project"
            ], 'delete project failed', 400);
        }

        $delete = $project->delete();

        return ResponseFormatter::success(
            $delete,
            'success delete message'
        );
    }
}
