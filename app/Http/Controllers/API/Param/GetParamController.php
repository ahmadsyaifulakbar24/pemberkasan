<?php

namespace App\Http\Controllers\API\Param;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Param\StatusProjectResource;
use App\Http\Resources\Param\TypeProjectResource;
use App\Models\Param;

class GetParamController extends Controller
{
    public function status_project()
    {
        $param = Param::where([['category_param', 'status_project'], ['active', 1]])->orderBy('order', 'ASC')->get();
        return ResponseFormatter::success(
            StatusProjectResource::collection($param),
            'success get data status project'
        );   
    }

    public function type_project()
    {
        $param = Param::where([['category_param', 'type_project'], ['active', 1]])->orderBy('order', 'ASC')->get(); 
        return ResponseFormatter::success(
            TypeProjectResource::collection($param),
            'success get data type project'
        );
    }
}
