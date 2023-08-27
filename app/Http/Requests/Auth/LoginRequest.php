<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use App\Traits\ApiResponderTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
{
    use ApiResponderTrait;

    public function authorize()
    {

        if (User::where('email', request('email'))->where('verified', true)->exists()) {
            return true;
        }
        return false;

    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required',],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        throw new HttpResponseException($this->badRequestResponse('Bad input', $errors));
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->unauthorizedResponse(trans('auth.verified')));
    }
}
