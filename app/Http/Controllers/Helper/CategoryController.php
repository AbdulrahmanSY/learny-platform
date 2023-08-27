<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Categories;

class CategoryController extends Controller
{
    function getCategory(){
        return $this->success(CategoryResource::collection(Categories::all()));
    }
}
