<?php

namespace App\Http\Controllers\API\FileManager;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\FileManager\FileManagerResource;
use App\Models\FileManager;
use App\Models\Project;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GetFileManagerController extends Controller
{
    public function get(FileManager $file_manager) 
    {
        return ResponseFormatter::success(
            new FileManagerResource($file_manager),
            'succes get file'
        );
    }
    public function by_project(Request $request, Project $project)
    {
        $this->validate($request, [
            'status_project_id' => [
                'nullable',
                Rule::exists('params', 'id')->where(function ($query) {
                    return $query->where('category_param', 'status_project');
                })
            ],
        ]);

        $file_manager = $project->file_manager();
        if($request->status_project_id) {
            $file_manager->where('status_project_id', $request->status_project_id);
        }

        return ResponseFormatter::success(
            FileManagerResource::collection($file_manager->get()),
            'succes get all file'
        );
    }
}
