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
                'operateurs_id'         =>  $request->input('operateur'),
            ]);

            $operateurmodule->save();
        }

        Alert::success('Féliciations ! ', 'module ajouté avec succès');

        return redirect()->back();
    }
    public function destroy($id)
    {
        $operateurmodule = Operateurmodule::find($id);
        $operateurmodule->delete();

        Alert::success("Module " . $operateurmodule->module, 'a été supprimé avec succès');
        return redirect()->back();
    }
}
