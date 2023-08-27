<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParagraphCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_en',
        'type_ar',
    ];

    function paragraphs()
    {
            return $this->hasMany(Paragraph::class,'paragraph_category_id','id');
    }


    function get()
    {
        $locale = app()->getLocale();
        if ($locale == 'ar') {
            return $this->type_ar;
        } else {
            return $this->type_en;
        }
    }
}
