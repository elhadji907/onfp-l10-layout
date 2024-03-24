<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index(){
        $regions = Region::orderBy("created_at", "desc")->get();
        
        return view("localites.regions.index",compact("regions"));
    }
}
