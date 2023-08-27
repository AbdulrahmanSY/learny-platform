<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userPost extends Model
{
    use HasFactory;

    protected $fillable= [
        'like',
        'view ',
        'post_id',
        'user_id',
    ];
}
