<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
       
    public function index(Request $request)
    {

      $locations = [
        ["lat" => 36.2021, "lng" => 37.1343],
      ];
      return view("map",['locations'=>$locations]);
    }
}

