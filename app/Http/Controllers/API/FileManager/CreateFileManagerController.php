<?php

namespace App\Http\Controllers\API\FileManager;

use App\Http\Controllers\Controller;
use App\Models\FileManager;
use App\Models\Project;
use Illuminate\Http\Request;

class CreateFileManagerController extends Controller
{
    public function __invoke(Request $request, Project $project)
    {
        $this->validate($request, [
            'type_file' => ['nullable', 'in:after,before'],
            'file_name' => ['required', 'string'],
            'keterangan' => ['nullable', 'string'],
            'file' => ['required', 'mimes:pdf,xlx,xls,jpg,png,jpeg']
        ]);

        $inputFile = $request->all();
        $inputFile['status_project_id'] = $project->status_id;
        $inputFile['file_name'] = $request->file_name.'.'.$request->file('file')->extension();
        if($request->file('file')) {
            $path = $request->file('file')->store('file_manager', 'public');
            $inputFile['file_path'] = $path;
        }

        return $project->file_manager()->create($inputFile);
    }
}
