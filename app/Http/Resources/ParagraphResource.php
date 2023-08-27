<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ParagraphResource extends JsonResource
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
            'paragraph' => $this->paragraph,
            'category' => new ParagarphpCategoryResource($this->category),
            'language' => $this->language,
            'content_levels' => new ContentLevelResource($this->contentLevel),
            'teacher' => new TeacherResource($this->teacher),
        ];
    }
}
