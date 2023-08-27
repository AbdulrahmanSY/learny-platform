<?php

namespace App\Http\Resources;

use App\Models\Country;
use App\Models\DonerType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DonerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'doner_name'=>$this->doner_name,
            'doner_type'=>DonerType::find($this->doner_type_id)['type_name'],

        ];
    }
}
