<?php

namespace App\Http\Controllers\API\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
            'keterangan' => ['required', 'string'],
            'type_id' => [
                'required',
                Rule::exists('params', 'id')->where(function ($query) {
                    return $query->where('category_param', 'type_project');
                }),
            ],
        ]);

        
    }
}
