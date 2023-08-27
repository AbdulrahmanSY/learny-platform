<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\PackageHoursResources;
use App\Models\PackageHours;
use App\Models\PriceHour;

class PackageHoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getPackageHoursPrice(): \Illuminate\Http\JsonResponse
    {
        $price = PriceHour::findOrFail(1);
        $packageHours = PackageHours::all();
        foreach ($packageHours as $element) {
//            dd($price->price);
            $element->priceAD = $element->number_of_hours * $price->price * (1 - $element->discount);
            $element->price = $element->number_of_hours * $price->price ;
        }
        return $this->success(PackageHoursResources::collection($packageHours));
    }


}
