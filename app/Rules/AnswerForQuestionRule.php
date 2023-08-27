<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AnswerForQuestionRule implements Rule
{
    public $questionId;

    public function __construct($questionId)
    {
        $this->questionId = $questionId;
    }
    public function passes($attribute, $value)
    {
        // validate logic here
        return DB::table('answers')
            ->where('id', $value)
            ->where('question_id', $this->questionId)
            ->exists();
    }
    public function message()
    {
        return 'The answer does not exist for this question.';
    }

}
