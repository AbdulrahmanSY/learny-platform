<?php
namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class TimeDiffRule implements Rule
{
    protected $teacherId;
    protected $date;

    public function __construct($teacherId, $date)
    {
        $this->teacherId = $teacherId;
        $this->date = $date;
    }

    public function passes($attribute, $value): bool
    {
        $start = new \DateTime($value);
        $count = DB::table('appointments')
            ->where('teacher_id', $this->teacherId)
            ->where('date', $this->date)
            ->where(function ($query) use ($start) {
                $query->whereRaw('? BETWEEN DATE_SUB(time, INTERVAL 59 MINUTE) AND time', [$start->format('H:i:s')])
                    ->orWhereRaw('? BETWEEN time AND DATE_ADD(time, INTERVAL 59 MINUTE)', [$start->format('H:i:s')]);
            })
            ->count();

        return $count == 0;
    }
    public function message(): string
    {
        return 'There should be at least 1 hour difference between appointments.';
    }
}
