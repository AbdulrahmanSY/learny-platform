<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'channel_name'=>$this->channel_name,
            'token'=>$this->token,
            'points'=>$this->points,
            'appointment'=>new AppointmentResource($this->whenLoaded('appointment'))
        ];
    }
}
