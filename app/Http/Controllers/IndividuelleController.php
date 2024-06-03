<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndividuelleStoreRequest;
use App\Models\Demandeur;
use App\Models\Departement;
use App\Models\Individuelle;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndividuelleController extends Controller
{
    public function index()
    {
        $individuelles = Individuelle::orderBy('created_at', 'desc')->get();
        return view("demandes.individuelles.index", compact("individuelles"));
    }

    public function create()
    {
        $departements = Departement::orderBy("created_at", "desc")->get();
        return view("demandes.individuelles.create", compact("departements"));
    }

    public function store(IndividuelleStoreRequest $request): RedirectResponse
    {
        $anne = date('y');
        $num = rand(100, 999);
        $letter = chr(rand(65, 90));
        /* dd($anne . ' ' . $num . ' ' . $letter); */

        $cin  =   $request->input('cin');
        $cin  =   str_replace(' ', '', $cin);

        $first = Individuelle::get()->first();

        if (isset($first)) {
            $num_demande_inividuelle = Individuelle::get()->last()->numero;
            $num_demande_inividuelle = ++$num_demande_inividuelle;
            $individuelle_id         = Individuelle::latest('id')->first()->id;
        } else {
            $num_demande_inividuelle = "0001";
            $individuelle_id         = "0";
        }

        $longueur = strlen($individuelle_id);

        if ($longueur == 0) {
            $num_demande_inividuelle   =   strtolower("00000" . $individuelle_id);
        } elseif ($longueur <= 1) {
            $num_demande_inividuelle   =   strtolower("0000" . $individuelle_id);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $num_demande_inividuelle   =   strtolower("000" . $individuelle_id);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $num_demande_inividuelle   =   strtolower("00" . $individuelle_id);
        } elseif ($longueur >= 4 && $longueur < 5) {
            $num_demande_inividuelle   =   strtolower("0" . $individuelle_id);
        } else {
            $num_demande_inividuelle   =   strtolower($num_demande_inividuelle);
        }

        $user = User::create([
            'civilite'                  => $request->input('civilite'),
            'firstname'                 => $request->input('firstname'),
            'name'                      => $request->input('name'),
            'date_naissance'            => $request->input('date_naissance'),
            'lieu_naissance'            => $request->input('lieu_naissance'),
            'email'                     => $request->input('email'),
            'telephone'                 => $request->input('telephone'),
            'situation_familiale'       => $request->input('situation_familiale'),
            'situation_professionnelle' => $request->input('situation_professionnelle'),
            'adresse'                   => $request->input('adresse'),
        ]);

        $user->save();

        $demandeur = new Demandeur([
            'cin'               => $cin,
            'type'              => 'individuelle',
            "departements_id"   => $request->input("departement"),
            'numero_dossier'    => "DO" . $num_demande_inividuelle . "" . $anne,
            'users_id'          => $user->id
        ]);

        $demandeur->save();

        $individuelle = new Individuelle([
            'date_depot'                        =>  $request->input('date_depot'),
            'numero'                            =>  $num_demande_inividuelle . "" . $anne,
            'telephone'                         =>  $request->input('telephone_secondaire'),
            'niveau_etude'                      =>  $request->input('niveau_etude'),
            'diplome_academique'                =>  $request->input('diplome_academique'),
            'autre_diplome_academique'          =>  $request->input('autre_diplome_academique'),
            'option_diplome_academique'         =>  $request->input('option_diplome_academique'),
            'etablissement_academique'          =>  $request->input('etablissement_academique'),
            'diplome_professionnel'             =>  $request->input('diplome_professionnel'),
            'autre_diplome_professionnel'       =>  $request->input('autre_diplome_professionnel'),
            'specialite_diplome_professionnel'  =>  $request->input('specialite_diplome_professionnel'),
            'etablissement_professionnel'       =>  $request->input('etablissement_professionnel'),
            'projet_poste_formation'            =>  $request->input('projet_poste_formation'),
            'projetprofessionnel'               =>  $request->input('projetprofessionnel'),
            'demandeurs_id'                     =>  $demandeur->id
        ]);

        $individuelle->save();

        $status = "Enregistrement effectué avec succès";
        return redirect()->back()->with("status", $status);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view("demandes.individuelles.show", compact("user"));
    }

    public function destroy($id)
    {
        $individuelle   = Individuelle::find($id);

        $individuelle->delete();

        "La demande de " . $message = $individuelle->demandeur->user->firstname . ' ' . $individuelle->demandeur->user->name . ' a été supprimée';

        return redirect()->back()->with("danger", $message);
    }
}
