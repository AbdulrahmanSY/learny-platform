<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer',
        'correct',
        'question_id',
    ];
    function question(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Questions::class, 'question_id','id');
    }
    function userQuestion(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(UserQuestion::class);
    }
}
