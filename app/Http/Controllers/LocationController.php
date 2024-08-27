<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\District;
use App\Models\Village;

class LocationController extends Controller
{
    public function getCities($provinceId)
    {
        $cities = City::where('province_id', $provinceId)->pluck('name', 'id');
        return response()->json($cities);
    }

    public function getDistricts($cityId)
    {
        $districts = District::where('city_id', $cityId)->pluck('name', 'id');
        return response()->json($districts);
    }

    public function getVillages($districtId)
    {
        $villages = Village::where('district_id', $districtId)->pluck('name', 'id');
        return response()->json($villages);
    }
}
