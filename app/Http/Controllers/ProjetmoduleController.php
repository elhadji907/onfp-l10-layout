<?php

namespace App\Http\Controllers;

use App\Models\Projetmodule;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProjetmoduleController extends Controller
{
    public function store(Request $request)
    {

        $this->validate($request, [
            'module'                => 'required|string',
            'domaine'               => 'required|string',
        ]);

        $projetmodule = new Projetmodule([
            "module"                =>  $request->input("module"),
            "domaine"               =>  $request->input("domaine"),
            'projets_id'            =>  $request->input('projet'),
        ]);

        $projetmodule->save();

        Alert::success('Féliciations ! ', 'module ajouté avec succès');

        return redirect()->back();
    }

    public function show()
    {
        //
    }

    public function update($id)
    {
        //
    }
}
