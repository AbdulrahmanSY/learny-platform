<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable=[
        'country_name',
    ];
    public $timestamps = false;

    function doners(){
        return $this->hasMany(Doner::class);
    }
}
