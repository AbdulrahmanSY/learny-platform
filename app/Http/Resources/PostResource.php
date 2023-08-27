<?php

namespace App\Http\Resources;

use App\Models\ContentLevel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class PostResource extends JsonResource
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
            'is_followed'=>Auth::user()->follow->contains($this->teacher_id),

            'title' => $this->title,
            'description' => $this->description,
            'type' => $this->type,
            'language' => $this->language,
            'content_levels'=> new ContentLevelResource($this->contentLevel),
            'teacher' => new TeacherResource($this->teacher),
            'files' =>FilePostResource::collection($this->file),
        ];
    }
}
