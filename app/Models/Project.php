<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $fillable = [
        'name',
        'keterangan',
        'type_id',
        'status_id',
    ];

    public function getCreatedAtAttribute($value) 
    {
        return Carbon::parse($value)->timestamp;
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timestamp;
    }
    
    public function history_project()
    {
        return $this->hasMany(HistoryProject::class, 'project_id');
    }

    public function type()
    {
        return $this->belongsTo(Param::class, 'type_id');
    }

    public function status()
    {
        return $this->belongsTo(Param::class, 'status_id');
    }
}
