<?php

namespace App\Http\Requests\Certificate;

use App\Traits\ApiResponderTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddDonerType extends FormRequest
{
    use ApiResponderTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'type_name'=>['required','unique:doner_types,type_name']
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();

        throw new HttpResponseException($this->badRequestResponse('Bad input',$errors));
    }
}
