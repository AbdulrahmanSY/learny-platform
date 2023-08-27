<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\PeriodRequest;
use App\Http\Requests\UpdatePeriodRequest;
use App\Http\Resources\PeriodResource;
use App\Models\Period;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getPeriods(){
        try {
            return new PeriodResource(Period::all());
        }catch(\Exception $exception){
            return $this->error(errors: $exception->getMessage());
        }
    }
}
