<?php

namespace App\Http\Controllers;

use App\Models\Listecollective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class ListecollectiveController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            "cin"                  =>      "required|string|min:13|max:15|unique:listecollectives,cin,except,id",
            "civilite"             =>      "required|string",
            "firstname"            =>      "required|string",
            "name"                 =>      "required|string",
            "date_naissance"       =>      "date|string",
            "lieu_naissance"       =>      "required|string",
            "module"               =>      "required|string",
            "niveau_etude"         =>      "nullable|string",
            "telephone"            =>      "nullable|string",
        ]);

        $membre = Listecollective::create([
            'cin'                       =>      $request->input('cin'),
            'civilite'                  =>      $request->input('civilite'),
            'prenom'                    =>      $request->input('firstname'),
            'nom'                       =>      $request->input('name'),
            'date_naissance'            =>      $request->input('date_naissance'),
            'lieu_naissance'            =>      $request->input('lieu_naissance'),
            'niveau_etude'              =>      $request->input('niveau_etude'),
            'telephone'                 =>      $request->input('telephone'),
            'experience'                =>      $request->input('experience'),
            'autre_experience'          =>      $request->input('autre_experience'),
            'details'                   =>      $request->input('details'),
            'statut'                    =>      'attente',
            'collectivemodules_id'      =>      $request->input('module'),
            'collectives_id'            =>      $request->input('collective'),
        ]);

        $membre->save();

        Alert::success("Ajouté !", "avec succès");

        return redirect()->back();
    }

    public function edit($id)
    {
        $listecollective   = Listecollective::find($id);
        return view("collectives.updateliste", compact("listecollective"));

    }

    public function update(Request $request, $id)
    {
        $listecollective   = Listecollective::find($id);

        $listecollective->update([
            'cin'                       =>      $request->input('cin'),
            'civilite'                  =>      $request->input('civilite'),
            'prenom'                    =>      $request->input('firstname'),
            'nom'                       =>      $request->input('name'),
            'date_naissance'            =>      $request->input('date_naissance'),
            'lieu_naissance'            =>      $request->input('lieu_naissance'),
            'niveau_etude'              =>      $request->input('niveau_etude'),
            'telephone'                 =>      $request->input('telephone'),
            'experience'                =>      $request->input('experience'),
            'autre_experience'          =>      $request->input('autre_experience'),
            'details'                   =>      $request->input('details'),
            'statut'                    =>      'attente',
            'collectivemodules_id'      =>      $request->input('module'),
            'collectives_id'            =>      $request->input('collective'),
        ]);

        $listecollective->save();

        Alert::success("Ajouté !", "avec succès");

        return Redirect::route('collectivemodules.show', $request->input('module'));

    }

    public function show($id)
    {
        $listecollective   = Listecollective::find($id);
        dd($listecollective);

    }

    public function destroy($id)
    {
        $listecollective   = Listecollective::find($id);

        $listecollective->delete();

        Alert::success('module', 'supprimé');

        return redirect()->back();
    }
}
