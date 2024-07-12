<?php

namespace App\Http\Controllers;

use App\Models\Collective;
use App\Models\Commune;
use App\Models\Departement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class CollectiveController extends Controller
{
    public function index()
    {
        $collectives = Collective::get();
        $departements = Departement::orderBy("created_at", "desc")->get();
        $communes = Commune::orderBy("created_at", "desc")->get();
        return view('demandes.collectives.index', compact('collectives', 'departements', 'communes'));
    }
    public function store(Request $request)
    {


        $this->validate($request, [
            "name"                  =>      "required|string|unique:collectives,name,except,id",
            "sigle"                 =>      "required|string|unique:collectives,sigle,except,id",
            "email"                =>      "required|email|unique:users,email,except,id",
            "fixe"                  =>      "required|string|unique:collectives,fixe,except,id",
            "telephone"            =>      "required|string|unique:collectives,telephone,except,id",
            "adresse"               =>      "required|string",
            "statut"                =>      "required|string",

            "description"           =>      "required|string",
            "projetprofessionnel"           =>      "required|string",

            "departement"           =>      "required|string",

            "civilite"              =>      "required|string",
            "prenom"                =>      "required|string",
            "nom"                   =>      "required|string",
            "email2"                =>      "required|email|unique:collectives,email2,except,id",
            "telephone2"            =>      "required|string|unique:collectives,telephone2,except,id",
            "fonction_responsable"  =>      "required|string",
        ]);

        dd($request->input('statut'));
        
        $user = new User([
            /* 'civilite'              =>      $request->input("civilite"), */
            'firstname'             =>      $request->input("name"),
            'name'                  =>      $request->input("sigle"),
            'email'                 =>      $request->input('email'),
            "telephone"             =>      $request->input("telephone"),
            'lieu_naissance'        =>      $request->input("adresse"),
            "adresse"               =>      $request->input("adresse"),
            'password'              =>      Hash::make($request->input('email1')),
            "bp"                    =>      $request->input("bp"),
            'created_by'            =>      Auth::user()->id,
            'updated_by'            =>      Auth::user()->id
        ]);

        $user->save();

        $collective = Collective::create([
            "name"                 =>       $request->input("name"),
            "sigle"                =>       $request->input("sigle"),
            "numero_agrement"      =>       $request->input("numero_agrement"),
            "email1"               =>       $request->input("email1"),
            "fixe"                 =>       $request->input("fixe"),
            "telephone1"           =>       $request->input("telephone1"),
            "categorie"            =>       $request->input("categorie"),
            "statut"               =>       $request->input("statut"),
            "autre_statut"         =>       $request->input("autre_statut"),
            "adresse"              =>       $request->input("adresse"),
            "rccm"                 =>       $request->input("registre_commerce"), /* choisir ninea ou rccm */
            "ninea"                =>       $request->input("ninea"), /* enregistrer le numero de la valeur choisi (ninea ou rccm) */
            "quitus"               =>       $request->input("quitus"),
            "debut_quitus"         =>       $request->input("date_quitus"),
            "prenom_responsable"   =>       $request->input("prenom"),
            "nom_responsable"      =>       $request->input("nom"),
            "email2"               =>       $request->input("email2"),
            "telephone2"           =>       $request->input("telephone2"),
            "fonction_responsable" =>       $request->input("fonction_responsable"),
            "departements_id"      =>       $request->input("departement"),
            "users_id"             =>       $user->id
        ]);

        $collective->save();

        Alert::success("Enregistrée !", "avec succès");

        return redirect()->back();
    }
}
