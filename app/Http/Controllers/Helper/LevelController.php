<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use App\Http\Requests\Level\AddLevelRequest;
use App\Models\Level;

class LevelController extends Controller
{
    public function getLevels()
    {
        $levels = Level::all();
        if (!$levels)
            return $this->error(errors: 'There is no level to get');
        return $this->success($levels);
    }

    public function addLevel(AddLevelRequest $request)
    {
        $data = $request->validated();
        try {
            Level::create([
                'level_name' => $data['level_name']]);
            return $this->success('Level created successfully');
        } catch (\Exception $exception) {
            return $this->error(errors: $exception->getMessage());
        }
    }

    public function deleteLevel($id)
    {
        try {
            Level::find($id)->delete();
            return $this->success('Level deleted successfully');
        } catch (\Exception $exception) {
            return $this->error(errors: $exception);
        }

    }
}
