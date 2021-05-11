<?php

namespace App\Http\Controllers\API\FileManager;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\FileManager\FileManagerResource;
use App\Models\FileManager;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UpdateFileManagerController extends Controller
{
    public function update(Request $request, FileManager $file_manager)
    {
        $this->validate($request, [
            'status_project_id' => [
                'required',
                Rule::exists('params', 'id')->where(function ($query) {
                    return $query->where('category_param', 'status_project')->orWhere('category_param', 'gamas_status');
                })
            ],
            'hidden' => ['nullable', 'in:true,false'],
            'keterangan' => ['nullable', 'string'],
            'file' => ['nullable']
        ]);

        try {
            $inputFile = $request->all();
            if($request->file('file')) {
                $inputFile['file_name'] = $request->file_name;
                $path = $request->file('file')->store('file_manager', 'public');
                $inputFile['file_path'] = $path;
                Storage::disk('public')->delete($file_manager->file_path);
            }
    
            $file_manager->update($inputFile);
            return ResponseFormatter::success(
                new FileManagerResource($file_manager),
                'success edit file'
            );
        } catch (Exception $e) {
            return ResponseFormatter::error([
                'message' => $e->getMessage()
            ], 'success edit file', 500);
        }
    }

    public function image_mapping(Request $request, Project $project) 
    {
        $this->validate($request, [
            'image_mapping' => ['required', 'array'],
            'image_mapping.*.file_manager_id' => ['required', 'exists:file_managers,id'],
            'image_mapping.*.file_status' => ['required', 'in:after,before'],
        ]);

        $project->file_manager()->update([ 'file_status' => NULL ]);
        foreach ($request->image_mapping as $image_mapping) {
            $file_manager = FileManager::find($image_mapping['file_manager_id']);
            if($file_manager) {
                $update_file = [ 'file_status' => $image_mapping['file_status'] ];
                $file_manager->update($update_file);
            }
            $file_manager_id[] = $image_mapping['file_manager_id'];
        }
        $result = FileManager::whereIn('id', $file_manager_id)->get();
        return ResponseFormatter::success(
            FileManagerResource::collection($result),
            'success update file status in file manager'
        );

    }
}
