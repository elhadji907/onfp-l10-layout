<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::orderBy("created_at", "desc")->get();
        return view("modules.index", compact("modules"));
    }
    public function show($id)
    {
        $module = Module::find($id);
        return view("modules.show", compact("module"));
    }
}
