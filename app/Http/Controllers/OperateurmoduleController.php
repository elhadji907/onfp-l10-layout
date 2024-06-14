<?php

namespace App\Http\Controllers;

use App\Models\Operateurmodule;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OperateurmoduleController extends Controller
{
    public function store(Request $request)
    {
        /* $this->validate($request, [
            'modules.*.module' => 'required|unique:operateurmodules,module',
            'domaines.*.domaine' => 'required|unique:operateurmodules,domaine',
            'niveau_qualifications.*.niveau_qualification' => 'required|unique:operateurmodules,niveau_qualification',
        ]); */

        $this->validate($request, [
            'module'                => 'required|unique:operateurmodules,module',
            'domaine'               => 'required|unique:operateurmodules,domaine',
            'niveau_qualification'  => 'required|unique:operateurmodules,niveau_qualification',
        ]);

        $operateurmodule = new Operateurmodule([
            "module"                =>  $request->input("module"),
            "domaine"               =>  $request->input("domaine"),
            'niveau_qualification'  =>  $request->input('niveau_qualification'),
            'operateurs_id'         =>  $request->input('operateur'),
        ]);

        $operateurmodule->save();

        Alert::success('Féliciations ! ', 'module ajouté avec succès');

        return redirect()->back();
    }
}
