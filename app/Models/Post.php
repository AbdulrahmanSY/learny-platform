<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type_id',
        'description',
        'teacher_id',
        'content_levels_id',
        'language_id',
    ];

    function teacher(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Teacher::class,'teacher_id','id');
    }
    function language(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Language::class,'language_id','id');
    }
    function file(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FilesPost::class,'post_id','id');
    }

    function user(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class,'user_posts','post_id');
    }
    function type()
    {
        return $this->belongsTo(TypePost::class,'type_id','id');
    }
    function contentLevel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ContentLevel::class, 'content_levels_id', 'id');
    }
}
