<?php

namespace App\Http\Controllers\Certificate;

use App\Http\Controllers\Controller;
use App\Http\Requests\addTeacherLanguageRequest;
use App\Models\Doner;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public static function createTeacherCertificates($certificates, $language)
    {
        foreach ($certificates as $certificate) {
            $certificate_url = handleFile($certificate['certificate_image'], 'teacher/certificates/');
            $doner = Doner::create($certificate['doner']);
            $language->certificates()->create([
                'certificate_date' => $certificate['certificate_date'],
                'certificate_image' => $certificate_url,
                'certificate_type_id' => $certificate['certificate_type_id'],
                'doner_id' => $doner->id,
            ]);
        }
    }
}
