<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    public function index(){
        $directions = Direction::orderBy("created_at","desc")->get();
        return view("directions.index", compact("directions"));
    }
}
