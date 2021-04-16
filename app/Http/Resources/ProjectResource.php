<?php

namespace App\Http\Resources;

use App\Http\Resources\Param\StatusProjectResource;
use App\Http\Resources\Param\TypeProjectResource;
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
            'id' => $this->id,
            'name' => $this->name,
            'keterangan' => $this->keterangan,
            'type' => new TypeProjectResource($this->type),
            'status' => new StatusProjectResource($this->status),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
