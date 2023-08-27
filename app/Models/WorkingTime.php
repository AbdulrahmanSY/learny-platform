<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingTime extends Model
{
    use HasFactory;
    protected $casts = [
        'first'=>'datetime:H:i',
        'end'=>'datetime:H:i',
    ];
    protected $fillable = [
        'first',
        'end',
        'working_day_id',
    ];
    protected $hidden = [
        'updated_at',
        'created_at'
    ];
}
