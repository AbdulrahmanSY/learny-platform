<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MinuteIntevalRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            if (Carbon::parse($value)->format('H:i')){
                $minute = explode(':',$value)[1];
                if (!($minute === '00' || $minute === '30')){
                    $fail(trans('validation.custom.time.hour_or_half'));
                }
            }
        }catch (\Exception $exception){
            $fail(trans('validation.custom.wrong'));
        }
    }
}
