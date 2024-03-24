<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use Illuminate\Http\Request;

class CommuneController extends Controller
{
    public function index(){
        $communes = Commune::orderBy("created_at", "desc")->get();
        
        return view("localites.communes.index",compact("communes"));
    }
}
