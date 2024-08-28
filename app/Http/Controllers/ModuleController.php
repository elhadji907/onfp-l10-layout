<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Domaine;
use App\Models\Individuelle;
use App\Models\Module;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::orderBy("created_at", "desc")->get();
        $domaines = Domaine::orderBy("created_at", "desc")->get();
        return view("modules.index", compact("modules", "domaines"));
    }
    public function show($id)
    {
        $module = Module::find($id);
        return view("modules.show", compact("module"));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "name"             => ["required", "string", Rule::unique(Module::class)->ignore($id)],
            "domaine"          => ["required", "string"],
        ]);

        $module = Module::findOrFail($id);

        $module->update([
            'name'            => $request->input('name'),
            'domaines_id'     => $request->input('domaine'),
        ]);

        $module->save();

        Alert::success('Fait ! ', 'module modifié avec succès');

        return redirect()->back();
    }

    public function modulelocalite($idlocalite, $idmodule)
    {
        $localite = Region::findOrFail($idlocalite);
        $module = Module::findOrFail($idmodule);

        $individuelles = Individuelle::where('regions_id', $idlocalite)->where('modules_id', $idmodule)->get();

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

    public function addModule(Request $request)
    {
        $this->validate($request, [
            "name"             => ["required", "string", Rule::unique(Module::class)],
            /* "domaine"          => ["required", "string"], */
        ]);

        $module = Module::create([
            'name'            => $request->input('name'),
            /* 'domaines_id'     => $request->input('domaine'), */
        ]);

        $module->save();

        Alert::success('Fait ! ', 'module ajouté avec succès');

        return redirect()->back();
    }

    public function destroy($id)
    {
        $module   = Module::find($id);

        $module->delete();

        Alert::success('Fait !', 'module supprimé');

        return redirect()->back();
    }
}
