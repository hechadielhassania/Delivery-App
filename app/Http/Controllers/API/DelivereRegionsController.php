<?php

namespace App\Http\Controllers\API;

use App\User; 
use App\DeliveryRegions; 
use App\DeliveryRegionCities; 
use Validator;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use Symfony\Component\HttpFoundation\Response;


class DelivereRegions extends Controller 
{

    public function regionsWithCities(Request $request){ 

        // fetch delivery regions and cities from database if exists
        $regions_and_cities = DeliveryRegions::with('cities')->get();
        $regions_and_cities = !$regions_and_cities ? [] : $regions_and_cities;

        $success['regions_with_cities'] =  $regions_and_cities; 
        return response()->json(['data' => $success], 200);
    }

    public function cities(Request $request, $region){ 

        // fetch delivery regions and cities from database if exists
        $regions_and_cities = DeliveryRegions::where('id',$region)->with('cities')->get();
        $regions_and_cities = !$regions_and_cities ? [] : $regions_and_cities;

        $success['regions_with_cities'] =  $regions_and_cities; 
        return response()->json(['data' => $success], 200);
    }

}