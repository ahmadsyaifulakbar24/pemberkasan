<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class Param extends Model
{
    use HasFactory;

    protected $table = 'params';
    protected $fillable = [
        'parent_id',
        'category_param',
        'param',
        'order',
        'active',
    ];

    public function project_type()
    {
        return $this->hasMany(Project::class, 'type_id');
    }

    public function project_status()
    {
        return $this->hasMany(Project::class, 'status_id');
    }
}
