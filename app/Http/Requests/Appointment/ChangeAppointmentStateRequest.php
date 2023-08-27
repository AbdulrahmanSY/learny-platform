<?php

namespace App\Http\Requests\Appointment;

use App\Models\Appointment;
use App\Models\Teacher;
use App\Traits\ApiResponderTrait;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ChangeAppointmentStateRequest extends FormRequest
{
    use ApiResponderTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $appointment = Appointment::all()
            ->where('teacher_id', auth()->user()->teacher->id)
            ->find(request('appointment_id'));
        if ($appointment)
            return true;
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'status_id' => ['required', 'integer', Rule::exists('appointment_statuses', 'id'),],
            'appointment_id' => ['required', 'integer', Rule::exists('appointments', 'id'),],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        throw new HttpResponseException($this->badRequestResponse('Bad input', $errors));
    }
    protected function failedAuthorization()
    {
        throw new HttpResponseException($this->unauthorizedResponse(errors: "You don't have authorized"));
    }
}
