<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypePostRequest;
use App\Http\Requests\UpdateTypePostRequest;
use App\Http\Resources\PostTypeResource;
use App\Models\TypePost;

class TypePostController extends Controller
{

    public function getPostType()
    {
        return $this->success(PostTypeResource::collection(TypePost::get()));
    }


}
