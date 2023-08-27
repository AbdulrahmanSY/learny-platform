<?php

namespace App\Http\Requests\Appointment;

use App\Models\Teacher;
use App\Rules\AvailableDateTimeRule;
use App\Rules\TimeDiffRule;
use App\Services\TeacherService;
use App\Traits\ApiResponderTrait;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateApointmentRequest extends FormRequest
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
//        dd($this->input('id'),1);
        $rules = [
            'id' => ['required','integer',Rule::exists('appointments','id')],
            'period_id' => ['integer', Rule::exists('Periods', 'id')],
            'level_id' => ['integer', Rule::exists('Levels', 'id')],
            'goal_id' => ['integer', Rule::exists('Goals', 'id')],
            'date' => ['date_format:Y-m-d', 'after_or_equal:today',],
            'description' => ['string'],
            'files' => ['array'],
            'teacher_id' => ['required','integer', Rule::exists('Teachers', 'id')],
            'time' => ['date_format:H:i',
                (new AvailableDateTimeRule($this->input('teacher_id'),$this->input('date'))),
                Rule::unique('appointments')
                    ->where(function ($query) {
                        return $query->where([
                            'date' => $this->input('date'),
                            'teacher_id' => $this->input('teacher_id')
                        ]);
                    })
                ],
        ];

        return $rules;
    }
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        throw new HttpResponseException($this->badRequestResponse('Bad input', $errors));
    }

}
