<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingDay extends Model
{
    use HasFactory;
    protected $fillable = [
        'day_id',
        'teacher_id'
    ];
    protected $hidden = [
        'updated_at',
        'created_at'
    ];
    public function workingTimes(){
        return $this->hasMany(WorkingTime::class , 'working_day_id');
    }

     public function getDayName($id){
        return trans('constants.days.'.$id);
    }
}
