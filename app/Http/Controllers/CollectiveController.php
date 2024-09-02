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
use Illuminate\Support\Facades\DB;
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
        $today = date('Y-m-d');
        $count_today = Collective::where("created_at", "LIKE",  "{$today}%")->count();
        return view('collectives.index', compact('collectives', 'departements', 'communes', 'modules', 'count_today'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            "name"                  => ["required", "string", Rule::unique('collectives')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "sigle"                 => ["required", "string", Rule::unique('collectives')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "email1"                 => ["required", "string", Rule::unique('collectives')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "fixe"                  => ["required", "string", "min:9", "max:9", Rule::unique('collectives')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "telephone"             => ["required", "string", Rule::unique('collectives')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            /* "module"                =>      ["required","string"], */
            "adresse"               =>      ["required", "string"],
            "statut"                =>      ["required", "string"],
            "description"           =>      ["required", "string"],
            "projetprofessionnel"   =>      ["required", "string"],
            "departement"           =>      ["required", "string"],
            "civilite"              =>      ["required", "string"],
            "prenom"                =>      ["required", "string"],
            "nom"                   =>      ["required", "string"],
            "fonction_responsable"  =>      ["required", "string"],
            "telephone_responsable" => ["required", "string", "min:9", "max:9", Rule::unique('collectives')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "email_responsable"     => ["required", "string", Rule::unique('collectives')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
        ]);

        $user = Auth::user();

        $collective_total = Collective::where('users_id', $user->id)->count();

        if ($collective_total >= 1) {
            Alert::warning('Attention ! ', 'Vous avez atteint le nombre de demandes autoriées');
            return redirect()->back();
        } else {
            /*   $rand = rand(0, 999);
            $letter1 = chr(rand(65, 90));
            $letter2 = chr(rand(65, 90));
            $random = $letter1.''.$rand . '' . $letter2;
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
            } */
            $annee = date('y');
            $numero_collective = Collective::get()->last();
            if (isset($numero_collective)) {
                $numero_collective = Collective::get()->last()->numero;
                $numero_collective = ++$numero_collective;
                $longueur = strlen($numero_collective);
                if ($longueur <= 1) {
                    $numero_collective   =   strtolower("0000" . $numero_collective);
                } elseif ($longueur >= 2 && $longueur < 3) {
                    $numero_collective   =   strtolower("000" . $numero_collective);
                } elseif ($longueur >= 3 && $longueur < 4) {
                    $numero_collective   =   strtolower("00" . $numero_collective);
                } elseif ($longueur >= 4 && $longueur < 5) {
                    $numero_collective   =   strtolower("0" . $numero_collective);
                } else {
                    $numero_collective   =   strtolower($numero_collective);
                }
            } else {
                $numero_collective = "00001";
                $numero_collective = 'C' . $annee . $numero_collective;
            }

            $numero_collective = strtoupper($numero_collective);

            $departement = Departement::where('nom', $request->input("departement"))->get()->first();
            $regionid = $departement->region->id;

            /* $module_find    = DB::table('modules')->where('name', $request->input("module"))->first(); */

            $collective = Collective::create([
                "name"                      =>       $request->input("name"),
                "sigle"                     =>       $request->input("sigle"),
                "numero"                    =>       $numero_collective,
                "description"               =>       $request->input("description"),
                "projetprofessionnel"       =>       $request->input("projetprofessionnel"),
                "telephone"                 =>       $request->input("telephone"),
                "email1"                    =>       $request->input("email1"),
                "email_responsable"         =>       $request->input("email_responsable"),
                "fixe"                      =>       $request->input("fixe"),
                "adresse"                   =>       $request->input("adresse"),
                "bp"                        =>       $request->input("bp"),
                "statut_juridique"          =>       $request->input("statut"),
                "autre_statut_juridique"    =>       $request->input("autre_statut"),
                "statut_demande"            =>       'nouvelle',
                "civilite_responsable"      =>       $request->input("civilite"),
                "prenom_responsable"        =>       $request->input("prenom"),
                "nom_responsable"           =>       $request->input("nom"),
                "telephone_responsable"     =>       $request->input("telephone_responsable"),
                "fonction_responsable"      =>       $request->input("fonction_responsable"),
                "departements_id"           =>       $departement->id,
                /* "modules_id"                =>       $module_find->id, */
                "regions_id"                =>       $regionid,
                /* "demandeurs_id"             =>       $demandeur->id, */
                'users_id'                  =>       $user->id,
            ]);

            $collective->save();

            Alert::success("Enregistrée !", "avec succès");

            return redirect()->back();
        }
    }
    public function addCollective(Request $request)
    {
        $this->validate($request, [
            "name"                  => ["required", "string", Rule::unique('collectives')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "sigle"                 => ["nullable", "string", Rule::unique('collectives')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "email1"                => ["required", "string", Rule::unique('collectives')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "fixe"                  => ["required", "string", "min:9", "max:9", Rule::unique('collectives')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "telephone"             => ["required", "string", "min:9", "max:9", Rule::unique('collectives')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            /* "module"                =>      ["required","string"], */
            "adresse"               =>      ["required", "string"],
            "statut"                =>      ["required", "string"],
            "description"           =>      ["required", "string"],
            "projetprofessionnel"   =>      ["required", "string"],
            "departement"           =>      ["required", "string"],
            "civilite"              =>      ["required", "string"],
            "prenom"                =>      ["required", "string"],
            "nom"                   =>      ["required", "string"],
            "fonction_responsable"  =>      ["required", "string"],
            "telephone_responsable" =>      ["required", "string", "min:9", "max:9", Rule::unique('collectives')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "email_responsable"     => ["required", "string", Rule::unique('collectives')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
        ]);

        /* $annee = date('y');
        $rand = rand(0, 999);
        $letter1 = chr(rand(65, 90));
        $letter2 = chr(rand(65, 90));
        $random = $letter1.''.$rand . '' . $letter2;
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
        } */

        $annee = date('y');
        $numero_collective = Collective::get()->last();
        if (isset($numero_collective)) {
            $numero_collective = Collective::get()->last()->numero;
            $numero_collective = ++$numero_collective;
            $longueur = strlen($numero_collective);
            if ($longueur <= 1) {
                $numero_collective   =   strtolower("0000" . $numero_collective);
            } elseif ($longueur >= 2 && $longueur < 3) {
                $numero_collective   =   strtolower("000" . $numero_collective);
            } elseif ($longueur >= 3 && $longueur < 4) {
                $numero_collective   =   strtolower("00" . $numero_collective);
            } elseif ($longueur >= 4 && $longueur < 5) {
                $numero_collective   =   strtolower("0" . $numero_collective);
            } else {
                $numero_collective   =   strtolower($numero_collective);
            }
        } else {
            $numero_collective = "00001";
            $numero_collective = 'C' . $annee . $numero_collective;
        }

        $numero_collective = strtoupper($numero_collective);

        $departement = Departement::where("nom", $request->input("departement"))->first();
        $regionid = $departement->region->id;

        $user = User::create([
            'name'          =>  $request->input('name'),
            'sigle'         =>  $request->input('sigle'),
            'email'         =>  $request->input('email1'),
            'username'      =>  $request->input('email1'),
            'telephone'     =>  $request->input('telephone'),
            'adresse'       =>  $request->input('adresse'),
            'password'      =>  Hash::make($request->email),
        ]);

        $user->save();

        /*  $user->update([
            'username'                          => $request->input('name') . '' . $user->id,
        ]);

        $user->save(); */

        $user->assignRole('Demandeur');
        /* $user->assignRole('Collective'); */

        $collective = Collective::create([
            "name"                      =>       $request->input("name"),
            "sigle"                     =>       $request->input("sigle"),
            "numero"                    =>       $numero_collective,
            "description"               =>       $request->input("description"),
            "projetprofessionnel"       =>       $request->input("projetprofessionnel"),
            "telephone"                 =>       $request->input("telephone"),
            "email1"                    =>       $request->input("email1"),
            "email_responsable"         =>       $request->input("email_responsable"),
            "fixe"                      =>       $request->input("fixe"),
            "adresse"                   =>       $request->input("adresse"),
            "bp"                        =>       $request->input("bp"),
            "statut_juridique"          =>       $request->input("statut"),
            "autre_statut_juridique"    =>       $request->input("autre_statut"),
            "statut_demande"            =>       'nouvelle',
            "civilite_responsable"      =>       $request->input("civilite"),
            "prenom_responsable"        =>       $request->input("prenom"),
            "nom_responsable"           =>       $request->input("nom"),
            "telephone_responsable"     =>       $request->input("telephone_responsable"),
            "fonction_responsable"      =>       $request->input("fonction_responsable"),
            "departements_id"           =>       $departement->id,
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
            "name"                  => ["required", "string", Rule::unique('collectives')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })->ignore($id)],
            "sigle"                 => ["nullable", "string", Rule::unique('collectives')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })->ignore($id)],
            "email1"                => ["required", "string", Rule::unique('collectives')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })->ignore($id)],
            "fixe"                  => ["required", "string", "min:9", "max:9", Rule::unique('collectives')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })->ignore($id)],
            "telephone"             => ["required", "string", "min:9", "max:9", Rule::unique('collectives')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })->ignore($id)],
            /* "module"                =>      ["required", "string"], */
            "adresse"               =>      ["required", "string"],
            "statut"                =>      ["required", "string"],
            "description"           =>      ["required", "string"],
            "projetprofessionnel"   =>      ["required", "string"],
            "departement"           =>      ["required", "string"],
            "civilite"              =>      ["required", "string"],
            "prenom"                =>      ["required", "string"],
            "nom"                   =>      ["required", "string"],
            "fonction_responsable"  =>      ["required", "string"],
            "telephone_responsable" => ["required", "string", "min:9", "max:9", Rule::unique('collectives')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })->ignore($id)],
            "email_responsable"     => ["required", "string", Rule::unique('collectives')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })->ignore($id)],
        ]);

        $departement = Departement::where('nom', $request->input("departement"))->first();
        $regionid = $departement->region->id;

        $collective->update([
            "name"                      =>       $request->input("name"),
            "sigle"                     =>       $request->input("sigle"),
            "description"               =>       $request->input("description"),
            "projetprofessionnel"       =>       $request->input("projetprofessionnel"),
            "telephone"                 =>       $request->input("telephone"),
            "email1"                    =>       $request->input("email1"),
            "email_responsable"         =>       $request->input("email_responsable"),
            "fixe"                      =>       $request->input("fixe"),
            "adresse"                   =>       $request->input("adresse"),
            "bp"                        =>       $request->input("bp"),
            "statut_juridique"          =>       $request->input("statut"),
            "autre_statut_juridique"    =>       $request->input("autre_statut"),
            "civilite_responsable"      =>       $request->input("civilite"),
            "prenom_responsable"        =>       $request->input("prenom"),
            "nom_responsable"           =>       $request->input("nom"),
            "telephone_responsable"     =>       $request->input("telephone_responsable"),
            "fonction_responsable"      =>       $request->input("fonction_responsable"),
            "departements_id"           =>       $departement->id,
            /* "modules_id"                =>       $request->input("module"), */
            "regions_id"                =>       $regionid,
            /* "demandeurs_id"             =>       $demandeur->id, */
            "users_id"                  =>       $user_id
        ]);

        $collective->save();

        Alert::success("Modifier !", "avec succès");

        return Redirect::back();
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
        $collectives    = Collective::where('users_id', $collective?->users_id)->get();
        return view('collectives.show', compact('collective', 'collectivemodules', 'collectives'));
    }

    public function destroy($id)
    {
        $collective   = Collective::find($id);

        $collective->delete();

        Alert::success('Demande', 'supprimée');

        return redirect()->back();
    }
    public function demandesCollective()
    {
        $departements = Departement::orderBy("created_at", "desc")->get();
        $modules = Module::orderBy("created_at", "desc")->get();
        $user = Auth::user();
        $collective = Collective::where('users_id', $user->id)->get();
        $collective_total = $collective->count();

        return view("collectives.show-collective", compact("collective_total", "departements", "modules"));
    }
}
