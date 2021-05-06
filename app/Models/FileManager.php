<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FileManager extends Model
{
    use HasFactory;

    protected $table = 'file_managers';
    protected $fillable = [
        'project_id',
        'status_project_id',
        'file_status',
        'file_type',
        'file_name',
        'file_path',
        'keterangan'
    ];
    

    protected $appends = [
        'file_url'
    ];

    public function getFileUrlAttribute()
    {
        return url('') . Storage::url($this->attributes['file_path']);
    }
    public function status_project()
    {
        return $this->belongsTo(Param::class, 'status_project_id');
    }
}
