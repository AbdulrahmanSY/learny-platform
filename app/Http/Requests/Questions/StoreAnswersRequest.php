<?php

namespace App\Http\Requests\Questions;

use App\Rules\AnswerForQuestionRule;
use App\Traits\ApiResponderTrait;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StoreAnswersRequest extends FormRequest
{
    use ApiResponderTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'question_id' => ['required',
                Rule::exists('questions', 'id')
            ],
            'answer_id' => ['required', new AnswerForQuestionRule($this->question_id)]
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        throw new HttpResponseException($this->badRequestResponse('Bad input', $errors));
    }
}
