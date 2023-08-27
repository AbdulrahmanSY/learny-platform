<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $fillable=[
        'language_name',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    function categories(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Categories::class, 'language_id','id');
    }
    function post(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Post::class,'language_id','id');
    }
    public function questions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Questions::class);
    }

    function paragraph()
    {
        return $this->hasMany(Paragraph::class,'language_id','id');
    }
    public function teacher()
    {
        return $this->belongsToMany(Language::class,'teacher_languages' ,'teacher_id', 'language_id');
    }
}
