<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Certificate\CertificateController;
use App\Http\Controllers\Controller;
use App\Http\Requests\addTeacherLanguageRequest;
use App\Http\Requests\Language\AddLanguageRequest;
use App\Http\Resources\LanguageResource;
use App\Models\Language;

class LanguageController extends Controller
{
    public static function createTeacherLanguages($teacher, $languages)
    {
        foreach ($languages as $lang) {
            $language = $teacher->languages()->create([
                'language_id' => $lang['language_id'],
                'language_level_id' => $lang['language_level_id'],
                'years_of_experience' => (int)$lang['years_of_experience'],
            ]);
            $certificates = new CertificateController();
            $certificates->createTeacherCertificates($lang['certificates'], $language);

        }
    }

    public function getLanguages()
    {
        $languages = Language::all();
        return LanguageResource::collection($languages);
    }

    public function addLanguage(AddLanguageRequest $request)
    {
        try {
            Language::create([
                'language_name' => $request->language_name
            ]);
        } catch (\Exception $exception) {
            return $this->error(errors: trans('validation.custom.wrong'));
        }
        return $this->createdResponse(message: 'Created language successfully');
    }

    public function deleteLanguage(string $id)
    {
        $language = Language::find($id);

        if (!$language) {
            return $this->notFoundResponse(errors: 'Language not found');
        } else {
            $language->delete();
            return $this->success('Language deleted successfully');
        }
    }
}
