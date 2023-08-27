<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userParagraphs extends Model
{
    use HasFactory;

    protected $fillable= [
        'Appreciation',
        'user_id',
        'paragraph_id',
    ];
}

