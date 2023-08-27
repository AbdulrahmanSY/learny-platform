<?php

namespace App\Http\Requests\Teacher;

use App\Rules\MinuteIntevalRule;
use App\Rules\MultipleWokringDayRule;
use App\Rules\MultipleWorkingTimeRule;
use App\Traits\ApiResponderTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class WorkingTimeRequest extends FormRequest
{
    use ApiResponderTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole('teacher');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'working_days' => ['required', new MultipleWokringDayRule(), Rule::unique('working_days','day_id')->where(function ($query) {
                return $query->where('teacher_id', auth()->user()->teacher->id);
            })],
            'working_days.*.working_times' => ['required', new MultipleWorkingTimeRule()],
            'working_days.*.day_id' => ['required', Rule::in([1, 2, 3, 4, 5, 6, 7])],
            'working_days.*.working_times.*.first' => ['required','date_format:H:i','max:5', new MinuteIntevalRule()],
            'working_days.*.working_times.*.end' => ['required','date_format:H:i','max:5','after:working_days.*.working_times.*.first', new MinuteIntevalRule()]

        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        throw new HttpResponseException($this->badRequestResponse('Bad input', $errors));
    }
}
