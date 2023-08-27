<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CardIdResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'card_id'=>$this->id,
            'national_number'=>$this->national_number,
            'front_card_image'=>url($this->front_card_image),
            'back_card_image'=>url($this->back_card_image),
        ];
    }
}
