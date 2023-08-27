<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    protected $accessToken = null;

    public function __construct($resource, $token = null)
    {
        parent::__construct($resource);
        $this->accessToken = $token;
    }

    public function toArray(Request $request): array
    {
        $data = [
            'user_id' => $this->id,
            'first_name' => $this->first_name,
            'father_name'=>$this->father_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'gender' => $this->gender,
            'phone_number' => $this->phone_number,
            'birth_date' => $this->birth_date,
            'verified' => $this->verified,
            'hours' => $this->hours,
            'points' => $this->points,
            'personal_image' => $this->personal_image?url($this->personal_image):null,
            'nationality' => new NationalityResource($this->nationality),
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
            'teacher_info' => TeacherResource::collection($this->whenLoaded('teacher'))
        ];
        if (is_string($this->accessToken)) {
            $data['access_token'] = $this->accessToken;
        }
        return $data;
    }
}
