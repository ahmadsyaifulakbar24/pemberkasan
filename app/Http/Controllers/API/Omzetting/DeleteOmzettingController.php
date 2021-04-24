<?php

namespace App\Http\Controllers\API\Omzetting;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Omzetting;
use Illuminate\Http\Request;

class DeleteOmzettingController extends Controller
{
    public function __invoke(Omzetting $omzetting)
    {
        $result = $omzetting->delete();
        return ResponseFormatter::success(
            $result,
            'success delete omzetting',
        );
    }
}
