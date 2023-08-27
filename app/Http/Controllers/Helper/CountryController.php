<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use App\Http\Requests\Country\AddCountryRequest;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use App\Traits\ApiResponderTrait;

class CountryController extends Controller
{
    use ApiResponderTrait;


    public function getCountries()
    {
        $countries = CountryResource::collection(Country::get());
        if (isset($countries)) {
            return $this->success(CountryResource::collection(Country::get()));
        }else{
            return $this->notFoundResponse(errors: 'There is no countries yet');
        }
    }

    public function addCountry(AddCountryRequest $request)
    {

        Country::create($request->only('country_name'));

        return $this->success(message: 'created country successfully');
    }


//    public function updateCountry(Request $request, Countries $country)
//    {
//        $request->validate([
//            'country_name' => 'required|string|max:255|unique:countries',
//        ]);
//
//        $country->update($request->only('country_name'));
//
//        return $this->success($country);
//    }


    public function deleteCountry($id)
    {
        $country = Country::find($id);
        if (isset($country)) {
            $country->delete();
        } else {
            return $this->notFoundResponse(errors: 'This country not found');
        }
        return $this->success(message: 'deleted country successfully');
    }
}
