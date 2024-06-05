<?php

namespace App\Http\Controllers;

use App\Models\Demandeur;
use Illuminate\Http\Request;

class DemandeurController extends Controller
{
    public function show($id)
    {
        $demandeur = Demandeur::findOrFail($id);
        $demandes_total = $demandeur->individuelles()->count();
        return view("demandes.show", compact("demandeur", "demandes_total"));
    }
}
