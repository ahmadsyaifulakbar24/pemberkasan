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
        'lable_odp',
    ];
}
