<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;

class LocaliteController extends Controller
{
    public function index()
    {
        $localites = Departement::orderBy("created_at", "desc")->get();
        return view("localites.index", compact("localites"));
    }
    public function show($id)
    {
        $localite = Departement::find($id);
        return view("localites.show", compact("localite"));
    }
}
