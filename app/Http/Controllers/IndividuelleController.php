<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Individuelle;
use Illuminate\Http\Request;

class IndividuelleController extends Controller
{
    public function index()
    {
        $individuelles = Individuelle::orderBy('created_at', 'desc')->get();
        return view("demandes.individuelles.index", compact("individuelles"));
    }

    public function create()
    {
        $departements = Departement::orderBy("created_at", "desc")->get();
        return view("demandes.individuelles.create", compact("departements"));
    }
}
