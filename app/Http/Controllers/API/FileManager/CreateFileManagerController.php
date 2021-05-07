<?php

namespace App\Http\Controllers\API\FileManager;

use App\Helpers\FileHelpers;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\FileManager\FileManagerResource;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CreateFileManagerController extends Controller
{
    public function __invoke(Request $request, Project $project)
    {
        $this->validate($request, [
            'status_project_id' => [
                'required',
                Rule::exists('params', 'id')->where(function ($query) {
                    return $query->where('category_param', 'status_project')->orWhere('category_param', 'gamas_status');
                })
            ],
            'hidden' => ['nullable', 'in:true,false'],
            'file_name' => ['required', 'string'],
            'keterangan' => ['nullable', 'string'],
            'file' => ['required', 'file'],
        ]);

        try {
            $inputFile = $request->all();
            if($request->file('file')) {
                $extention = $request->file('file')->extension();
                if($extention == 'jpeg' || $extention == 'png' || $extention == 'jpg' || $extention == 'giv' || $extention == 'svg') {
                    $file_name = Str::random(40).'.'.$extention;
                    $path = FileHelpers::upload_image_resize($request->file('file'), $file_name);
                    $inputFile['file_type'] = 'image';
                    $inputFile['hidden'] = false;
                } else {
                    $path = $request->file('file')->store('file_manager', 'public');
                    $inputFile['file_type'] = 'document';
                }
                $inputFile['file_name'] = $request->file_name;
                $inputFile['file_path'] = $path;
            }
    
            $file_manager = $project->file_manager()->create($inputFile);
            return ResponseFormatter::success(
                new FileManagerResource($file_manager),
                'success upload file'
            );
        } catch (Exception $e) {
            return ResponseFormatter::error([
                'message' => $e->getMessage()
            ], 'success edit file', 500);
        }
    }
}
