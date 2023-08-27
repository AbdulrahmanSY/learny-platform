<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherWallet extends Model
{
    use HasFactory;

    protected $fillable = [

        'number_of_hours',
        'actual_of_hours',
        'price',
        'withdraw_money',
        'teacher_id'
    ];
    function teacher(){
        return $this->belongsTo(Teacher::class,'teacher_id','id');
    }
}
