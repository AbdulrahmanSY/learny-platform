<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    use HasFactory;

    protected $fillable= [
        'question',
        'explanation',
        'category_id',
        'content_levels_id',
        'teacher_id',

    ];
    function answer(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Answers::class, 'question_id', 'id');
    }
    function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }
    function teacher(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }
    function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(user::class,'user_questions','user_id','question_id');
    }
    function language(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Language::class);
    }
    function contentLevel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ContentLevel::class, 'content_levels_id', 'id');
    }
}

