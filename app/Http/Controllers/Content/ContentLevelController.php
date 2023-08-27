<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContentLevelResource;
use App\Models\ContentLevel;

class ContentLevelController extends Controller
{
    function getContentLevel()
    {
        $levels = ContentLevel::all();

        $levels->transform(function($level) {
            $level->level = $level->getLevel();
            return $level;
        });
        return $this->success(ContentLevelResource::collection($levels));
    }
}
