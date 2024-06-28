<?php

namespace App\Http\Controllers;

use App\Models\Demandeur;
use App\Models\Departement;
use App\Models\Module;
use Illuminate\Http\Request;

class DemandeurController extends Controller
{
    public function index()
    {
        $demandeurs = demandeur::orderBy('created_at', 'desc')->get();
        return view("demandes.index", compact("demandeurs"));
    }
    public function show($id)
    {
        $departements = Departement::orderBy("created_at", "desc")->get();
        $modules = Module::orderBy("created_at", "desc")->get();
        $demandeur = Demandeur::findOrFail($id);
        $demandes_total = $demandeur->individuelles()->count();

        return view("demandes.show", compact("demandeur", "demandes_total","departements", "modules"));
        
    }
}
