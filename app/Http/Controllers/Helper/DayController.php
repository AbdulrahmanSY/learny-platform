<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use App\Models\Day;
use Illuminate\Support\Facades\DB;

class DayController extends Controller
{
    public function getDays(){
        return $this->success(Day::all());
    }
}
