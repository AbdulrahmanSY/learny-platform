<?php

namespace App\Http\Requests\Teacher;

use App\Traits\ApiResponderTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class BeTeacherRequest extends FormRequest
{
    use ApiResponderTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole('student');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'info.first_name' => ['required', 'min:3',],
            'info.father_name' => ['required', 'min:3',],
            'info.last_name' => ['required', 'min:3',],
            'info.about' => ['required', 'min: 10', 'max:600'],
            'info.teaching_description' => ['required', 'min: 10', 'max:600'],
            'info.video' => ['required'],
            'card.national_number' => ['required', 'numeric', 'digits:11'],
            'card.front_card_image' => ['required',],
            'card.back_card_image' => ['required',],
            'languages'=>['required'],
            'languages.*.language_id' => ['required', 'numeric', 'exists:languages,id'],
            'languages.*.language_level_id' => ['required', 'numeric', 'exists:levels,id'],
            'languages.*.years_of_experience' => ['required', 'numeric'],
            'languages.*.certificates' => ['required'],
            'languages.*.certificates.*.certificate_image' => ['required',],
            'languages.*.certificates.*.certificate_date' => ['required', 'date_format:Y-m-d'],
            'languages.*.certificates.*.certificate_type_id' => ['required', 'numeric', 'exists:certificate_types,id'],
            'languages.*.certificates.*.doner' => ['required'],
            'languages.*.certificates.*.doner.doner_name' => ['required', 'max:255'],
            'languages.*.certificates.*.doner.doner_type_id' => ['required', 'max:255', 'numeric', 'exists:doner_types,id'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        throw new HttpResponseException($this->badRequestResponse(errors: $errors));
    }
}
