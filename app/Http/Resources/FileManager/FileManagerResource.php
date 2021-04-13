<?php

namespace App\Http\Resources\FileManager;

use App\Http\Resources\Param\StatusProjectResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FileManagerResource extends JsonResource
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
            'status_project' => new StatusProjectResource($this->status_project),
            'type_file' => $this->type_file,
            'file_name' => $this->file_name,
            'keterangan' => $this->keterangan,
            'file_path' => $this->file_path,
        ];
    }
}
