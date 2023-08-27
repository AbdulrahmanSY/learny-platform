<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Http\Resources\ParagarphpCategoryResource;
use App\Models\ParagraphCategory;

class ParagraphCategoryController extends Controller
{
    function getParagraphCategory()
    {
        $types = ParagraphCategory::all();
        $types->transform(function ($type) {
            $type->type = $type->get();
            return $type;
        });
        return $this->success(ParagarphpCategoryResource::collection($types));
    }
}
