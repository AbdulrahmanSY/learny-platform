<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardID extends Model
{
    use HasFactory;
    protected $table="card_ids";
    protected $fillable=[
        'national_number',
        'front_card_image',
        'back_card_image',
        'teacher_id',
    ];
    function teacher(){
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
}
