<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userQuestion extends Model
{
    use HasFactory;

    protected $fillable= [
        'user_id',
        'question_id ',
        'Answer_id',
    ];
//    function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
//    {
//     return $this->belongsTo(User::class,'user_id','id');
//    }
//    function question(): \Illuminate\Database\Eloquent\Relations\BelongsTo
//    {
//        return $this->belongsTo(Questions::class,'question_id','id');
//    }

    function answer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Answers::class,'Answer_id','id');
    }
}
