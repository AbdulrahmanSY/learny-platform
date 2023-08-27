<?php

namespace App\Http\Requests\Auth;

use App\Traits\ApiResponderTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    use ApiResponderTrait;
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required','max:20'],
            'last_name' => ['required', 'max:20'],
            'gender' => ['required',Rule::in(['1','female'])],
            'email' => ['required', 'max:50','email','unique:users'],
            'birth_date' => ['required', 'date_format:Y-m-d'],
            'phone_number'=>['required','max:20'],
            'password' => ['required','min:4','confirmed'],
            'nationality_id'=>['required']
        ];
    }
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();

        throw new HttpResponseException($this->badRequestResponse('Bad input',$errors));
    }
}
