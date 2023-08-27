<?php

namespace App\Http\Resources;

use App\Models\WorkingDay;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkingDayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'day_name'=>(new WorkingDay())->getDayName($this->day_id),
            'working_times'=> $this->workingTimes
        ];
    }
}
