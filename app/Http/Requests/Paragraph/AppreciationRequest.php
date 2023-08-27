<?php

namespace App\Http\Requests\Paragraph;

use App\Traits\ApiResponderTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class AppreciationRequest extends FormRequest
{
    use ApiResponderTrait;

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'paragraph_id' => ['required', Rule::exists('paragraphs', 'id')],
            'appreciation' => ['required'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        throw new HttpResponseException($this->badRequestResponse('Bad input', $errors));
    }
}
