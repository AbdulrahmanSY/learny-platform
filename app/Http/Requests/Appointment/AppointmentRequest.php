<?php

namespace App\Http\Requests\Appointment;

use App\Models\Appointment;
use App\Models\Teacher;
use App\Rules\AvailableDateTimeRule;
use App\Rules\DateGreaterThanNowRule;
use App\Rules\TeacherLanguageRule;
use App\Rules\TimeDiffRule;
use App\Services\TeacherService;
use App\Traits\ApiResponderTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;


class AppointmentRequest extends FormRequest
{
    use ApiResponderTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {

        return [
            'language_id'=>['required','integer',new TeacherLanguageRule($this->input('teacher_id'))],
            'period_id' => ['required', 'integer',Rule::exists('periods', 'id'),],
            'level_id' => ['required', 'integer',Rule::exists('levels','id')],
            'goal_id' => ['required', 'integer',Rule::exists('goals','id')],
            'date' => ['required', 'date_format:Y-m-d', 'after_or_equal:today'],
            'description' => ['string'],
            'files' => ['array'],
            'teacher_id' => ['required', 'integer',Rule::exists('teachers', 'id'),
                Rule::unique('appointments')->where(function ($query) {
                return $query->where([
                    'date' => $this->input('date'),
                    'time' => $this->input('time')
                ]);
            })],
            'time' => ['required', 'date_format:H:i',
                Rule::unique('appointments')
                ->where(function ($query) {
                return $query->where([
                    'date' => $this->input('date'),
                    'teacher_id' => $this->input('teacher_id')
                ]);
            })
//                ,new TimeDiffRule($this->input('teacher_id'), $this->input('date'))
              , (new AvailableDateTimeRule($this->input('teacher_id'),$this->input('date')))
            ],

             'files.*.file' => ['mimes:jpeg,png,pdf'],
        ];

    }
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        throw new HttpResponseException($this->badRequestResponse('Bad input', $errors));
    }

}
