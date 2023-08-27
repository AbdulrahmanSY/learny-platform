<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable=[
        'category_name',
        'description',
        'language_id',
    ];
    function language(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
    function question(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Questions::class, 'category_id','id');
    }
}
