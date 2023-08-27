<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'info_id'=>$this->id,
            'about'=>$this->about,
            'teaching_description'=>$this->teaching_description,
            'video'=>url($this->video)
        ];
    }
}
