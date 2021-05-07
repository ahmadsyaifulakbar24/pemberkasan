<?php

namespace App\Http\Controllers\API\FileManager;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\FileManager\FileManagerResource;
use App\Models\FileManager;
use App\Models\Project;
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

    public function image_by_project(Request $request, Project $project)
    {
        $this->validate($request, [
            'file_status' => ['nullable', 'in:after,before']
        ]);
        $file_manager = FileManager::query();
        if($request->file_status) {
            $file_manager->where('file_status', $request->file_status);
        }
        $file_manager->where([['project_id', $project->id], ['file_type', 'image']]);
        return ResponseFormatter::success(
            FileManagerResource::collection($file_manager->get()),
            'success get image file manager'
        );
    }
}
