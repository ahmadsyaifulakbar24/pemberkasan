<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternetNumber extends Model
{
    use HasFactory;

    protected $table = 'internet_numbers';
    protected $fillable = [
        'omzetting_id',
        'internet_number',
    ];

    public function omzetting()
    {
        return $this->belongsTo(Omzetting::class, 'omzetting_id');
    }
}
