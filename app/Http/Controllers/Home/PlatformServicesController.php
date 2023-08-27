<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\PlatformServices;

class PlatformServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getService()
    {
        return $this->success(ServiceResource::collection( PlatformServices::all()));
    }



}
