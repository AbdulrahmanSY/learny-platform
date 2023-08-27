<?php

namespace App\Http\Requests\Appointment;

use App\Traits\ApiResponderTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LevelRequest extends FormRequest
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
            'level_name'=>['required'],
            'level_description'=>['required'],
        ];
    }
    public function failedAuthorization()
    {
        throw new HttpResponseException($this->unauthorizedResponse(trans('auth.verified')));
    }
}
