<?php

namespace App\Http\Controllers;

use App\Models\Moduleoperateurstatut;
use App\Models\Operateurmodule;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OperateurmoduleController extends Controller
{
    public function index()
    {
        $operateurmodules = Operateurmodule::orderBy('created_at', 'desc')->get();
        return view("operateurmodules.index", compact("operateurmodules"));
    }

    public function store(Request $request)
    {
        /* $this->validate($request, [
            'modules.*.module' => 'required|unique:operateurmodules,module',
            'domaines.*.domaine' => 'required|unique:operateurmodules,domaine',
            'niveau_qualifications.*.niveau_qualification' => 'required|unique:operateurmodules,niveau_qualification',
        ]); */

        $this->validate($request, [
            'module'                => 'required|string',
            'domaine'               => 'required|string',
            'niveau_qualification'  => 'required|string',
        ]);
        $total_module = Operateurmodule::where('operateurs_id', $request->input('operateur'))->count();
        if ($total_module >= 10) {
            Alert::warning('Attention ! ', 'Vous avez atteint le nombre de modules autorisés');
            return redirect()->back();
        } else {
            $operateurmodule = new Operateurmodule([
                "module"                =>  $request->input("module"),
                "domaine"               =>  $request->input("domaine"),
                'niveau_qualification'  =>  $request->input('niveau_qualification'),
                'statut'                =>  'Attente',
                'operateurs_id'         =>  $request->input('operateur'),
            ]);

            $operateurmodule->save();

            $moduleoperateurstatut = new Moduleoperateurstatut([
                'statut'                =>  "Attente",
                'operateurmodules_id'   =>  $operateurmodule->id,

            ]);

            $moduleoperateurstatut->save();
        }

        Alert::success('Féliciations ! ', 'module ajouté avec succès');

        return redirect()->back();
    }


    public function update(Request $request, $id)
    {
        $operateurmodule = Operateurmodule::findOrFail($id);

        $this->validate($request, [
            'module'                => 'required|string',
            'domaine'               => 'required|string',
            'niveau_qualification'  => 'required|string',
        ]);

        $operateurmodule->update([
            "module"                =>  $request->input("module"),
            "domaine"               =>  $request->input("domaine"),
            'niveau_qualification'  =>  $request->input('niveau_qualification'),
            'operateurs_id'         =>  $operateurmodule->operateurs_id,
        ]);

        Alert::success($operateurmodule->module, 'mis à jour');

        return redirect()->back();
    }

    public function show($id)
    {
        $operateurmodule = Operateurmodule::findOrFail($id);
        $modulename = $operateurmodule->module;
        $operateurmodules   =   Operateurmodule::where('module', $modulename)->get();

        return view("operateurmodules.show", compact("operateurmodules", "modulename"));

    }
    public function destroy($id)
    {
        $operateurmodule = Operateurmodule::find($id);
        /* dd($operateurmodule); */
        $operateurmodule->delete();

        Alert::success("Module " . $operateurmodule->module, 'a été supprimé avec succès');
        return redirect()->back();
    }
}
