<?php

namespace App\Http\Controllers\Agora;

use App\Http\Controllers\Controller;
use App\Http\Resources\SessionResource;
use App\Models\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AgoraController extends Controller
{
    public function getSessionInfo($id){
        try {
            $session = Session::findOrFail($id);
            return new SessionResource($session);
            }catch (\Exception $exception){
            if ($exception instanceof \Illuminate\Database\Eloquent\ModelNotFoundException)
            {
                return $this->error(errors: 'Invalid ID, please check this ID and try again');
            }

        }
    }
}
