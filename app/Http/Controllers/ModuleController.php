<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Individuelle;
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

    public function modulelocalite($idlocalite, $idmodule)
    {
        $localite = Departement::findOrFail($idlocalite);
        $module = Module::findOrFail($idmodule);

        $individuelles = Individuelle::where('departements_id', $idlocalite)->where('modules_id', $idmodule)->get();

        return view("modules.modulelocalite", compact("module", "localite", "individuelles"));
    }

    public function modulelocalitestatut($idlocalite, $idmodule, $statut)
    {
        $localite = Departement::findOrFail($idlocalite);
        $module = Module::findOrFail($idmodule);

        $individuelles = Individuelle::where('departements_id', $idlocalite)
                                        ->where('modules_id', $idmodule)
                                        ->where('statut', $statut)->get();

        return view("modules.modulelocalitestatut", compact("module", "localite", "individuelles", "statut"));
    }
    
    public function modulestatut($statut, $idmodule)
    {
        $module = Module::findOrFail($idmodule);

        $individuelles = Individuelle::where('statut', $statut)->where('modules_id', $idmodule)->get();

        return view("modules.modulestatut", compact("module", "statut", "individuelles"));
    }
    
    public function modulestatutlocalite($idlocalite, $idmodule, $statut)
    {
        $localite = Departement::findOrFail($idlocalite);
        $module = Module::findOrFail($idmodule);

        $individuelles = Individuelle::where('departements_id', $idlocalite)
                                        ->where('modules_id', $idmodule)
                                        ->where('statut', $statut)->get();


        return view("modules.modulestatutlocalite", compact("module", "localite", "individuelles", "statut"));
    }
}
