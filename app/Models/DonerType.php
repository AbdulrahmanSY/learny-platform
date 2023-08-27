<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonerType extends Model
{
    use HasFactory;
    protected $fillable=[
        'type_name',
    ];
    public $timestamps = false;
}
