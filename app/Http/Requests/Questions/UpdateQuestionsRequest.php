<?php

namespace App\Http\Requests\Questions;

use App\Traits\ApiResponderTrait;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateQuestionsRequest extends FormRequest
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
            'id'=>['required',
                Rule::exists('questions','id')
            ],
            'question' => ['string','max:255'],
            'content_levels_id' => [
                Rule::exists('content_levels','id')
            ],
            'explanation' => ['string'],
            'category_id' => ['required','integer',
                Rule::exists('categories','id')
            ],
            'answers' => ['array','max:4'],
            'answers.*.answer' => ['required','max:255'],
            'answers.*.correct' => ['required','boolean'],
        ];
    }
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        throw new HttpResponseException($this->badRequestResponse('Bad input',$errors));
    }
}
