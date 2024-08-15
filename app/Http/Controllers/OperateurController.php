<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Operateur;
use App\Models\Operateureference;
use App\Models\User;
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
        $operateurs = Operateur::query()->orderBy('created_at', 'desc')->orderByDesc('created_at')->get();
        $departements = Departement::orderBy("created_at", "desc")->get();
        return view("operateurs.index", compact("operateurs", "departements"));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            "name"                  =>      "required|string|unique:operateurs,name,except,id",
            "sigle"                 =>      "required|string|unique:operateurs,sigle,except,id",
            "numero_agrement"       =>      "required|string|unique:operateurs,numero_agrement,except,id",
            "email1"                =>      "required|email|unique:operateurs,email1,except,id",
            "fixe"                  =>      "required|string|unique:operateurs,fixe,except,id",
            "telephone1"            =>      "required|string|unique:operateurs,telephone1,except,id",
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
            "email2"                =>      "required|email|unique:operateurs,email2,except,id",
            "telephone2"            =>      "required|string|unique:operateurs,telephone2,except,id",
            "fonction_responsable"  =>      "required|string",
        ]);

        $user = new User([
            /* 'civilite'              =>      $request->input("civilite"), */
            'firstname'             =>      $request->input("name"),
            'name'                  =>      $request->input("sigle"),
            'username'              =>      $request->input("email1"),
            'email'                 =>      $request->input('email1'),
            "telephone"             =>      $request->input("telephone1"),
            'lieu_naissance'        =>      $request->input("adresse"),
            "adresse"               =>      $request->input("adresse"),
            'password'              =>      Hash::make($request->input('email1')),
            "bp"                    =>      $request->input("bp"),
            'created_by'            =>      Auth::user()->id,
            'updated_by'            =>      Auth::user()->id
        ]);

        $user->save();

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
            "adresse"              =>       $request->input("adresse"),
            "rccm"                 =>       $request->input("registre_commerce"), /* choisir ninea ou rccm */
            "ninea"                =>       $request->input("ninea"), /* enregistrer le numero de la valeur choisi (ninea ou rccm) */
            "quitus"               =>       $request->input("quitus"),
            "debut_quitus"         =>       $request->input("date_quitus"),
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
            "numero_agrement"       =>      ['required', 'string', Rule::unique(Operateur::class)->ignore($id)->whereNull('deleted_at')],
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
            "email2"                =>      ['required', 'string', Rule::unique(Operateur::class)->ignore($id)->whereNull('deleted_at')],
            "telephone2"            =>      ['required', 'string', Rule::unique(Operateur::class)->ignore($id)->whereNull('deleted_at')],
            "fonction_responsable"  =>      ['required', 'string'],
        ]);

        $user->update([
            /* 'civilite'              =>      $request->input("civilite"), */
            'firstname'             =>      $request->input("name"),
            'name'                  =>      $request->input("sigle"),
            "telephone"             =>      $request->input("telephone1"),
            'email'                 =>      $request->input('email1'),
            'lieu_naissance'        =>      $request->input("adresse"),
            "adresse"               =>      $request->input("adresse"),
            "bp"                    =>      $request->input("bp"),
            'updated_by'            =>      Auth::user()->id
        ]);

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
            "adresse"              =>       $request->input("adresse"),
            "rccm"                 =>       $request->input("registre_commerce"), /* choisir ninea ou rccm */
            "ninea"                =>       $request->input("ninea"), /* enregistrer le numero de la valeur choisi (ninea ou rccm) */
            "quitus"               =>       $request->input("quitus"),
            "debut_quitus"         =>       $request->input("date_quitus"),
            "civilite_responsable" =>       $request->input("civilite"),
            "prenom_responsable"   =>       $request->input("prenom"),
            "nom_responsable"      =>       $request->input("nom"),
            "email2"               =>       $request->input("email2"),
            "telephone2"           =>       $request->input("telephone2"),
            "fonction_responsable" =>       $request->input("fonction_responsable"),
            "departements_id"      =>       $request->input("departement"),
            "users_id"             =>       $user->id
        ]);

        Alert::success("L'opérateur " . $operateur->name, ' a été modifié avec succès');

        return redirect()->back();
    }

    public function show($id)
    {
        $operateur = Operateur::findOrFail($id);
        $operateureferences = Operateureference::get();
        return view("operateurs.show", compact("operateur", "operateureferences"));
    }

    public function destroy($id)
    {
        $operateur = Operateur::find($id);
        $operateur->delete();

        Alert::success("L'opérateur " . $operateur->name, 'a été supprimé avec succès');
        return redirect()->back();
    }
    function fetch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('modules')
                ->where('name', 'LIKE', "%{$query}%")
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
    public function showOperateur($id)
    {
        $operateur = Operateur::findOrFail($id);
        $operateureferences = Operateureference::get();

        return view('operateureferences.show', compact('operateur', 'operateureferences'));
    }
    public function validateOperateur($id)
    {
        $operateur = Operateur::findOrFail($id);
        $count_agreer = $operateur->operateurmodules->where('statut', 'agréer')->count();
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

        return redirect()->back();
    }
}
