<?php

namespace App\Models;

// use Illuminate\Contracts\api\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'birth_date',
        'phone_number',
        'email',
        'password',
        'nationality_id'
    ];
    protected $hidden = [
        'password',
        'deleted_at',
        'nationality_id',
        'created_at',
        'updated_at'
    ];
    protected $casts = [
        'verified'=>'boolean'
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    function teacher(){
        return $this->hasOne(Teacher::class,'user_id');
    }
    function nationality(){
        return $this->belongsTo(Nationality::class);
    }
    function appointment(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Appointment::class);
    }
    function questions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Questions::class,'user_questions','user_id','question_id');
    }
    function paragraph(): BelongsToMany
    {
        return $this->belongsToMany(Paragraph::class,'user_paragraphs','user_id','paragraph_id');
    }

    function post(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Post::class,'user_posts','post_id');
    }

    function follow(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Teacher::class,'follow','user_id','teacher_id');
    }
}
