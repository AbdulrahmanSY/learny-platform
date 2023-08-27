<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageHoursResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'number_of_hours' => $this->number_of_hours,
            'discount' => $this->discount,
            'price' => $this->price,
            'price after discount' => $this->priceAD,

        ];
    }
}
