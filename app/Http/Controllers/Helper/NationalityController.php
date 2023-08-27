<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use App\Http\Requests\Nationality\AddNationalityRequest;
use App\Models\Nationality;

class NationalityController extends Controller
{
    public function getNationalities()
    {
        $nationalities = Nationality::all();
        if (!$nationalities)
            return $this->error(errors: 'There is no level to get');
        return $this->success($nationalities);
    }

    public function addNationality(AddNationalityRequest $request)
    {
        $data = $request->validated();
        try {
            Nationality::create([
                'nationality_name' => $data['nationality_name']]);
            return $this->createdResponse(message: 'Nationality created successfully');
        } catch (\Exception $exception) {
            return $this->error(errors: $exception->getMessage());
        }
    }

    public function deleteNationality($id)
    {
        $nationality = Nationality::find($id);
        if ($nationality) {
            $nationality->delete();
            return $this->success(message: 'Nationality deleted successfully');
        }else{
            return $this->notFoundResponse(errors: 'There is no nationality with this ID');
        }

    }
}
