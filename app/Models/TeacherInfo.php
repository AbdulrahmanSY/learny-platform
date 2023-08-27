<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherInfo extends Model
{
    use HasFactory;
    protected $fillable=[
        'about',
        'teaching_description',
        'video',
        'user_id',
    ];
    function teacher(){
        return $this->hasOne(Teacher::class,);
    }
}
