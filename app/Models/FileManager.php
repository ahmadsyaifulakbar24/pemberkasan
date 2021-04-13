<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileManager extends Model
{
    use HasFactory;

    protected $table = 'file_managers';
    protected $fillable = [
        'project_id',
        'status_project_id',
        'type_file',
        'file_name',
        'file_path',
        'keterangan'
    ];
    

    public function status_project()
    {
        return $this->belongsTo(Param::class, 'status_project_id');
    }
}
