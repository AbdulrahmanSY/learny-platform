<?php

/*-----------------------------------------------*/
/*--------------------  api ---------------------*/

/*-----------------------------------------------*/


use App\Services\AgoraService;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

require __DIR__ . '/api/Auth.php';
require __DIR__ . '/api/Teacher.php';
require __DIR__ . '/api/User.php';
require __DIR__ . '/api/Admin.php';
require __DIR__ . '/api/Country.php';
require __DIR__ . '/api/Language.php';
require __DIR__ . '/api/Level.php';
require __DIR__ . '/api/Certificate.php';
require __DIR__ . '/api/Helper.php';
require __DIR__ . '/api/Nationality.php';
require __DIR__ . '/api/Goal.php';
require __DIR__ . '/api/Appointment.php';
require __DIR__ . '/api/AppointmentStatus.php';
require __DIR__ . '/api/Content.php';
require __DIR__ . '/api/Agora.php';
require __DIR__ . '/api/Follow.php';
require __DIR__ . '/api/Home.php';

Route::get('test',function (){
    return (new AgoraService)->generateToken('a');
});

