<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class ProjetController extends Controller
{
    public function index()
    {
        $projets = Projet::get();
        return view('projets.index', compact('projets'));
    }
    public function addProjet(Request $request)
    {
        $this->validate($request, [
            "name"              => ["required", "string", Rule::unique('projets')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "sigle"             => ["required", "string", Rule::unique('projets')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "date_signature"    => ["date", "string", Rule::unique('projets')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "description"    => ["required", "string", Rule::unique('projets')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "duree"    => ["nullable", "string"],
            "budjet"    => ["nullable", "string"],
            "debut"    => ["nullable", "date"],
            "fin"    => ["nullable", "date"],
        ]);

        $projet = new Projet([
            'name'                  =>  $request->input('name'),
            'sigle'                 =>  $request->input('sigle'),
            'date_signature'        =>  $request->input('date_signature'),
            'description'           =>  $request->input('description'),
            'duree'                 =>  $request->input('duree'),
            'budjet'                =>  $request->input('budjet'),
            'fin'                   =>  $request->input('fin'),
            'debut'                 =>  $request->input('debut'),

        ]);

        $projet->save();

        Alert::success('Félicitations !', 'ajouté avec succès');

        return redirect()->back();
    }

    public function destroy($id)
    {
        $projet = Projet::findOrFail($id);

        $projet->delete();

        Alert::success('Fait !', 'supprimer avec succès');

        return redirect()->back();
    }

    public function show($id)
    {
        $projet = Projet::findOrFail($id);
        return view('projets.show', compact('projet'));
    }
}
