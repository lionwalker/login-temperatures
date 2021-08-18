<?php

namespace App\Http\Controllers;

use App\Models\Temperature;
use Illuminate\Http\Request;
use Inertia\Inertia;
use phpDocumentor\Reflection\Types\Collection;

class TemperatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $cities = config('api.cities');
        return Inertia::render('Dashboard', [
            'cities' => $cities
        ]);
    }

    /**
     * Return saved data of city.
     *
     * @return Collection
     */
    public function getCityTemperature(Request $request, $city)
    {
        $temperatures = Temperature::whereCity($city)->get();
        return $temperatures;
    }
}
