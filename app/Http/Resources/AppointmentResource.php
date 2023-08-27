<?php

namespace App\Http\Resources;

use App\Models\AppointmentStatus;
use App\Models\File;
use App\Models\Goal;
use App\Models\Language;
use App\Models\Level;
use App\Models\Period;
use App\Models\Teacher;
use App\Models\User;
use App\Traits\ApiResponderTrait;
use Carbon\Carbon;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    use ApiResponderTrait;
    /**
     * Transform the resource into an array.
     *
     * @return array
     */
    public function toArray(Request $request)
    {
        $data = [
            'id' => $this->id,
            'date' => $this->date,
            'time' => Carbon::parse($this->time)->format('H:i'),
            'description' => $this->description,
            'appointment_status' => $this->appointmentStatus->status,
            'teacher' => new TeacherResource($this->whenLoaded('teacher')),
            'student' => new UserResource($this->whenLoaded('user')),
            'files' => FileResource::collection($this->whenLoaded('files')),
            'student_goal' => new GoalResource($this->whenLoaded('goal')),
            'student_level' => new LevelResources($this->whenLoaded('level')),
            'language'=>$this->language->language_name,
            'period' => new PeriodResource($this->whenLoaded('period')),
        ];
        return $data;

    }
}
