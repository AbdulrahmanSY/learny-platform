<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    use HasFactory;
    protected $fillable=[
        'language_id',
        'description',
        'section_name',
    ];
    function category(){
        return $this->hasMany(Categories::class);
    }
    function language(){
        return $this->belongsTo(Language::class);
    }
}
