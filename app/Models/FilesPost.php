<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilesPost extends Model
{
    use HasFactory;

    protected $fillable = [

        'file',
        'post_id',
    ];
    function post(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Post::class,'post_id','id');
    }
}
