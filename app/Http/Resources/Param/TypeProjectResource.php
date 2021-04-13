<?php

namespace App\Http\Resources\Param;

use Illuminate\Http\Resources\Json\JsonResource;

class TypeProjectResource extends JsonResource
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
            'id' => $this->id,
            'type_project' => $this->param,
        ];
    }
}
