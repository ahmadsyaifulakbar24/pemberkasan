<?php

namespace App\Http\Resources\TeamProject;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamProjectResource extends JsonResource
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
            'parent_user' => $this->parent_user,
            'team' => $this->team,
            'project' => $this->project,
        ];
    }
}
