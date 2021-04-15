<?php

namespace App\Http\Controllers\API\FileManager;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\FileManager\FileManagerResource;
use App\Models\FileManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UpdateFileManagerController extends Controller
{
    public function __invoke(Request $request, FileManager $file_manager)
    {
        $this->validate($request, [
            'status_project_id' => [
                'required',
                Rule::exists('params', 'id')->where(function ($query) {
                    return $query->where('category_param', 'status_project');
                })
            ],
            'type_file' => ['nullable', 'in:after,before'],
            'file_name' => ['required', 'string'],
            'keterangan' => ['nullable', 'string'],
            'file' => ['nullable', 'mimes:pdf,xlx,xls,jpg,png,jpeg']
        ]);

        $inputFile = $request->all();
        if($request->file('file')) {
            $inputFile['file_name'] = $request->file_name.'.'.$request->file('file')->extension();
            $path = $request->file('file')->store('file_manager', 'public');
            $inputFile['file_path'] = $path;
            Storage::disk('public')->delete($file_manager->file_path);
        }

        $file_manager->update($inputFile);
        return ResponseFormatter::success(
            new FileManagerResource($file_manager),
            'success edit file'
        );
    }
}