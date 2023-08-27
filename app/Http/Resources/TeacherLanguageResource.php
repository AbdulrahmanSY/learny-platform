<?php

namespace App\Http\Resources;

use App\Models\Language;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherLanguageResource extends JsonResource
{
    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'language'=> Language::where('id',$this->language_id)->first()['language_name'],
            'level'=>Level::where('id',$this->language_level_id)->first()['level_name'],
            'years_of_experience'=>$this->years_of_experience,
            'certificates'=>CertificateResource::collection($this->whenLoaded('certificates'))
        ];
    }
}
