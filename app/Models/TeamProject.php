<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamProject extends Model
{
    use HasFactory;

    protected $table = 'team_projects';
    protected $fillable = [
        'parent_user_id',
        'team_id',
        'project_id',
    ];

    public function parent_user()
    {
        return $this->belongsTo(User::class, 'parent_user_id');
    }

    public function team()
    {
        return $this->belongsTo(User::class, 'team_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
