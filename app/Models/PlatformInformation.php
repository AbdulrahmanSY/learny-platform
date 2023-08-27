<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_us_ar',
        'about_us_en',
        'terms_of_service_ar',
        'terms_of_service_en'
    ];

    public function get()
    {
        $locale = app()->getLocale();
        if ($locale == 'ar') {
            return [
                $this->about_us_ar,
                $this->terms_of_service_ar,
                ];
        } else {
            return [
                $this->about_us_en,
                $this->terms_of_service_en
            ];
        }
    }
}
