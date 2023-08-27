<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use phpseclib3\Crypt\AES;

class Appointment extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    protected $fillable =
        [
            "status_id",
            "period_id",
            "user_id",
            "teacher_id",
            "level_id",
            "goal_id",
            "date",
            "time",
            "description",
            'language_id'
        ];

    public function scopeAppointmentFilter(Builder $query, array $statusIds)
    {
        return $query->where(function ($q) use ($statusIds) {
            $q->whereHas('appointmentStatus', function ($q) use ($statusIds) {
                $q->whereIn('id', $statusIds);
            });
        });
    }

    function appointmentStatus(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AppointmentStatus::class, 'status_id');
    }

    function Period(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Period::class, 'period_id');
    }

    function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    function teacher(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teacher_id')->with('user');
    }

    function level(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    function goal(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Goal::class, 'goal_id');
    }

    function files(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(File::class, 'appointment_id', 'id');
    }

    function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    function session()
    {
        return $this->hasOne(Session::class,'appointment_id');
    }
}
