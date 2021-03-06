<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryProject extends Model
{
    use HasFactory;

    protected $table = 'history_projects';
    protected $fillable = [
        'project_id',
        'user_id',
        'status_id',
        'type',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function status_project()
    {
        return $this->belongsTo(Param::class, 'status_id');
    }
}
