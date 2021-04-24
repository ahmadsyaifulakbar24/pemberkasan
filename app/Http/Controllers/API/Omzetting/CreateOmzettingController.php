<?php

namespace App\Http\Controllers\API\Omzetting;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\OmzettingResource;
use App\Models\Project;
use Illuminate\Http\Request;

class CreateOmzettingController extends Controller
{
    public function __invoke(Request $request, Project $project)
    {
        $this->validate($request, [
            'omzetting.*.internet_number' => ['required', 'string'],
            'id_valins' => ['required', 'string'],
            'label_odp' => ['required', 'string']
        ]);

        $omzetting = $project->omzetting()->create([
            'id_valins' => $request->id_valins,
            'label_odp' => $request->label_odp
        ]);

        $omzetting->internet_number()->createMany($request->omzetting);

        return ResponseFormatter::success(
            new OmzettingResource($omzetting),
            'success create omzetting'
        );
    }
}
