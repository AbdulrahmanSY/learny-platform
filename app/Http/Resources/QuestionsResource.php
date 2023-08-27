<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class QuestionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if(auth()->user() !== null){
            $follow = $data['is_followed']=Auth::user()->follow->contains($this->teacher_id);
        }
        return $data = [
            'id' => $this->id,
            'is_followed' => $follow??false,
            'is_solved' => $this->is_solved ? $this->is_solved : false,
            'teacher' => new UserResource($this->teacher->user),
            'teacher_info' => new TeacherInfoResource($this->teacher),
            'question' => $this->question,
            'category' => $this->category->category_name,
            'category_id' => $this->category->id,
            'content_level' => new ContentLevelResource($this->contentLevel),
            'language' => $this->category->language->language_name,
            'language_id' => $this->category->language->id,
            'answers' => AnswerResource::collection($this->answer),
        ];

    }
}
