<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Omzetting extends Model
{
    use HasFactory;

    protected $table = 'omzettings';
    protected $fillable = [
        'project_id',
        'id_valins',
        'label_odp',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function internet_number()
    {
        return $this->hasMany(InternetNumber::class, 'omzetting_id');
    }
}
