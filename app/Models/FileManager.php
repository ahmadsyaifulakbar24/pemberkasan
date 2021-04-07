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
        'type_file_id',
        'file_path',
        'keterangan'
    ];
    
}
