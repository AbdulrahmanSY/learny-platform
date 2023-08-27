<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'points',
        'channel_name',
        'token',
        'sent_mail'
    ];
    protected $hidden = [
        'sent_mail',
        'appointment_id'
    ];
    protected $casts = [
        'id' => 'string'
    ];
    public $timestamps = false;

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
