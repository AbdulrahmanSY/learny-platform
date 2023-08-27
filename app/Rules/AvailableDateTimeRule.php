<?php

namespace App\Rules;

use App\Models\Teacher;
use App\Services\TeacherService;
use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class AvailableDateTimeRule implements Rule
{
    protected $available;
    protected $date;
    protected $teacher_id;

    public function __construct( $teacher_id,$date)
    {
        $teacherService = app(TeacherService::class);
        $this->available =$this->getAvailableDays($teacher_id, $teacherService);
        $this->date = $date;
    }

    public function passes($attribute, $value)
    {

        try {
            $selectedTime = Carbon::parse($value)->format('H:i');
            $availableTimes = $this->available[$this->date] ??[];
            return in_array($selectedTime, $availableTimes);
        }
        catch (\Exception $exception){
            return $exception;
        }
    }

    public function message()
    {
        return 'The selected date and time are not available for booking.';
    }

    protected function input($key)
    {
        return $this->data[$key] ?? null;
    }

    public function getAvailableDays($teacherId, TeacherService $teacherService): array
    {
        // Get available days for $teacherId

        $teacher = Teacher::with('workingDays')->find($teacherId);
        return $teacherService->getAvailableDays($teacher['workingDays'],$teacher->id);
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }
}
