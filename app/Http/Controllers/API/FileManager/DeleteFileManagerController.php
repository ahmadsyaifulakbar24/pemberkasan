<?php

namespace App\Http\Controllers\API\FileManager;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\FileManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteFileManagerController extends Controller
{
    public function __invoke(FileManager $file_manager)
    {
        Storage::disk('public')->delete($file_manager->file_path);
        $result = $file_manager->delete();

        return ResponseFormatter::success(
            $result,
            'success delete file'
        );
    }
}
