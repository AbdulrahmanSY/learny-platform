<?php

namespace App\Http\Requests\Auth;

use App\Traits\ApiResponderTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CheckOtpRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'=>['required','email'],
            'code'=>['required']
        ];
    }
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();

        throw new HttpResponseException($this->badRequestResponse('Bad input',$errors));
    }
}
