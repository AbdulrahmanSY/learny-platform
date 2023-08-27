<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePriceHourRequest;
use App\Http\Requests\UpdatePriceHourRequest;
use App\Models\PriceHour;

class PriceHourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePriceHourRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PriceHour $priceHour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PriceHour $priceHour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePriceHourRequest $request, PriceHour $priceHour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PriceHour $priceHour)
    {
        //
    }
}
