<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentLevel extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'level_en',
            'level_ar',
        ];

    function question(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Questions::class, 'content_levels_id', 'id');
    }

    function paragraph()
    {
        return $this->hasMany(Paragraph::class, 'content_levels_id', 'id');
    }
    function post(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Post::class, 'content_levels_id', 'id');
    }

    public function getLevel()
    {
        $locale = app()->getLocale();
        if ($locale == 'ar') {
            return $this->level_ar;
        } else {
            return $this->level_en;
        }

    }
}
