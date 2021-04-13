<?php

namespace App\Http\Resources\HistoryProject;

use App\Http\Resources\Param\StatusProjectResource;
use Illuminate\Http\Resources\Json\JsonResource;

class HistoryProjectResource extends JsonResource
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
            'project_id' => $this->project_id,
            'user_id' => $this->user_id,
            'status_project' => new StatusProjectResource($this->status_project),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
