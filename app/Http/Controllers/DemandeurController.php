<?php

namespace App\Http\Controllers;

use App\Models\Demandeur;
use Illuminate\Http\Request;

class DemandeurController extends Controller
{
    public function show($id)
    {
        $demandeur = Demandeur::findOrFail($id);
        return view("demandes.show", compact("demandeur"));
    }
}
