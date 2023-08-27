<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
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
            'file_path' =>url('/storage/session_file/Y42rctEUj7wETF74k4HNjS0tI07SIzEVU2tp7BmxDmqZ54D5RSHb2cEZlZiY.png'),
        ];
    }
}
