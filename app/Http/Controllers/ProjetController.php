<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Individuelle;
use App\Models\Module;
use App\Models\Projet;
use App\Models\Projetlocalite;
use App\Models\Projetmodule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class ProjetController extends Controller
{
    public function __construct()
    {
        // examples:
        $this->middleware('auth');
        $this->middleware(['role:super-admin|admin|Demandeur|DIOF|ADIOF']);
        $this->middleware("permission:user-view", ["only" => ["index"]]);
        /* $this->middleware(['permission:arrive-show']); */
        // or with specific guard
        /* $this->middleware(['role_or_permission:super-admin']); */
    }
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
            "description"       => ["required", "string", Rule::unique('projets')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "duree"             => ["nullable", "string"],
            "budjet"            => ["nullable", "string"],
            "effectif"          => ["nullable", "string"],
            "debut"             => ["nullable", "date"],
            "fin"               => ["nullable", "date"],
        ]);

        $projet = new Projet([
            'name'               =>  $request->input('name'),
            'sigle'              =>  $request->input('sigle'),
            'date_signature'     =>  $request->input('date_signature'),
            'description'        =>  $request->input('description'),
            'duree'              =>  $request->input('duree'),
            'budjet'             =>  $request->input('budjet'),
            'fin'                =>  $request->input('fin'),
            'debut'              =>  $request->input('debut'),
            'effectif'           =>  $request->input('effectif'),
            'statut'             =>  'attente',

        ]);

        $projet->save();

        Alert::success('Félicitations !', 'ajouté avec succès');

        return redirect()->back();
    }

    public function show($id)
    {
        $projet = Projet::findOrFail($id);
        $projetlocalites = Projetlocalite::where('projets_id', $id)->get();
        return view(
            'projets.show',
            compact(
                'projet',
                'projetlocalites'
            )
        );
    }
    public function update(Request $request, $id)
    {
        $projet = Projet::find($id);
        $this->validate($request, [
            "name"              => ["required", "string", Rule::unique('projets')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })->ignore($id)],
            "sigle"             => ["required", "string", Rule::unique('projets')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })->ignore($id)],
            "date_signature"    => ["date", "string"],
            "description"       => ["required", "string", Rule::unique('projets')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })->ignore($id)],
            "duree"             => ["nullable", "string"],
            "budjet"            => ["nullable", "string"],
            "effectif"          => ["nullable", "string"],
            "debut"             => ["nullable", "date"],
            "fin"               => ["nullable", "date"],
        ]);

        $projet->update([
            'name'                  =>  $request->input('name'),
            'sigle'                 =>  $request->input('sigle'),
            'date_signature'        =>  $request->input('date_signature'),
            'description'           =>  $request->input('description'),
            'duree'                 =>  $request->input('duree'),
            'budjet'                =>  $request->input('budjet'),
            'fin'                   =>  $request->input('fin'),
            'debut'                 =>  $request->input('debut'),
            'effectif'              =>  $request->input('effectif'),
        ]);

        $projet->save();

        Alert::success('Modification effectuée', 'avec succès');

        return redirect()->back();
    }
    public function destroy($id)
    {
        $projet = Projet::findOrFail($id);

        $projet->delete();

        Alert::success('Fait !', 'supprimer avec succès');

        return redirect()->back();
    }

    public function projetsIndividuelle($id)
    {
        $projet = Projet::findOrFail($id);
        $projetlocalites = Projetlocalite::orderBy("created_at", "desc")->get();
        $projetmodules = Projetmodule::where('projets_id', $id)
            ->orderBy("created_at", "desc")
            ->get();
        $user = Auth::user();
        $individuelle = Individuelle::where('users_id', $user->id)
            ->where('projets_id', $id)
            ->where('numero', '!=', null)
            ->get();

        $individuelle_total = $individuelle->count();

        $individuelles = Individuelle::where('users_id', $user->id)
            ->where('projets_id', '!=', null)
            ->get();

        if ($individuelle_total == 0) {
            return view(
                "individuelles.show-projet-aucune",
                compact(
                    "individuelle_total",
                    "projetlocalites",
                    "projetmodules",
                    "individuelles",
                    "projet"
                )
            );
        } else {
            return view(
                "individuelles.show-projet",
                compact(
                    "individuelle_total",
                    "projetlocalites",
                    "projetmodules",
                    "individuelles",
                    "projet"
                )
            );
        }
    }

    public function ouvrirProjet($id)
    {

        $projet = Projet::findOrFail($id);

        $projet->update([
            'statut' => 'ouvert',
        ]);

        $projet->save();

        Alert::success('Féliciatations !', $projet->sigle . ' est ouvert');

        return redirect()->back();
    }

    public function fermerProjet($id)
    {

        $projet = Projet::findOrFail($id);

        $projet->update([
            'statut' => 'fermer',
        ]);

        $projet->save();

        Alert::success('Merci !', $projet->sigle . ' est fermé');

        return redirect()->back();
    }
}
