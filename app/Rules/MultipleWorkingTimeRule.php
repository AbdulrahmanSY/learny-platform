<?php

namespace App\Rules;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MultipleWorkingTimeRule implements ValidationRule
{


    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $times = [];
        foreach ($value as $item) {
            try {
                $start = Carbon::parse($item['first']);
                $end = Carbon::parse($item['end']);
                if ($start->format('i') == $end->format('i')) {

                    $interval = CarbonInterval::minutes(30);
                    $period = new CarbonPeriod($start, $interval, $end);

                    foreach ($period as $time) {
                        $times[] = $time->format('H:i');
                    }
                } else {
                    $fail(trans('validation.custom.time.full_hour'));
                }
            } catch (\Exception $exception) {
                $fail(trans('validation.date_format'));
            }

        }
        $uniqueTimes = array_unique($times);
        if (count($times) != count($uniqueTimes)) {
            $message = trans('validation.custom.time.duplicated');
            $fail($message);
        }
    }
}
