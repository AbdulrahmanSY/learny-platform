<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class TeacherStatus extends Model
{
    use HasFactory;
    protected $fillable=[
        'status_name',
    ];
    public function teacher(){
        return $this->hasOne(Teacher::class);
    }
}
