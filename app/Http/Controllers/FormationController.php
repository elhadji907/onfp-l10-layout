<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    public function index()
    {
        $formations = Formation::orderBy('created_at', 'desc')->get();
        return view("formations.index", compact("formations"));
    }
}
