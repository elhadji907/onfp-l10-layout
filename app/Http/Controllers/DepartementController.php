<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    public function index(){
        $departements = Departement::orderBy("created_at", "desc")->get();
        
        return view("localites.departements.index",compact("departements"));
    }
}
