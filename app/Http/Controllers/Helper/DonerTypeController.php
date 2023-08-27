<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use App\Http\Requests\Certificate\AddDonerType;
use App\Models\DonerType;

class DonerTypeController extends Controller
{
    public function getDonerTypes(){
        return $this->success(DonerType::all());
    }

    public function deleteDonerType($id){
        $type = DonerType::find($id);
        if ($type){
            $type->delete();
            return $this->success(message: 'Doner type deleted successfully');
        }
        return $this->notFoundResponse(errors: 'There is no doner type with this ID');
    }

    public function addDonerType(AddDonerType $request){
        $data = $request->validated();
        try {
            DonerType::create($data);
            return $this->createdResponse(message: 'Doner type created successfully');
        }catch (\Exception $exception){
            return $this->error(errors: $exception->getMessage());
        }
    }
}
