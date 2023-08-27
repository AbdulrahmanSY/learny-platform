<?php

namespace App\Http\Resources;

use App\Models\TeacherStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public mixed $availableTimes = null;
    public function __construct($resource,$availableTimes = null)
    {
        parent::__construct($resource);
        $this->availableTimes = $availableTimes;
    }

    public function toArray(Request $request): array
    {
        $data = [
            'teacher_id' => $this->id,
            'status' => $this->status->status_name,
            'rating' => $this->rating,
            'user_info' => new UserResource($this->user),
            'languages' => TeacherLanguageResource::collection($this->whenLoaded('languages')),
            'info' => new TeacherInfoResource($this->whenLoaded('info')),
            'cardId' => new CardIdResource($this->whenLoaded('cardId')),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
            'working_days' => WorkingDayResource::collection($this->whenLoaded('workingDays')),

        ];
        if (!is_int($this->availableTimes)){
            $data['available_times'] = $this->availableTimes;
        }
        return $data;
    }
}
