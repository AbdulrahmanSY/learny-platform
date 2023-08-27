<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CardIDController extends Controller
{
    public static function createCardID($teacher, $card)
    {

        $back_card_image_url = handleFile($card['back_card_image'],'teacher/card_image/');
        $front_card_image_url = handleFile($card['front_card_image'],'teacher/card_image/');

        $teacher->cardId()->create([
            'national_number' => $card['national_number'],
            'front_card_image' => $front_card_image_url,
            'back_card_image' => $back_card_image_url,
        ]);
    }
}
