<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MultipleWokringDayRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $days = [];
        foreach ($value as $item){
            array_push($days,$item['day_id']);
        }
        $uniqueDays = array_unique($days);
        if (count($days)!= count($uniqueDays)){
            $fail(trans('validation.custom.day.duplicated'));
        }

    }
}
