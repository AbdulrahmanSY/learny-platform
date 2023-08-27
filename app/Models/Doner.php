<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doner extends Model
{
    use HasFactory;
    protected $fillable=[
        'doner_name',
        'doner_type_id',
        'country_id',
    ];

    function certificates(){
        return $this->hasMany(Certificate::class);
    }
    function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
    function donerType(){
        return $this->belongsTo(DonerType::class,'doner_type_id');
    }
}
