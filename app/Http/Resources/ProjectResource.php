<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'name' => $this->name,
            'keterangan' => $this->keterangan,
            'type' => $this->type->param,
            'status' => $this->status->param,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
