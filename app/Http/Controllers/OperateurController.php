<?php

namespace App\Http\Controllers;

use App\Models\Commissionagrement;
use App\Models\Departement;
use App\Models\Operateur;
use App\Models\Operateureference;
use App\Models\Operateurequipement;
use App\Models\Operateurformateur;
use App\Models\Operateurlocalite;
use App\Models\Operateurmodule;
use App\Models\Region;
use App\Models\User;
use App\Models\Validationoperateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class OperateurController extends Controller
{
    public function index()
    {
        $operateurs = Operateur::orderBy('created_at', 'desc')->get();
        $departements = Departement::orderBy("created_at", "desc")->get();
        $operateur_agreer   = Operateur::where('statut_agrement', 'agréer')->count();
        $operateur_rejeter   = Operateur::where('statut_agrement', 'rejeter')->count();
        $operateur_nouveau   = Operateur::where('statut_agrement', 'nouveau')->count();
        $operateur_total   = Operateur::where('statut_agrement', 'agréer')->orwhere('statut_agrement', 'rejeter')->orwhere('statut_agrement', 'nouveau')->count();
        if (isset($operateur_total) && $operateur_total > '0') {
            $pourcentage_agreer = ((($operateur_agreer) / ($operateur_total)) * 100);
            $pourcentage_rejeter = ((($operateur_rejeter) / ($operateur_total)) * 100);
            $pourcentage_nouveau = ((($operateur_nouveau) / ($operateur_total)) * 100);
        } else {
            $pourcentage_agreer = "0";
            $pourcentage_rejeter = "0";
            $pourcentage_nouveau = "0";
        }

        return view("operateurs.index", compact("operateurs", "departements", "operateur_agreer", "operateur_rejeter", "pourcentage_agreer", "pourcentage_rejeter", "operateur_nouveau", "pourcentage_nouveau"));
    }

    public function agrement()
    {
        
        $operateurs = Operateur::query()->orderBy('created_at', 'desc')->orderByDesc('created_at')->get();
        $departements = Departement::orderBy("created_at", "desc")->get();

        $operateurs = Operateur::orderBy('created_at', 'desc')->get();
        $operateur_new   = Operateur::where('type_demande', 'New')->count();
        $operateur_renew   = Operateur::where('type_demande', 'Renew')->count();
        $operateur_total   = Operateur::where('type_demande', 'New')->orwhere('type_demande', 'Renew')->count();
        if (isset($operateur_total) && $operateur_total > '0') {
            $pourcentage_new = ((($operateur_new) / ($operateur_total)) * 100);
            $pourcentage_renew = ((($operateur_renew) / ($operateur_total)) * 100);
        } else {
            $pourcentage_new = "0";
            $pourcentage_renew = "0";
        }

        return view("operateurs.agrements.index", compact("operateurs", "departements", "operateur_new", "operateur_renew", "pourcentage_new", "pourcentage_renew"));
    }

    //cette fonction permet de valider l'agrement des operateurs
    public function agrements($id)
    {
        $operateur = Operateur::findOrFail($id);
        $operateurs = Operateur::get();
        $operateureferences = Operateureference::get();
        return view("operateurs.agrement", compact("operateurs", "operateur", "operateureferences"));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            "name"                  => ["required", "string", Rule::unique('operateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "sigle"                 => ["required", "string", Rule::unique('operateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "numero_agrement"       => ["nullable", "string", Rule::unique('operateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "email1"                => ["required", "string", Rule::unique('operateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "fixe"                  => ["required", "min:9", "max:9", "string", Rule::unique('operateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "telephone1"            => ["required", "min:9", "max:9", "string", Rule::unique('operateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "categorie"             =>      "required|string",
            "statut"                =>      "required|string",
            "departement"           =>      "required|string",
            "adresse"               =>      "required|string",
            "ninea"                 =>      "required|string",
            "registre_commerce"     =>      "required|string",
            "quitus"                =>      "required|string",
            "date_quitus"           =>      "required|string",
            "civilite"              =>      "required|string",
            "prenom"                =>      "required|string",
            "nom"                   =>      "required|string",
            "email2"                => ["required", "string", Rule::unique('operateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "telephone2"            => ["required", "min:9", "max:9", "string", Rule::unique('operateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "fonction_responsable"  =>      "required|string",
        ]);

        /*  $user = new User([
            'firstname'             =>      $request->input("prenom"),
            'name'                  =>      $request->input("noms"),
            'username'              =>      $request->input("sigle"),
            'email'                 =>      $request->input('email1'),
            "telephone"             =>      $request->input("telephone1"),
            'lieu_naissance'        =>      $request->input("adresse"),
            "adresse"               =>      $request->input("adresse"),
            'password'              =>      Hash::make($request->input('email1')),
            "bp"                    =>      $request->input("bp"),
            'created_by'            =>      Auth::user()->id,
            'updated_by'            =>      Auth::user()->id
        ]);

        $user->save(); */

        $user = Auth::user();

        $operateur_total = Operateur::where('users_id', $user->id)->count();

        if ($operateur_total >= 1) {
            Alert::warning('Attention ! ', 'Vous avez atteint le nombre de demandes autoriées');
            return redirect()->back();
        } else {

            $operateur = Operateur::create([
                "name"                 =>       $request->input("name"),
                "sigle"                =>       $request->input("sigle"),
                "numero_agrement"      =>       null,
                "email1"               =>       $request->input("email1"),
                "fixe"                 =>       $request->input("fixe"),
                "telephone1"           =>       $request->input("telephone1"),
                "categorie"            =>       $request->input("categorie"),
                "statut"               =>       $request->input("statut"),
                "autre_statut"         =>       $request->input("autre_statut"),
                "type_demande"         =>       $request->input("type_demande"),
                "adresse"              =>       $request->input("adresse"),
                "rccm"                 =>       $request->input("registre_commerce"), /* choisir ninea ou rccm */
                "ninea"                =>       $request->input("ninea"), /* enregistrer le numero de la valeur choisi (ninea ou rccm) */
                "quitus"               =>       $request->input("quitus"),
                "debut_quitus"         =>       $request->input("date_quitus"),
                "bp"                   =>       $request->input("bp"),
                "annee_agrement"       =>       date('Y-m-d'),
                "statut_agrement"      =>       'nouveau',
                "civilite_responsable" =>       $request->input("civilite"),
                "prenom_responsable"   =>       $request->input("prenom"),
                "nom_responsable"      =>       $request->input("nom"),
                "email2"               =>       $request->input("email2"),
                "telephone2"           =>       $request->input("telephone2"),
                "fonction_responsable" =>       $request->input("fonction_responsable"),
                "departements_id"      =>       $request->input("departement"),
                "users_id"             =>       $user->id
            ]);

            $operateur->save();

            Alert::success("L'opérateur "  . $operateur->sigle, " a été ajouté avec succès");

            return redirect()->back();
        }
    }
    public function addOperateur(Request $request)
    {
        $this->validate($request, [
            "name"                  => ["required", "string", Rule::unique('operateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "sigle"                 => ["required", "string", Rule::unique('operateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "numero_agrement"       => ["required", "string", Rule::unique('operateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "email1"                => ["required", "string", Rule::unique('operateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "fixe"                  => ["required", "min:9", "max:9", "string", Rule::unique('operateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "telephone1"            => ["required", "min:9", "max:9", "string", Rule::unique('operateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "categorie"             =>      "required|string",
            "statut"                =>      "required|string",
            "departement"           =>      "required|string",
            "adresse"               =>      "required|string",
            "ninea"                 =>      "required|string",
            "registre_commerce"     =>      "required|string",
            "quitus"                =>      "required|string",
            "date_quitus"           =>      "required|string",
            "civilite"              =>      "required|string",
            "prenom"                =>      "required|string",
            "nom"                   =>      "required|string",
            "email2"                => ["required", "string", Rule::unique('operateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "telephone2"            => ["required", "min:9", "max:9", "string", Rule::unique('operateurs')->where(function ($query) {
                return $query->whereNull('deleted_at');
            })],
            "fonction_responsable"  =>      "required|string",
        ]);

        $user = new User([
            /* 'civilite'              =>      $request->input("civilite"), */
            'firstname'             =>      $request->input("prenom"),
            'name'                  =>      $request->input("noms"),
            'username'              =>      $request->input("sigle"),
            'email'                 =>      $request->input('email1'),
            "telephone"             =>      $request->input("telephone1"),
            'lieu_naissance'        =>      $request->input("adresse"),
            "adresse"               =>      $request->input("adresse"),
            'password'              =>      Hash::make($request->input('email1')),
            'created_by'            =>      Auth::user()->id,
            'updated_by'            =>      Auth::user()->id
        ]);

        $user->save();

        $user->assignRole('Demandeur');

        $operateur = Operateur::create([
            "name"                 =>       $request->input("name"),
            "sigle"                =>       $request->input("sigle"),
            "numero_agrement"      =>       $request->input("numero_agrement"),
            "email1"               =>       $request->input("email1"),
            "fixe"                 =>       $request->input("fixe"),
            "telephone1"           =>       $request->input("telephone1"),
            "categorie"            =>       $request->input("categorie"),
            "statut"               =>       $request->input("statut"),
            "autre_statut"         =>       $request->input("autre_statut"),
            "type_demande"         =>       $request->input("type_demande"),
            "adresse"              =>       $request->input("adresse"),
            "rccm"                 =>       $request->input("registre_commerce"), /* choisir ninea ou rccm */
            "ninea"                =>       $request->input("ninea"), /* enregistrer le numero de la valeur choisi (ninea ou rccm) */
            "quitus"               =>       $request->input("quitus"),
            "bp"                   =>       $request->input("bp"),
            "debut_quitus"         =>       $request->input("date_quitus"),
            "annee_agrement"       =>       date('Y-m-d'),
            "statut_agrement"      =>       'nouveau',
            "civilite_responsable" =>       $request->input("civilite"),
            "prenom_responsable"   =>       $request->input("prenom"),
            "nom_responsable"      =>       $request->input("nom"),
            "email2"               =>       $request->input("email2"),
            "telephone2"           =>       $request->input("telephone2"),
            "fonction_responsable" =>       $request->input("fonction_responsable"),
            "departements_id"      =>       $request->input("departement"),
            "users_id"             =>       $user->id
        ]);

        $operateur->save();
        $user->assignRole('Operateur');

        Alert::success("L'opérateur "  . $operateur->sigle, " a été ajouté avec succès");

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $operateur = Operateur::findOrFail($id);
        $user      = $operateur->user;

        $this->validate($request, [
            "name"                  =>      ['required', 'string', Rule::unique(Operateur::class)->ignore($id)->whereNull('deleted_at')],
            "sigle"                 =>      ['required', 'string', Rule::unique(Operateur::class)->ignore($id)->whereNull('deleted_at')],
            "numero_agrement"       =>      ['nullable', 'string', Rule::unique(Operateur::class)->ignore($id)->whereNull('deleted_at')],
            "email1"                =>      ['required', 'string', Rule::unique(Operateur::class)->ignore($id)->whereNull('deleted_at')],
            "fixe"                  =>      ['required', 'string', Rule::unique(Operateur::class)->ignore($id)->whereNull('deleted_at')],
            "telephone1"            =>      ['required', 'string', Rule::unique(Operateur::class)->ignore($id)->whereNull('deleted_at')],
            "categorie"             =>      ['required', 'string'],
            "statut"                =>      ['required', 'string'],
            "departement"           =>      ['required', 'string'],
            "adresse"               =>      ['required', 'string'],
            "ninea"                 =>      ['required', 'string'],
            "registre_commerce"     =>      ['required', 'string'],
            "quitus"                =>      ['required', 'string'],
            "date_quitus"           =>      ['required', 'string'],
            "civilite"              =>      ['required', 'string'],
            "prenom"                =>      ['required', 'string'],
            "nom"                   =>      ['required', 'string'],
            "type_demande"          =>      ['required', 'string'],
            "email2"                =>      ['required', 'string', Rule::unique(Operateur::class)->ignore($id)->whereNull('deleted_at')],
            "telephone2"            =>      ['required', 'string', Rule::unique(Operateur::class)->ignore($id)->whereNull('deleted_at')],
            "fonction_responsable"  =>      ['required', 'string'],
        ]);

        /*    $user->update([
            'firstname'             =>      $request->input("name"),
            'name'                  =>      $request->input("sigle"),
            "telephone"             =>      $request->input("telephone1"),
            'email'                 =>      $request->input('email1'),
            'lieu_naissance'        =>      $request->input("adresse"),
            "adresse"               =>      $request->input("adresse"),
            "bp"                    =>      $request->input("bp"),
            'updated_by'            =>      Auth::user()->id
        ]); */

        $operateur->update([
            "name"                 =>       $request->input("name"),
            "sigle"                =>       $request->input("sigle"),
            "numero_agrement"      =>       $request->input("numero_agrement"),
            "email1"               =>       $request->input("email1"),
            "fixe"                 =>       $request->input("fixe"),
            "telephone1"           =>       $request->input("telephone1"),
            "categorie"            =>       $request->input("categorie"),
            "statut"               =>       $request->input("statut"),
            "autre_statut"         =>       $request->input("autre_statut"),
            "type_demande"         =>       $request->input("type_demande"),
            "adresse"              =>       $request->input("adresse"),
            "rccm"                 =>       $request->input("registre_commerce"), /* choisir ninea ou rccm */
            "ninea"                =>       $request->input("ninea"), /* enregistrer le numero de la valeur choisi (ninea ou rccm) */
            "quitus"               =>       $request->input("quitus"),
            "debut_quitus"         =>       $request->input("date_quitus"),
            "bp"                   =>       $request->input("bp"),
            "civilite_responsable" =>       $request->input("civilite"),
            "prenom_responsable"   =>       $request->input("prenom"),
            "nom_responsable"      =>       $request->input("nom"),
            "email2"               =>       $request->input("email2"),
            "telephone2"           =>       $request->input("telephone2"),
            "fonction_responsable" =>       $request->input("fonction_responsable"),
            "departements_id"      =>       $request->input("departement"),
            "users_id"             =>       $user->id
        ]);

        Alert::success("L'opérateur " . $operateur->sigle, ' a été modifié avec succès');

        return redirect()->back();
    }

    public function edit($id)
    {
        $operateur = Operateur::findOrFail($id);
        $departements = Departement::orderBy("created_at", "desc")->get();
        return view("operateurs.update", compact("operateur", "departements"));
    }

    public function show($id)
    {
        $operateur = Operateur::findOrFail($id);
        $operateurs = Operateur::get();
        $operateureferences = Operateureference::get();
        return view("operateurs.show", compact("operateur", "operateureferences", "operateurs"));
    }

    public function showAgrement($id)
    {
        $operateur = Operateur::findOrFail($id);
        $operateurs = Operateur::get();
        $operateureferences = Operateureference::get();
        return view("operateurs.agrements.show", compact("operateur", "operateureferences", "operateurs"));
    }

    public function destroy($id)
    {
        $operateur = Operateur::find($id);
        $operateur->delete();

        Alert::success("Fait " . $operateur->sigle, 'a été supprimé');
        return redirect()->back();
    }
    function fetch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('modules')
                ->where('name', 'LIKE', "%{$query}%")
                ->distinct()
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative;width:100%;">';
            foreach ($data as $row) {
                $output .= '
                <li><a class="dropdown-item" href="#">' . $row->name . '</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    function fetchModuleOperateur(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('operateurmodules')
                ->where('module', 'LIKE', "%{$query}%")
                ->get()
                ->unique('module');
            $output = '<ul class="dropdown-menu" style="display:block; position:relative;width:100%;">';
            foreach ($data as $row) {
                $output .= '
                <li><a class="dropdown-item" href="#">' . $row->module . '</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    function fetchOperateurModule(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('operateurmodules')
                ->where('module', 'LIKE', "%{$query}%")
                ->get()
                ->unique('module');
            $output = '<ul class="dropdown-menu" style="display:block; position:relative;width:100%;">';
            foreach ($data as $row) {
                $output .= '
                <li><a class="dropdown-item" href="#">' . $row->module . '</a></li>
                ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    public function showReference($id)
    {
        $operateur = Operateur::findOrFail($id);
        $operateureferences = Operateureference::get();

        return view('operateureferences.show', compact('operateur', 'operateureferences'));
    }
    public function showEquipement($id)
    {
        $operateur = Operateur::findOrFail($id);
        $operateurequipements = Operateurequipement::get();

        return view('operateurequipements.show', compact('operateur', 'operateurequipements'));
    }
    public function showFormateur($id)
    {
        $operateur = Operateur::findOrFail($id);
        $operateurformateurs = Operateurformateur::get();

        return view('operateurformateurs.show', compact('operateur', 'operateurformateurs'));
    }
    public function showLocalite($id)
    {
        $operateur = Operateur::findOrFail($id);
        $operateurlocalites = Operateurlocalite::get();
        $regions = Region::get();

        return view('operateurlocalites.show', compact('operateur', 'operateurlocalites', 'regions'));
    }

    /* Validation automatique */
    public function validateOperateur($id)
    {
        $operateur = Operateur::findOrFail($id);

        $moduleoperateur_count = $operateur->operateurmodules->count();

        if ($moduleoperateur_count > 0) {
            if ($operateur->statut_agrement == 'nouveau'  || $operateur->statut_agrement == 'non retenu') {
                $operateur->update([
                    'statut_agrement'    => 'retenu',
                ]);

                $operateur->save();

                Alert::success("Effectué !", "l'opérateur " . $operateur?->sigle . ' a été retenu');

                return redirect()->back();
            } else {
                Alert::warning("Imopssible ", "Car l'opérateur " . $operateur?->sigle . ' a déjà été validé');

                return redirect()->back();
            }
        } else {
            Alert::warning('Désolez ! ', 'assurez-vous d\'avoir ajouté au moins un module');
            return redirect()->back();
        }





        /* Cette partie consistait à faire une validation automatique */

        /* $count_agreer = $operateur->operateurmodules->where('statut', 'agréer')->count();
        $count_rejeter = $operateur->operateurmodules->where('statut', 'rejeter')->count();
        $count_nouveau = $operateur->operateurmodules->where('statut', 'nouveau')->count();

        if ($count_agreer > 0) {
            $operateur->update([
                'statut_agrement'    => 'agréer',
                'motif'              => null,
                'date'               =>  date('Y-m-d'),
            ]);
            Alert::success("Effectué !", "l'opérateur " . $operateur->sigle . ' a été agréé');
        } elseif ($count_nouveau > 0) {
            Alert::warning('Désolez ! ', 'il reste des module à traiter');
            return redirect()->back();
        } elseif ($count_rejeter > 0) {
            $operateur->update([
                'statut_agrement'    => 'rejeter',
                'motif'              => 'rejeter',
                'date'               =>  date('Y-m-d'),
            ]);
            Alert::warning("Dommage !", "l'opérateur " . $operateur->sigle . " n'a pas été agréé");
        } else {
            Alert::warning('Désolez ! ', 'action impossible');
            return redirect()->back();
        }

        $operateur->save();

        return redirect()->back(); */
    }
    public function nonRetenu(Request $request, $id)
    {
        $this->validate($request, [
            "motif" => "required|string",
        ]);

        $operateur   = Operateur::findOrFail($id);

        if ($operateur->statut_agrement == 'nouveau' || $operateur->statut_agrement == 'retenu') {
            $operateur->update([
                'statut_agrement'    =>  'non retenu',
                'motif'              =>  $request->input('motif'),
            ]);

            $operateur->save();

            $validationoperateur = new Validationoperateur([
                'action'                =>  "non retenu",
                'motif'                 =>  $request->input('motif'),
                'validated_id'          =>  Auth::user()->id,
                'session'               =>  $operateur?->session_agrement,
                'operateurs_id'         =>  $operateur->id,

            ]);

            $validationoperateur->save();

            Alert::success('Effectué !', $operateur->sigle . " n'a pas été retenu");

            return redirect()->back();
        } else {
            Alert::warning("Imopssible ", "Car l'opérateur " . $operateur?->sigle . ' a déjà été validé');

            return redirect()->back();
        }
    }


    public function agreerOperateur($id)
    {
        $operateur = Operateur::findOrFail($id);
        $moduleoperateur_count = $operateur->operateurmodules->count();

        $count_nouveau = $operateur->operateurmodules->where('statut', 'nouveau')->count();

        if ($count_nouveau > 0) {
            Alert::warning('Désolez ! ', 'il reste des module à traiter');
            return redirect()->back();
        } elseif ($moduleoperateur_count <= '0') {
            Alert::warning('Désolez ! ', 'aucun module disponible pour cet opérateur');
            return redirect()->back();
        } else {
            $operateur->update([
                'statut_agrement'    => 'agréer',
                'motif'              => null,
                'date'               =>  date('Y-m-d'),
            ]);

            $operateur->save();

            $validateoperateur = new Validationoperateur([
                'validated_id'       =>       Auth::user()->id,
                'action'             =>      'agréer',
                'session'            =>      $operateur?->session_agrement,
                'operateurs_id'      =>      $operateur?->id

            ]);

            $validateoperateur->save();

            Alert::success("Effectué !", "l'opérateur " . $operateur?->sigle . ' a été agréé');
            return redirect()->back();
        }
    }

    public function retirerOperateur($id)
    {
        $operateur = Operateur::findOrFail($id);

        $operateur->update([
            'statut_agrement'    => 'retirer',
            'commissionagrements_id'    => null,
        ]);

        $operateur->save();

        $validateoperateur = new Validationoperateur([
            'validated_id'       =>       Auth::user()->id,
            'action'             =>      'retirer',
            'session'            =>      $operateur?->session_agrement,
            'operateurs_id'      =>      $operateur?->id

        ]);

        $validateoperateur->save();

        Alert::success("Effectué !", "l'opérateur " . $operateur->sigle . ' a été retiré');

        return redirect()->back();
    }
    public function devenirOperateur()
    {
        $departements = Departement::orderBy("created_at", "desc")->get();
        $user = Auth::user();
        $operateur = Operateur::where('users_id', $user->id)->get();
        $operateurs = Operateur::get();
        $operateur_total = $operateur->count();

        /*     foreach ($user->operateurs as $key => $op) {
            $count_modules = $op->operateurmodules->count();
        }
        if ($count_modules <= 0) {
            $statut_demande = 'invalide';
            $class_message = 'invalide';
        } elseif ($count_modules >= 1) {
            $statut_demande = 'valide';
            $class_message = 'valide';
        } */

        return view("operateurs.show-operateur", compact("operateur_total", "departements", "operateur", "operateurs"));
    }
}
