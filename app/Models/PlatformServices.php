<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformServices extends Model
{
    use HasFactory;
    protected $table ='platform_services';
    protected $fillable = ['service_ar','service_en'];

    public function get()
    {
        $locale = app()->getLocale();
        if ($locale == 'ar') {
            return $this->service_ar;
        } else {
            return $this->service_en;
        }
    }
}
