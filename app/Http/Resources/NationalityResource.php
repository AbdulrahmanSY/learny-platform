<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NationalityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'nationality_id'=>$this->id,
            'name'=>$this->nationality_name,
            'users'=>UserResource::collection($this->whenLoaded('users'))
        ];
    }
}
