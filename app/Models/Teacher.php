<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_info_id',
        'teacher_status_id',
        'rating',
        'user_id',
    ];
    protected $hidden = [
        'updated_at'
    ];

    public function info(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(TeacherInfo::class, 'teacher_id', 'id');
    }

    public function cardId(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CardID::class, 'teacher_id', 'id');
    }

    public function languages()
    {
        return $this->hasMany(TeacherLanguage::class, 'teacher_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(TeacherStatus::class, 'teacher_status_id');
    }

    public function workingDays()
    {
        return $this->hasMany(WorkingDay::class, 'teacher_id', 'id');
    }

    public function updateStatus($status)
    {
        $this->update([
            'teacher_status_id' => $status,
        ]);;
    }

    function appointments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Appointment::class, 'teacher_id', 'id');
    }


    public function scopeLanguageFilter(Builder $query, $languages)
    {
        $query->whereHas('languages', function ($q) use ($languages) {
            $q->whereIn('language_id', explode(',', $languages));
        });
    }

    public function scopeTeacherStatuses(Builder $query, $statuses)
    {
        return $query->whereIn('teacher_status_id', $statuses);
    }

    function questions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Questions::class, 'teacher_id', 'id');
    }

    function post(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Post::class, 'teacher_id', 'id');
    }

    function paragraph()
    {
        return $this->hasMany(Paragraph::class, 'teacher_id', 'id');
    }

    function follower(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Teacher::class,'follow','user_id','teacher_id');
    }

    public function mylanguages()
    {
        return $this->belongsToMany(Language::class,'teacher_languages' ,'teacher_id', 'language_id');
    }
    function wallet(){
        return $this->hasMany(TeacherWallet::class,'teacher_id','id');
    }
}
