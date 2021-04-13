<?php

namespace App\Http\Resources\Param;

use Illuminate\Http\Resources\Json\JsonResource;

class StatusProjectResource extends JsonResource
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
            'status_project' => $this->param,
        ];
    }
}
