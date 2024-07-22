<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function searchCity() {
        $param = request()->get('city');
        $cities = Airport::where("name", 'LIKE',  "%{$param}%")
                            ->orWhere("code", 'LIKE',  "%{$param}%")
                            ->orWhere("countryCode", 'LIKE',  "%{$param}%")
                            ->orWhere("countryName", 'LIKE',  "%{$param}%")->limit(5)->get();
        return $cities;
    }
}
