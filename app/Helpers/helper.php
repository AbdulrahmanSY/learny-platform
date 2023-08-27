<?php

use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Traits\ApiResponderTrait as Tr;

/**
 * @throws Exception
 */
function handleFile($base64, $path)
{
    try {
        $extension = explode('/', explode(':', substr($base64, 0, strpos($base64, ';')))[1])[1];   // .jpg .png .pdf

        $replace = substr($base64, 0, strpos($base64, ',')+1);

        $file = str_replace($replace, '', $base64);

        $file = str_replace(' ', '+', $file);

        $fileName = Str::random(60).'.'.$extension;
        Storage::disk('public')->put($path.$fileName, base64_decode($file));
        return 'storage/'.$path . $fileName;
    }catch(Exception $exception){
        throw new Exception($exception);
    }
}

/**
 * @param $to mixed
 * @param $envelope Mailable
 * @return void
 */
function sendMail(mixed $to, Mailable $envelope){
        Mail::to($to)->send($envelope);
}
