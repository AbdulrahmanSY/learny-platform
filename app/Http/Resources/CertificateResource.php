<?php

namespace App\Http\Resources;

use App\Models\CertificateType;
use App\Models\Doner;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'certificate_image'=>url($this->certificate_image),
            'certificate_type'=>CertificateType::find($this->certificate_type_id)['type_name'],
            'doner'=>new DonerResource(Doner::find($this->doner_id))
        ];
    }
}
