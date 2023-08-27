<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePost extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    function post()
    {
        return $this->hasMany(Post::class,'type_id','id');
    }
}
