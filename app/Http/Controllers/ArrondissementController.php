<?php

namespace App\Http\Controllers;

use App\Models\Arrondissement;
use Illuminate\Http\Request;

class ArrondissementController extends Controller
{
    public function index(){
        $arrondissements = Arrondissement::orderBy("created_at", "desc")->get();
        
        return view("localites.arrondissements.index",compact("arrondissements"));
    }
}
