<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'certificate_date',
        'certificate_image',
        'doner_id',
        'teacher_language_id',
        'certificate_type_id'
    ];

    function doner()
    {
        return $this->belongsTo(Doner::class, 'doner_id');
    }

    function teacherLanguage()
    {
        return $this->belongsTo(TeacherLanguage::class, 'teacher_language_id');
    }
}
