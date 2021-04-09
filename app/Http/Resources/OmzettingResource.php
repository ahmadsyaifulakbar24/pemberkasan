<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OmzettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'project_id' => $this->project_id,
            'id_valins' => $this->id_valins,
            'label_odp' => $this->lable_odp,
            'internet_number' => $this->internet_number,
        ];
    }
}
