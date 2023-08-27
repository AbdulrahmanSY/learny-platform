<?php

namespace App\Rules;

use App\Models\Teacher;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TeacherLanguageRule implements ValidationRule
{
    protected $teacher_id ;
    public function __construct($teacher_id)
    {
        $this->teacher_id = $teacher_id;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        try {
            $teacher= Teacher::all()->where('id',$this->teacher_id)->first();
            if (!in_array($value,$teacher->languages->pluck('language_id')->toArray())){
                $fail("The teacher doesn't teach this language");
            };
        }catch(\Exception $exception){
            $fail($exception->getMessage());
        }
    }

}
