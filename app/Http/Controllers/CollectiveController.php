<?php

namespace App\Http\Controllers;

use App\Models\Collective;
use App\Models\Collectivemodule;
use App\Models\Commune;
use App\Models\Demandeur;
use App\Models\Departement;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class CollectiveController extends Controller
{
    public function index()
    {
        $collectives = Collective::get();
        $departements = Departement::orderBy("created_at", "desc")->get();
        $communes = Commune::orderBy("created_at", "desc")->get();
        $modules = Module::orderBy("created_at", "desc")->get();
        return view('collectives.index', compact('collectives', 'departements', 'communes', 'modules'));
    }
    public function store(Request $request)
    {
        dd("store");
        $this->validate($request, [
            "name"                  =>      "required|string|unique:collectives,name,except,id",
            "sigle"                 =>      "required|string|unique:collectives,sigle,except,id",
            "email"                 =>      "required|email|unique:users,email,except,id",
            "fixe"                  =>      "required|string|unique:collectives,fixe,except,id",
            "telephone"             =>      "required|string|unique:collectives,telephone,except,id",
            "module"                =>      "required|string",
            "adresse"               =>      "required|string",
            "statut"                =>      "required|string",
            "description"           =>      "required|string",
            "projetprofessionnel"   =>      "required|string",
            "departement"           =>      "required|string",
            "civilite"              =>      "required|string",
            "prenom"                =>      "required|string",
            "nom"                   =>      "required|string",
            "fonction_responsable"  =>      "required|string",
            "telephone1"            =>      "required|string",
            "email_responsable"     =>      "required|string",
        ]);

        $annee = date('y');
        $count_collective = Collective::get()->count();

        if ($count_collective > 0) {
            $id         = Collective::get()->last()->id;
            $collective = Collective::findOrFail($id);
            $numero     = $collective?->numero;
            $numero_collective  = ++$numero;
        } else {
            $count_collective = ++$count_collective;
            $longueur = strlen($count_collective);
            if ($longueur == 1) {
                $numero_collective   =   strtolower("0000" . $count_collective);
            } elseif ($longueur >= 2 && $longueur < 3) {
                $numero_collective   =   strtolower("000" . $count_collective);
            } elseif ($longueur >= 3 && $longueur < 4) {
                $numero_collective   =   strtolower("00" . $count_collective);
            } elseif ($longueur >= 4 && $longueur < 5) {
                $numero_collective   =   strtolower("0" . $count_collective);
            } else {
                $numero_collective   =   strtolower($count_collective);
            }
            $numero_collective = 'C' . $annee . '' . $numero_collective;
        }

        $numero_Demande = 'D' . '' . $numero_collective;

        $departement = Departement::findOrFail($request->input("departement"));
        $regionid = $departement->region->id;

        /*$user = new User([
            'firstname'             =>      $request->input("name"),
            'name'                  =>      $request->input("sigle"),
            'email'                 =>      $request->input('email'),
            "fixe"                  =>      $request->input("fixe"),
            "telephone"             =>      $request->input("telephone"),
            "adresse"               =>      $request->input("adresse"),
            'password'              =>      Hash::make($request->input('email')),
            "bp"                    =>      $request->input("bp"),
            'created_by'            =>      Auth::user()->id,
            'updated_by'            =>      Auth::user()->id
        ]);
        $user->save(); */

        /* $demandeur = new Demandeur([
            'numero_dossier'                 =>  $numero_Demande,
            'type'                           =>  'collective',
            "departements_id"                =>  $request->input("departement"),
            "regions_id"                     =>  $regionid,
            'users_id'                       =>  Auth::user()->id,
        ]);

        $demandeur->save(); */

        $collective = Collective::create([
            "name"                      =>       $request->input("name"),
            "sigle"                     =>       $request->input("sigle"),
            "numero"                    =>       $numero_collective,
            "description"               =>       $request->input("description"),
            "projetprofessionnel"       =>       $request->input("projetprofessionnel"),
            "telephone"                 =>      $request->input("telephone"),
            "email1"                    =>       $request->input("email_responsable"),
            "fixe"                      =>       $request->input("fixe"),
            "telephone1"                =>       $request->input("telephone1"),
            "statut_juridique"          =>       $request->input("statut"),
            "autre_statut_juridique"    =>       $request->input("autre_statut"),
            "statut_demande"            =>       'attente',
            "prenom_responsable"        =>       $request->input("prenom"),
            "nom_responsable"           =>       $request->input("nom"),
            "fonction_responsable"      =>       $request->input("fonction_responsable"),
            "departements_id"           =>       $request->input("departement"),
            "modules_id"                =>       $request->input("module"),
            "regions_id"                =>       $regionid,
            /* "demandeurs_id"             =>       $demandeur->id, */
            "users_id"                  =>       Auth::user()->id
        ]);

        $collective->save();

        Alert::success("Enregistrée !", "avec succès");

        return redirect()->back();
    }
    public function addCollective(Request $request)
    {
        $this->validate($request, [
            "name"                  =>      "required|string|unique:collectives,name,except,id",
            "sigle"                 =>      "required|string|unique:collectives,sigle,except,id",
            "email"                 =>      "required|email|unique:users,email,except,id",
            "fixe"                  =>      "required|string|unique:collectives,fixe,except,id",
            "telephone"             =>      "required|string|unique:collectives,telephone,except,id",
            "module"                =>      "required|string",
            "adresse"               =>      "required|string",
            "statut"                =>      "required|string",
            "description"           =>      "required|string",
            "projetprofessionnel"   =>      "required|string",
            "departement"           =>      "required|string",
            "civilite"              =>      "required|string",
            "prenom"                =>      "required|string",
            "nom"                   =>      "required|string",
            "fonction_responsable"  =>      "required|string",
            "telephone1"            =>      "required|string",
            "email_responsable"     =>      "required|string",
        ]);
        
        $annee = date('y');
        $rand = rand(0, 999);
        $letter = chr(rand(65, 90));
        $random = $rand . '' . $letter;
        $longueur = strlen($random);

        if ($longueur == 1) {
            $numero_collective   =   strtoupper("0000" . $random);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $numero_collective   =   strtoupper("000" . $random);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $numero_collective   =   strtoupper("00" . $random);
        } elseif ($longueur >= 4 && $longueur < 5) {
            $numero_collective   =   strtoupper("0" . $random);
        } else {
            $numero_collective   =   strtoupper($random);
        }
        $numero_collective = 'C' . $annee . $numero_collective;

        $departement = Departement::findOrFail($request->input("departement"));
        $regionid = $departement->region->id;

        $departement = Departement::findOrFail($request->input("departement"));
        $regionid = $departement->region->id;

        /* $user = new User([
            'firstname'             =>      $request->input("name"),
            'name'                  =>      $request->input("sigle"),
            'email'                 =>      $request->input('email'),
            "fixe"                  =>      $request->input("fixe"),
            "telephone"             =>      $request->input("telephone"),
            "adresse"               =>      $request->input("adresse"),
            'password'              =>      Hash::make($request->input('email')),
            "bp"                    =>      $request->input("bp"),
            'created_by'            =>      Auth::user()->id,
            'updated_by'            =>      Auth::user()->id
        ]);

        $user->save(); */

       /*  $demandeur = new Demandeur([
            'numero_dossier'                 =>  $numero_Demande,
            'type'                           =>  'collective',
            "departements_id"                =>  $request->input("departement"),
            "regions_id"                     =>  $regionid,
            'users_id'                       =>  Auth::user()->id,
        ]);

        $demandeur->save(); */

        $user = User::create([
            'name'          =>  $request->input('name'),
            'sigle'         =>  $request->input('sigle'),
            'email'         =>  $request->input('email'),
            'telephone'     =>  $request->input('telephone'),
            'adresse'       =>  $request->input('adresse'),
            'password'      =>  Hash::make($request->email),
        ]);

        $user->save();

        $user->update([
            'username'                          => $request->input('name').''.$user->id,
        ]);

        $user->save();

        $user->assignRole('Demandeur');

        $collective = Collective::create([
            "name"                      =>       $request->input("name"),
            "sigle"                     =>       $request->input("sigle"),
            "numero"                    =>       $numero_collective,
            "description"               =>       $request->input("description"),
            "projetprofessionnel"       =>       $request->input("projetprofessionnel"),
            "telephone"                 =>       $request->input("telephone"),
            "email1"                    =>       $request->input("email"),
            "email_responsable"         =>       $request->input("email_responsable"),
            "fixe"                      =>       $request->input("fixe"),
            "adresse"                   =>       $request->input("adresse"),
            "bp"                        =>       $request->input("bp"),
            "statut_juridique"          =>       $request->input("statut"),
            "autre_statut_juridique"    =>       $request->input("autre_statut"),
            "statut_demande"            =>       'attente',
            "civilite_responsable"      =>       $request->input("civilite"),
            "prenom_responsable"        =>       $request->input("prenom"),
            "nom_responsable"           =>       $request->input("nom"),
            "telephone_responsable"     =>       $request->input("telephone1"),
            "fonction_responsable"      =>       $request->input("fonction_responsable"),
            "departements_id"           =>       $request->input("departement"),
            "modules_id"                =>       $request->input("module"),
            "regions_id"                =>       $regionid,
            /* "demandeurs_id"             =>       $demandeur->id, */
            'users_id'                  =>  $user->id,
        ]);

        $collective->save();

        Alert::success("Enregistrée !", "avec succès");

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $collective = Collective::findOrFail($id);
        $user_id = $collective?->users_id;
       /*  $demandeur = $collective->demandeur; */

        $this->validate($request, [
            "name"                  =>      ["required", "string", Rule::unique(Collective::class)->ignore($id)],
            "sigle"                 =>      ["required", "string", Rule::unique(Collective::class)->ignore($id)],
            "email"                 =>      ["required", "email", Rule::unique(User::class)->ignore($id)],
            "fixe"                  =>      ["required", "string", "unique:collectives,fixe,{$id}"],
            "telephone"             =>      ["required", "string", "unique:collectives,telephone,{$id}"],
            "module"                =>      ["required", "string"],
            "adresse"               =>      ["required", "string"],
            "statut"                =>      ["required", "string"],
            "description"           =>      ["required", "string"],
            "projetprofessionnel"   =>      ["required", "string"],
            "departement"           =>      ["required", "string"],
            "civilite"              =>      ["required", "string"],
            "prenom"                =>      ["required", "string"],
            "nom"                   =>      ["required", "string"],
            "fonction_responsable"  =>      ["required", "string"],
            "telephone_responsable" =>      ["required", "string"],
            "email_responsable"     =>      ["required", "string"],
        ]);

        $annee = date('y');
        $count_collective = Collective::get()->count();
        $id         = Collective::get()->last()->id;
        $collective = Collective::findOrFail($id);
        $numero     = $collective?->numero;

        if ($count_collective > 0 && isset($numero)) {
            $numero_collective  = ++$numero;
        } else {
            $count_collective = ++$count_collective;
            $longueur = strlen($count_collective);
            if ($longueur == 1) {
                $numero_collective   =   strtolower("0000" . $count_collective);
            } elseif ($longueur >= 2 && $longueur < 3) {
                $numero_collective   =   strtolower("000" . $count_collective);
            } elseif ($longueur >= 3 && $longueur < 4) {
                $numero_collective   =   strtolower("00" . $count_collective);
            } elseif ($longueur >= 4 && $longueur < 5) {
                $numero_collective   =   strtolower("0" . $count_collective);
            } else {
                $numero_collective   =   strtolower($count_collective);
            }
            $numero_collective = 'C' . $annee . '' . $numero_collective;
        }

        $numero_Demande = 'D' . '' . $annee . '' . $numero_collective;

        $departement = Departement::findOrFail($request->input("departement"));
        $regionid = $departement->region->id;

     /*    $demandeur->update([
            'numero_dossier'                 =>  $numero_Demande,
            'type'                           =>  'collective',
            "departements_id"                =>  $request->input("departement"),
            "regions_id"                     =>  $regionid,
            'users_id'                       =>  Auth::user()->id,
        ]);

        $demandeur->save(); */

        $collective->update([
            "name"                      =>       $request->input("name"),
            "sigle"                     =>       $request->input("sigle"),
            "numero"                    =>       $numero_collective,
            "description"               =>       $request->input("description"),
            "projetprofessionnel"       =>       $request->input("projetprofessionnel"),
            "telephone"                 =>       $request->input("telephone"),
            "email1"                    =>       $request->input("email"),
            "email_responsable"         =>       $request->input("email_responsable"),
            "fixe"                      =>       $request->input("fixe"),
            "adresse"                   =>       $request->input("adresse"),
            "bp"                        =>       $request->input("bp"),
            "statut_juridique"          =>       $request->input("statut"),
            "autre_statut_juridique"    =>       $request->input("autre_statut"),
            "statut_demande"            =>       'attente',
            "civilite_responsable"      =>       $request->input("civilite"),
            "prenom_responsable"        =>       $request->input("prenom"),
            "nom_responsable"           =>       $request->input("nom"),
            "telephone_responsable"     =>       $request->input("telephone1"),
            "fonction_responsable"      =>       $request->input("fonction_responsable"),
            "departements_id"           =>       $request->input("departement"),
            "modules_id"                =>       $request->input("module"),
            "regions_id"                =>       $regionid,
            /* "demandeurs_id"             =>       $demandeur->id, */
            "users_id"                  =>       $user_id
        ]);

        $collective->save();

        Alert::success("Enregistrée !", "avec succès");

        return Redirect::route("collectives.index");

    }

    public function edit($id)
    {
        $collective = Collective::findOrFail($id);
        $departements = Departement::orderBy("created_at", "desc")->get();
        $modules = Module::orderBy("created_at", "desc")->get();
        return view("collectives.update", compact("collective", "departements", "modules"));
    }
    public function show($id)
    {
        $collective = Collective::findOrFail($id);
        $collectivemodules = Collectivemodule::where("collectives_id", $id)->get();
        return view('collectives.show', compact('collective', 'collectivemodules'));
    }

    public function destroy($id)
    {
        $collective   = Collective::find($id);

        $date = date('dmYHis');

        $collective->update([
            'numero'    => $collective->numero.'-'.$date,
        ]);

        $collective->save();

        $collective->delete();

        Alert::success('Demande', 'supprimée');

        return redirect()->back();
    }
}
