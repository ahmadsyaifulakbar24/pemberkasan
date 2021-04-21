<?php

namespace App\Http\Controllers\API\FileManager;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\FileManager\FileManagerResource;
use App\Models\FileManager;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'type_file' => ['nullable', 'in:after,before'],
            'file_name' => ['required', 'string'],
            'keterangan' => ['nullable', 'string'],
            'file' => ['required', 'mimes:pdf,xlsx,xls,doc,docx,jpg,png,jpeg']
        ]);

        $inputFile = $request->all();
        if($request->file('file')) {
            $inputFile['file_name'] = $request->file_name.'.'.$request->file('file')->extension();
            $path = $request->file('file')->store('file_manager', 'public');
            $inputFile['file_path'] = $path;
        }

        $file_manager = $project->file_manager()->create($inputFile);
        return ResponseFormatter::success(
            new FileManagerResource($file_manager),
            'success upload file'
        );
    }
}
