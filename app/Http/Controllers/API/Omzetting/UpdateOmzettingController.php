<?php

namespace App\Http\Controllers\API\Omzetting;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\OmzettingResource;
use App\Models\InternetNumber;
use App\Models\Omzetting;
use Illuminate\Http\Request;

class UpdateOmzettingController extends Controller
{
    public function __invoke(Request $request, Omzetting $omzetting)
    {
        $this->validate($request, [
            'omzetting.*.internet_number' => ['required', 'string'],
            'id_valins' => ['required', 'string'],
            'label_odp' => ['required', 'string']
        ]);

        $internet_number = $request->omzetting;
        $old_internet_number = $omzetting->internet_number()->pluck('internet_number','id')->toArray();
        
        // create internet number
        $create_internet_number = array_keys(array_diff_key($internet_number, $old_internet_number));
        if($create_internet_number) {
            foreach ($create_internet_number as $key) {
                $new_create_internet_number = [
                    'internet_number' => $internet_number[$key]['internet_number'],
                ];
                $new_create_internet_numbers[] = $new_create_internet_number;
            }
            $omzetting->internet_number()->createMany($new_create_internet_numbers);
        }

        // update internet number
        $update_internet_number = array_keys(array_intersect_key($old_internet_number, $internet_number));
        if($update_internet_number) {
            foreach($update_internet_number as $key){
                InternetNumber::where('id', $key)->update([
                    'internet_number' => $internet_number[$key]['internet_number']
                ]);
            }
        }

        // delete internet number
        $delete_internet_number =  array_keys(array_diff_key($old_internet_number, $internet_number));
        if($delete_internet_number) {
            InternetNumber::whereIn('id', $delete_internet_number)->delete();
        }

        return ResponseFormatter::success(
            new OmzettingResource($omzetting),
            'success update message',
        );
    }
}
