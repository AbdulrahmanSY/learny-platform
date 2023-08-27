<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherLanguage extends Model
{
    use HasFactory;
    protected $fillable=[
        'teacher_id',
        'language_id',
        'language_level_id',
        'years_of_experience',
    ];

    function certificates(){
        return $this->hasMany(Certificate::class,);
    }

    function language(){
        return $this->hasMany(Language::class,'language_id');
    }
    function languageLevel(){
        return $this->belongsTo(Level::class,'language_level_id');
    }
}

