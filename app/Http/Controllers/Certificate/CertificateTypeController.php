<?php

namespace App\Http\Controllers\Certificate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Certificate\AddCertificateType;
use App\Models\CertificateType;

class CertificateTypeController extends Controller
{
    public function getCertificateTypes(){
        return $this->success(CertificateType::all());
    }

    public function deleteCertificateTypes($id){
        $type = CertificateType::find($id);
        if ($type){
            $type->delete();
            return $this->success('Type deleted successfully');
        }
        return $this->notFoundResponse(errors: 'There is no type with this ID');
    }
    public function addCertificateType(AddCertificateType $request){
        $data = $request->validated();
        CertificateType::create(
            $data);
        return $this->createdResponse(message: 'Certificate type created successfully');
    }
}
