<?php

namespace App\Http\Controllers;

use App\Models\Choixoperateur;
use App\Models\Collective;
use App\Models\Collectivemodule;
use App\Models\Departement;
use App\Models\Direction;
use App\Models\Domaine;
use App\Models\Evaluateur;
use App\Models\Formation;
use App\Models\Indisponible;
use App\Models\Individuelle;
use App\Models\Ingenieur;
use App\Models\Listecollective;
use App\Models\Module;
use App\Models\Onfpevaluateur;
use App\Models\Operateur;
use App\Models\Operateurmodule;
use App\Models\Programme;
use App\Models\Projet;
use App\Models\Region;
use App\Models\Statut;
use App\Models\TypesFormation;
use App\Models\Validationcollective;
use App\Models\Validationformation;
use App\Models\Validationindividuelle;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FormationController extends Controller
{

    public function __construct()
    {
        // examples:
        $this->middleware('auth');
        $this->middleware(['role:super-admin|admin']);
        /* $this->middleware(['permission:arrive-show']); */
        // or with specific guard
        /* $this->middleware(['role_or_permission:super-admin']); */
    }

    public function index()
    {
        $formations = Formation::where('statut', '!=', 'supprimer')->orderBy('created_at', 'desc')->get();

        $individuelles_formations_count = Formation::join('types_formations', 'types_formations.id', 'formations.types_formations_id')
            ->select('formations.*')
            ->where('types_formations.name', "individuelle")
            ->where('statut', '!=', 'supprimer')
            ->count();

        $collectives_formations_count = Formation::join('types_formations', 'types_formations.id', 'formations.types_formations_id')
            ->select('formations.*')
            ->where('types_formations.name', "collective")
            ->where('statut', '!=', 'supprimer')
            ->count();


        $qrcode = QrCode::size(200)->generate("tel:+221776994173");
        $today = date('Y-m-d');
        $count_today = Formation::where("created_at", "LIKE",  "{$today}%")->count();

        $modules = Module::orderBy("created_at", "desc")->get();
        $departements = Departement::orderBy("created_at", "desc")->get();
        $regions = Region::orderBy("created_at", "desc")->get();
        $operateurs = Operateur::orderBy("created_at", "desc")->get();
        $projets = Projet::orderBy("created_at", "desc")->get();
        $programmes = Programme::orderBy("created_at", "desc")->get();
        $choixoperateurs = Choixoperateur::orderBy("created_at", "desc")->get();
        $types_formations = TypesFormation::orderBy("created_at", "desc")->get();
        return view("formations.index", compact("qrcode", "count_today", "collectives_formations_count", "individuelles_formations_count", "formations", "modules", "departements", "regions", "operateurs", 'types_formations', 'projets', 'programmes', 'choixoperateurs'));
    }


    public function create()
    {
        return view("formations.create");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "name"                  =>   "required|string|unique:formations,name",
            "departement"           =>   "required|string",
            "lieu"                  =>   "required|string",
            "niveau_qualification"  =>   "required|string",
            "types_formation"       =>   "required|string",
            "titre"                 =>   "nullable|string",
            "date_debut"            =>   "nullable|date",
            "date_fin"              =>   "nullable|date",
        ]);

        $annee = date('y');

        /* $mois = date('m');
        $rand1 = rand(100, 999);
        $rand2 = chr(rand(65, 90));

        $rand = $rand1 . '' . $rand2; */

        $types_formation = TypesFormation::findOrFail($request->input('types_formation'));

        $count_formation = Formation::get()->count();

        $count_formation = ++$count_formation;

        $longueur = strlen($count_formation);

        if ($longueur == 1) {
            $code_formation   =   strtolower("000" . $count_formation);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $code_formation   =   strtolower("00" . $count_formation);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $code_formation   =   strtolower("0" . $count_formation);
        } else {
            $code_formation   =   strtolower($count_formation);
        }

        if ($types_formation->name == "individuelle") {
            $for = "F";
            $fin = "I";
        } else {
            $for = "F";
            $fin = "C";
        }

        $code_formation = $for . '' . $annee . '' . $code_formation . '' . $fin;

        /* $rand = $fic . '' . $mois . $annee . $rand; */

        $this->validate($request, [
            "name"                  =>   "required|string|unique:formations,name,except,id",
            "departement"           =>   "required|string",
            "lieu"                  =>   "required|string",
            /* "module"                =>   "required|string", */
            "niveau_qualification"  =>   "required|string",
            "titre"                 =>   "nullable|string",
            "date_debut"            =>   "nullable|date",
            "date_fin"              =>   "nullable|date",
        ]);
        $effectif_prevu = $request->input('prevue_h') + $request->input('prevue_f');
        $formation = new Formation([
            "code"                  =>   $code_formation,
            "name"                  =>   $request->input('name'),
            "regions_id"            =>   $request->input('region'),
            "departements_id"       =>   $request->input('departement'),
            "lieu"                  =>   $request->input('lieu'),
            /* "modules_id"            =>   $request->input('module'), */
            "operateurs_id"         =>   $request->input('operateur'),
            "types_formations_id"   =>   $request->input('types_formation'),
            "niveau_qualification"  =>   $request->input('niveau_qualification'),
            "numero_convention"     =>   $request->input('numero_convention'),
            "titre"                 =>   $request->input('titre'),
            "date_debut"            =>   $request->input('date_debut'),
            "date_fin"              =>   $request->input('date_fin'),
            "effectif_prevu"        =>   $effectif_prevu,
            "prevue_h"              =>   $request->input('prevue_h'),
            "prevue_f"              =>   $request->input('prevue_f'),
            "frais_operateurs"      =>   $request->input('frais_operateurs'),
            "frais_add"             =>   $request->input('frais_add'),
            "autes_frais"           =>   $request->input('autes_frais'),
            "projets_id"            =>   $request->input('projet'),
            "programmes_id"         =>   $request->input('programme'),
            "choixoperateurs_id"    =>   $request->input('choixoperateur'),
            "statut"                =>   "nouvelle",
            "annee"                 =>   $annee,

        ]);

        $formation->save();


        $statut = new Statut([
            "statut"                =>   "nouvelle",
            "formations_id"         =>   $formation->id,
        ]);

        $statut->save();


        Alert::success("Formation", "créée avec succès");

        return redirect()->back();
    }

    public function edit($id)
    {
        $formation = Formation::findOrFail($id);
        $departements = Departement::orderBy("created_at", "desc")->get();
        $types_formations = TypesFormation::orderBy("created_at", "desc")->get();
        $projets = Projet::orderBy("created_at", "desc")->get();
        $programmes = Programme::orderBy("created_at", "desc")->get();
        $choixoperateurs = Choixoperateur::orderBy("created_at", "desc")->get();
        return view("formations.update", compact("formation", "departements", "types_formations", 'projets', 'programmes', 'choixoperateurs'));
    }

    public function update(Request $request, $id)
    {
        $formation = Formation::findOrFail($id);

        $this->validate($request, [
            "name"                  =>   "required|string|unique:formations,name,{$formation->id}",
            "departement"           =>   "required|string",
            "lieu"                  =>   "required|string",
            "niveau_qualification"  =>   "required|string",
            "titre"                 =>   "nullable|string",
            "date_debut"            =>   "nullable|date",
            "date_fin"              =>   "nullable|date",
        ]);

        $effectif_prevu = $request->input('prevue_h') + $request->input('prevue_f');

        $formation->update([
            "name"                  =>   $request->input('name'),
            "regions_id"            =>   $request->input('region'),
            "departements_id"       =>   $request->input('departement'),
            "lieu"                  =>   $request->input('lieu'),
            "types_formations_id"   =>   $request->input('types_formation'),
            "niveau_qualification"  =>   $request->input('niveau_qualification'),
            "numero_convention"     =>   $request->input('numero_convention'),
            "titre"                 =>   $request->input('titre'),
            "date_debut"            =>   $request->input('date_debut'),
            "date_fin"              =>   $request->input('date_fin'),
            "effectif_prevu"        =>   $effectif_prevu,
            "prevue_h"              =>   $request->input('prevue_h'),
            "prevue_f"              =>   $request->input('prevue_f'),
            "frais_operateurs"      =>   $request->input('frais_operateurs'),
            "frais_add"             =>   $request->input('frais_add'),
            "autes_frais"           =>   $request->input('autes_frais'),
            "projets_id"            =>   $request->input('projet'),
            "programmes_id"         =>   $request->input('programme'),
            "choixoperateurs_id"    =>   $request->input('choixoperateur'),

        ]);

        $formation->save();

        Alert::success("Formation", "modifiée avec succès");

        return redirect()->back();
    }

    public function show($id)
    {
        $formation          = Formation::findOrFail($id);
        $type_formation     = $formation->types_formation->name;
        $operateur          = $formation->operateur;
        $module             = $formation->module;
        $ingenieur          = $formation->ingenieur;

        $count_demandes = count($formation->individuelles);

        $individuelles = Individuelle::orderBy("created_at", "desc")->get();
        $listecollectives = Listecollective::orderBy("created_at", "desc")->get();
        $evaluateurs = Evaluateur::orderBy("created_at", "desc")->get();
        $onfpevaluateurs = Onfpevaluateur::orderBy("created_at", "desc")->get();

        $collectivemodule = Collectivemodule::where('collectives_id', $formation->collectives_id)->get();

        $collectiveFormation = DB::table('formations')
            ->where('collectivemodules_id', $formation->collectivemodules_id)
            ->pluck('collectivemodules_id', 'collectivemodules_id')
            ->all();

        $collectivemodules = Collectivemodule::join('collectives', 'collectives.id', 'collectivemodules.collectives_id')
            ->select('collectivemodules.*')
            ->where('collectives.statut_demande', 'attente')
            ->whereBetween('collectivemodules.statut', ['attente', 'attente', 'retenu'])
            ->get();

        $collectiveModule = DB::table('collectivemodules')
            ->where('formations_id', $formation->id)
            ->pluck('formations_id', 'formations_id')
            ->all();

        $collectiveModuleCheck = DB::table('collectivemodules')
            ->where('formations_id', '!=', null)
            ->where('formations_id', '!=', $formation->id)
            ->pluck('formations_id', 'formations_id')
            ->all();

        return view(
            'formations.' . $type_formation . "s.show",
            compact(
                "evaluateurs",
                "formation",
                "count_demandes",
                "operateur",
                "module",
                "type_formation",
                "individuelles",
                "listecollectives",
                "collectiveFormation",
                "onfpevaluateurs",
                "ingenieur",
                "collectivemodules",
                "collectiveModule",
                "collectiveModuleCheck",
            )
        );
    }

    public function destroy($id)
    {
        $formation   = Formation::find($id);

        if (!empty($formation->types_formation->name) && $formation->types_formation->name == "collective") {
            foreach ($formation->listecollectives as $liste) {
            }
            if (!empty($liste)) {
                Alert::warning('Attention !', 'impossible de supprimer');
                return redirect()->back();
            } else {
                $formation->delete();
                Alert::success('Effectuée ! ' . 'formation supprimée');
                return redirect()->back();
            }
        } elseif (!empty($formation->types_formation->name) && $formation->types_formation->name == "individuelle") {
            foreach ($formation->individuelles as $individuelle) {
            }
            if (!empty($individuelle)) {
                Alert::warning('Attention !', 'impossible de supprimer');
                return redirect()->back();
            } else {
                $formation->delete();
                Alert::success('Effectuée ! ', 'formation supprimée');
                return redirect()->back();
            }
        } else {
            $formation->update([
                "statut"       =>   "supprimer",
            ]);

            $formation->save();


            $statut = new Statut([
                "statut"                =>   "supprimer",
                "formations_id"         =>   $formation->id,
            ]);

            $statut->save();

            Alert::success('Effectuée ! ', 'formation supprimée');

            return redirect()->back();
        }
    }

    public function addformationdemandeurs($idformation, $idmodule, $idlocalite)
    {
        $formation = Formation::findOrFail($idformation);
        $module = Module::findOrFail($idmodule);
        $region = Region::findOrFail($idlocalite);

        /* $individuelles = Individuelle::where('regions_id', $idlocalite)
            ->where('modules_id', $idmodule)
            ->where('statut', 'accepter')
            ->orWhere('statut', 'retirer')
            ->orWhere('statut', 'programmer')
            ->get(); */
        /* $individuelles = Individuelle::where('regions_id', $idlocalite)
            ->where('statut', 'attente')
            ->orWhere('statut', 'retirer')
            ->orWhere('statut', 'programmer')
            ->get(); */

        /* $individuelles = Individuelle::join('modules', 'modules.id', 'individuelles.modules_id')
            ->select('individuelles.*')
            ->where('modules.name', 'LIKE', "%{$module->name}%")
            ->where('regions_id', $idlocalite)
            ->where('statut', 'attente')
            ->orWhere('statut', 'retirer')
            ->orWhere('statut', 'retenu')
            ->orWhere('statut', 'programmer')
            ->get(); */
        /* dd($localite->nom); */
        $individuelles = Individuelle::join('modules', 'modules.id', 'individuelles.modules_id')
            ->join('regions', 'regions.id', 'individuelles.regions_id')
            ->select('individuelles.*')
            ->where('modules.name', 'LIKE', "%{$module->name}%")
            ->where('regions.nom', $region->nom)
            ->where('modules.name', 'LIKE', "%{$module->name}%")
            ->whereBetween('statut', ['attente', 'retirer', 'retenu'])
            ->get();

        /* dd($individuelles); */

        $candidatsretenus = Individuelle::where('formations_id', $idformation)
            ->get();

        $individuelleFormation = DB::table('individuelles')
            ->where('formations_id', $idformation)
            ->pluck('formations_id', 'formations_id')
            ->all();

        $individuelleFormationCheck = DB::table('individuelles')
            ->where('formations_id', '!=', null)
            ->where('formations_id', '!=', $idformation)
            ->pluck('formations_id', 'formations_id')
            ->all();

        return view(
            "formations.individuelles.add-individuelles",
            compact(
                'formation',
                'individuelles',
                'individuelleFormation',
                'module',
                'region',
                'candidatsretenus',
                'individuelleFormationCheck'
            )
        );
    }

    public function giveformationdemandeurs($idformation, $idmodule, $idlocalite, Request $request)
    {
        $request->validate([
            'individuelles' => ['required']
        ]);

        $formation = Formation::findOrFail($idformation);

        if ($formation->statut == 'terminer') {
            Alert::warning('Désolez !', 'formation déjà exécutée');
        } elseif ($formation->statut == 'annuler') {
            Alert::warning('Désolez !', 'formation annulée');
        } else {
            foreach ($request->individuelles as $individuelle) {
                $individuelle = Individuelle::findOrFail($individuelle);
                $individuelle->update([
                    "formations_id"      =>  $idformation,
                    "statut"             =>  'retenu',
                ]);

                $individuelle->save();
            }

            $validated_by = new Validationindividuelle([
                'validated_id'       =>      Auth::user()->id,
                'action'             =>      'retenu',
                'individuelles_id'   =>      $individuelle->id
            ]);

            $validated_by->save();

            Alert::success('Effectuée !', 'Candidat(s) ajouté(s)');
        }

        return redirect()->back();
    }

    public function giveindisponibles($idformation,  Request $request)
    {
        $request->validate([
            'motif' => ['required']
        ]);

        $individuelle = Individuelle::findOrFail($request->input('individuelleid'));
        $formation   = Formation::findOrFail($idformation);

        if ($formation->statut == 'terminer' && $individuelle->note_obtenue > 0) {
            Alert::warning('Attention !', 'impossible de retirer ce demandeur');
        } else {
            $individuelle->update([
                "formations_id"      =>  null,
                "statut"             =>  'retirer',
            ]);

            $individuelle->save();

            $indisponible = new Indisponible([
                "motif"             => $request->input('motif'),
                "individuelles_id"  => $request->input('individuelleid'),
                "formations_id"     => $idformation,
            ]);

            $indisponible->save();

            $validated_by = new Validationindividuelle([
                'validated_id'       =>      Auth::user()->id,
                'action'             =>      'retirer',
                'motif'              =>      $request->input('motif') . ', pour la formation : ' . $formation->name,
                'individuelles_id'   =>      $individuelle->id
            ]);

            $validated_by->save();

            Alert::success('Effectué', 'demandeur retiré de cette formation');
        }
        return redirect()->back();
    }

    public function givecollectiveindisponibles($idformation,  Request $request)
    {
        $request->validate([
            'motif' => ['required']
        ]);

        $listecollective = Listecollective::findOrFail($request->input('listecollectiveid'));
        $formation   = Formation::findOrFail($idformation);

        if ($formation->statut == 'terminer' && $listecollective->note_obtenue > 0) {
            Alert::warning('Attention !', 'impossible de retirer ce demandeur');
        } else {
            $listecollective->update([
                "formations_id"      =>  null,
                "statut"             =>  'retirer',
                "motif_rejet"        =>  $request->motif,
            ]);

            $listecollective->save();

            Alert::success('Effectué', 'demandeur retiré de cette formation');
        }
        return redirect()->back();
    }

    public function giveremiseAttestations($idformation,  Request $request)
    {
        $request->validate([
            'statut' => ['required']
        ]);


        $formation = Formation::findOrFail($request->input('formationid'));

        if ($formation->statut != 'terminer') {
            Alert::warning('Attention !', 'la formation n\'est pas encore terminée');
        } else {
            $formation->update([
                "attestation"             =>  $request->statut,
            ]);

            $formation->save();
        }
        Alert::success('Attestations ' . $request->statut);
        return redirect()->back();
    }


    public function addformationoperateurs($idformation, $idmodule, $idlocalite)
    {
        $formation = Formation::findOrFail($idformation);
        $module = Module::findOrFail($idmodule);
        $localite = Region::findOrFail($idlocalite);
        $modulename = $module->name;

        $operateurs = Operateur::get();

        /* $operateurmodules   =   DB::table('operateurmodules')
            ->where('module', $modulename)
            ->pluck('module', 'module')
            ->all(); */

        $operateurmodules   =   Operateurmodule::where('module', 'LIKE', "%{$modulename}%")->where('statut', 'agréer')->get();

        $operateurFormation = DB::table('formations')
            ->where('operateurs_id', $formation->operateurs_id)
            ->pluck('operateurs_id', 'operateurs_id')
            ->all();

        return view("formations.individuelles.add-operateurs", compact('formation', 'operateurs', 'operateurmodules', 'module', 'localite', 'operateurFormation'));
    }

    public function giveformationoperateurs($idformation, $idmodule, $idlocalite, Request $request)
    {
        $request->validate([
            'operateur' => ['required']
        ]);

        $formation = Formation::findOrFail($idformation);

        $formation->update([
            "operateurs_id"      =>  $request->input('operateur'),
        ]);

        $formation->save();

        Alert::success('Opérateur', 'ajouté avec succès');

        return redirect()->back();
    }

    public function addformationcollectiveoperateurs($idformation, $idcollectivemodule, $idlocalite)
    {
        $formation = Formation::findOrFail($idformation);
        $collectivemodule = Collectivemodule::findOrFail($idcollectivemodule);
        $localite = Region::findOrFail($idlocalite);
        $modulename = $collectivemodule->module;

        $operateurs = Operateur::get();

        $operateurmodules   =   Operateurmodule::where('module', $modulename)->where('statut', 'agréer')->get();

        $operateurFormation = DB::table('formations')
            ->where('operateurs_id', $formation->operateurs_id)
            ->pluck('operateurs_id', 'operateurs_id')
            ->all();

        return view("formations..collectives.add-operateur-collective", compact('formation', 'operateurs', 'operateurmodules', 'collectivemodule', 'localite', 'operateurFormation'));
    }

    public function giveformationcollectiveoperateurs($idformation, $idcollectivemodule, $idlocalite, Request $request)
    {
        $request->validate([
            'operateur' => ['required']
        ]);

        $formation = Formation::findOrFail($idformation);

        $formation->update([
            "operateurs_id"      =>  $request->input('operateur'),
        ]);

        $formation->save();

        Alert::success('Opérateur', 'ajouté avec succès');

        return redirect()->back();
    }
    public function addformationmodules($idformation, $idlocalite)
    {
        $formation = Formation::findOrFail($idformation);
        $module = $formation?->module?->name;
        $domaines = Domaine::orderBy("created_at", "desc")->get();
        $localite = Region::findOrFail($idlocalite);

        $modules = Module::get();

        $moduleFormation = DB::table('formations')
            ->where('modules_id', $formation->modules_id)
            ->pluck('modules_id', 'modules_id')
            ->all();

        return view("formations.individuelles.add-modules-individuelles", compact('formation', 'modules', 'module', 'localite', 'moduleFormation', 'domaines'));
    }

    public function giveformationmodules($idformation, Request $request)
    {
        $request->validate([
            'module' => ['required']
        ]);

        $formation = Formation::findOrFail($idformation);

        $formation->update([
            "modules_id"      =>  $request->input('module'),
        ]);

        $formation->save();

        Alert::success('Module', 'ajouté avec succès');

        return redirect()->back();
    }

    public function addmoduleformations($idformation, $idlocalite)
    {

        $formation = Formation::findOrFail($idformation);
        $module = $formation?->module?->name;
        $localite = Region::findOrFail($idlocalite);

        $modules = Module::get();

        $moduleFormation = DB::table('formations')
            ->where('modules_id', $formation->modules_id)
            ->pluck('modules_id', 'modules_id')
            ->all();

        $domaines = Domaine::orderBy("created_at", "desc")->get();

        return view("formations.individuelles.add-modules-individuelles", compact('formation', 'modules', 'module', 'localite', 'moduleFormation', 'domaines'));
    }

    public function addformationingenieurs($idformation)
    {
        $formation = Formation::findOrFail($idformation);
        $ingenieur = $formation?->ingenieur?->name;

        $ingenieurs = Ingenieur::get();

        $ingenieurFormation = DB::table('formations')
            ->where('ingenieurs_id', $formation->ingenieurs_id)
            ->pluck('ingenieurs_id', 'ingenieurs_id')
            ->all();

        $domaines = Domaine::orderBy("created_at", "desc")->get();

        return view("formations.add-ingenieur", compact('formation', 'ingenieurs', 'ingenieur', 'ingenieurFormation', 'domaines'));
    }


    public function giveformationingenieurs($idformation, Request $request)
    {
        $request->validate([
            'ingenieur' => ['required']
        ]);

        $formation = Formation::findOrFail($idformation);

        $formation->update([
            "ingenieurs_id"      =>  $request->input('ingenieur'),
        ]);

        $formation->save();

        Alert::success('Ingenieur', 'ajouté avec succès');

        return redirect()->back();
    }

    public function addcollectiveformations($idformation, $idlocalite)
    {

        $formation = Formation::findOrFail($idformation);
        /* $collectives = Collective::where('statut_demande', 'accepter')
            ->orwhere('statut_demande', 'retenu')
            ->get(); */

        /* $admis_h_count = Individuelle::join('users', 'users.id', 'individuelles.users_id')
            ->select('individuelles.*')
            ->where('formations_id', $formation->id)
            ->where('users.civilite', "M.")
            ->where('note_obtenue', '>=', '12')
            ->count(); */

        $collectivemodules = Collectivemodule::join('collectives', 'collectives.id', 'collectivemodules.collectives_id')
            ->select('collectivemodules.*')
            ->where('collectives.statut_demande', 'attente')
            ->whereBetween('collectivemodules.statut', ['attente', 'retenu'])
            ->get();

        /* $collectiveFormation = DB::table('collectives')
            ->where('formations_id', $idformation)
            ->pluck('formations_id', 'formations_id')
            ->all(); */

        $collectiveModule = DB::table('collectivemodules')
            ->where('formations_id', $idformation)
            ->pluck('formations_id', 'formations_id')
            ->all();

        /* $collectiveFormationCheck = DB::table('collectives')
            ->where('formations_id', '!=', null)
            ->where('formations_id', '!=', $idformation)
            ->pluck('formations_id', 'formations_id')
            ->all(); */

        $collectiveModuleCheck = DB::table('collectivemodules')
            ->where('formations_id', '!=', null)
            ->where('formations_id', '!=', $idformation)
            ->pluck('formations_id', 'formations_id')
            ->all();

        return view(
            "formations.collectives.add-collectives",
            compact(
                'formation',
                'collectivemodules',
                'collectiveModule',
                'collectiveModuleCheck'
            )
        );
    }


    public function giveformationcollectives($idformation, Request $request)
    {
        $request->validate([
            'collectivemodule' => ['required']
        ]);

        $collectivemodule = Collectivemodule::findOrFail($request->collectivemodule);

        $formation = Formation::findOrFail($idformation);

        foreach ($formation->listecollectives as $liste) {
        }

        if (!empty($liste)) {
            Alert::warning('Attention !', 'des bénéficiaires sont déjà sélectionnés');

            return redirect()->back();
        } elseif (isset($request->collectivemoduleformation) && $request->collectivemoduleformation != $collectivemodule->id) {
            $collectivemoduleformation = Collectivemodule::findOrFail($request->collectivemoduleformation);

            $collectivemoduleformation->update([
                "formations_id"      =>  null,
                "statut"             =>  'attente',
            ]);

            $collectivemoduleformation->save();
        }

        $collectivemodule->update([
            "formations_id"      =>  $idformation,
            "statut"             =>  'retenu',
        ]);

        $collectivemodule->save();

        Alert::success('Fait !', 'ajouté avec succès');

        return redirect()->back();
    }

    public function givemoduleformationcollectives($idformation, Request $request)
    {
        $request->validate([
            'collectivemodule' => ['required']
        ]);

        $formation = Formation::findOrFail($idformation);

        $formation->update([
            "collectivemodules_id"      =>  $request->input("collectivemodule"),
        ]);

        $formation->save();

        Alert::success('Fait !', 'ajouté avec succès');

        return redirect()->back();
    }


    public function givemoduleformations($idformation, $idlocalite, Request $request)
    {
        $request->validate([
            'module' => ['required']
        ]);

        $formation = Formation::findOrFail($idformation);

        $formation->update([
            "modules_id"      =>  $request->input('module'),
        ]);

        $formation->save();

        Alert::success('Module', 'ajouté avec succès');

        return redirect()->back();
    }

    public function formationTerminer(Request $request)
    {
        $formation = Formation::findOrFail($request->input('id'));

        $type = $formation->types_formation->name;

        if ($type == 'collective') {
            $count = $formation->listecollectives->count();
        } elseif ($type == 'individuelle') {
            $count = $formation->individuelles->count();
        } else {
            $count = 0;
        }

        if ($count == '0' || empty($formation->operateur)) {
            Alert::warning('Désolez !', 'action non autorisée');
        } else {
            if ($formation->statut == 'terminer') {
                Alert::warning('Désolez !', 'formation déjà exécutée');
            } elseif ($formation->statut == 'annuler') {
                Alert::warning('Désolez !', 'formation déjà annulée');
            } elseif ($formation->statut == 'attente') {
                Alert::warning('Désolez !', 'la formation n\'a pas encore démarrée');
            } else {

                $formation->update([
                    'statut'             => 'terminer',
                    'validated_by'       =>  Auth::user()->firstname . ' ' . Auth::user()->name,
                ]);

                $formation->save();

                $validated_by = new Validationformation([
                    'validated_id'       =>       Auth::user()->id,
                    'action'             =>      'terminer',
                    'formations_id'      =>      $formation->id
                ]);

                $validated_by->save();

                Alert::success('Félicitation !', 'formation terminée');
            }
        }

        /* return redirect()->back()->with("status", "Demande validée"); */
        return redirect()->back();
    }
    public function formationcollectiveTerminer(Request $request)
    {
        $formation   = Formation::findOrFail($request->input('id'));

        $count = $formation->listecollectives->count();

        if ($count == '0' || empty($formation->operateur)) {
            Alert::warning('Désolez !', 'action non autorisée');
        } else {
            if ($formation->statut == 'terminer') {
                Alert::warning('Désolez !', 'formation déjà exécutée');
            } elseif ($formation->statut == 'démarrer') {
                Alert::warning('Désolez !', 'formation en cours...');
            } else {
                $formation->update([
                    'statut'             => 'démarrer',
                    'validated_by'       =>  Auth::user()->firstname . ' ' . Auth::user()->name,
                ]);

                $formation->save();

                $validated_by = new Validationformation([
                    'validated_id'       =>       Auth::user()->id,
                    'action'             =>      'démarrer',
                    'formations_id'      =>      $formation->id
                ]);

                $validated_by->save();

                Alert::success('Félicitation !', 'la formation est lancée');
            }
        }

        /* return redirect()->back()->with("status", "Demande validée"); */
        return redirect()->back();
    }
    public function givenotedemandeurs($idformation, Request $request)
    {

        $request->validate([
            'notes' => ['required']
        ]);

        $individuelles = $request->individuelles;
        $notes = $request->notes;

        $individuelles_notes = array_combine($individuelles, $notes);

        foreach ($individuelles_notes as $key => $value) {
            $individuelle = Individuelle::findOrFail($key);
            if ($value <= 4) {
                $appreciation = "Médiocre";
            } elseif ($value <= 8) {
                $appreciation = "Insuffisant ";
            } elseif ($value <= 11) {
                $appreciation = "Passable ";
            } elseif ($value <= 13) {
                $appreciation = "Assez bien";
            } elseif ($value <= 16) {
                $appreciation = "Bien";
            } elseif ($value <= 19) {
                $appreciation = "Très bien";
            } elseif ($value = 20) {
                $appreciation = "Excellent ";
            }

            if ($individuelle->formation->statut == 'terminer') {
                $individuelle->update([
                    "note_obtenue"       =>  $value,
                    "appreciation"       =>  $appreciation,
                    "statut"             =>  'former',
                ]);
            } else {
                Alert::warning('Désolez !', 'la formation n\'est pas encore terminée');
                return redirect()->back();
            }

            $individuelle->save();

            $validated_by = new Validationindividuelle([
                'validated_id'       =>      Auth::user()->id,
                'action'             =>      'former',
                'individuelles_id'   =>      $individuelle->id
            ]);

            $validated_by->save();
        }

        Alert::success('Félicitations !', 'Evaluation terminée');

        return redirect()->back();
    }

    public function givenotedemandeursCollective($idformation, Request $request)
    {
        $request->validate([
            'notes' => ['required']
        ]);

        $listecollectives = $request->listecollectives;
        $notes = $request->notes;

        $listecollectives_notes = array_combine($listecollectives, $notes);

        foreach ($listecollectives_notes as $key => $value) {
            $listecollective = Listecollective::findOrFail($key);
            if ($value <= 4) {
                $appreciation = "Médiocre";
            } elseif ($value <= 8) {
                $appreciation = "Insuffisant ";
            } elseif ($value <= 11) {
                $appreciation = "Passable ";
            } elseif ($value <= 13) {
                $appreciation = "Assez bien";
            } elseif ($value <= 16) {
                $appreciation = "Bien";
            } elseif ($value <= 19) {
                $appreciation = "Très bien";
            } elseif ($value = 20) {
                $appreciation = "Excellent ";
            }

            $listecollective->update([
                "note_obtenue"       =>  $value,
                "appreciation"       =>  $appreciation,
                "statut"             =>  'terminer',
            ]);

            $listecollective->save();
        }

        /*  $validated_by = new Validationindividuelle([
            'validated_id'       =>      Auth::user()->id,
            'action'             =>      'terminer',
            'listecollectives_id'   =>      $listecollective->id
        ]);

        $validated_by->save(); */

        Alert::success('Félicitations !', 'Evaluation terminée');

        return redirect()->back();
    }

    public function updateAgentSuivi(Request $request)
    {
        $request->validate([
            'suivi_dossier' => ['required', 'string'],
            'date_suivi' => ['required', 'date']
        ]);

        $formation = Formation::findOrFail($request->input('id'));

        $formation->update([
            "suivi_dossier"    =>  $request->input('suivi_dossier'),
            "date_suivi"       =>  $request->input('date_suivi'),
        ]);

        $formation->save();

        Alert::success('Fait !', 'enregistré avec succès');

        return redirect()->back();
    }

    public function updateMembresJury(Request $request)
    {
        $request->validate([
            'membres_jury'              => ['nullable', 'string'],
            'evaluateur'                => ['required', 'string'],
            'numero_convention'         => ['required', 'string'],
            'frais_evaluateur'          => ['required', 'string'],
            'type_certificat'           => ['required', 'string'],
            'recommandations'           => ['nullable', 'string'],
            'date_pv'                   => ['required', 'date'],
        ]);

        $formation = Formation::findOrFail($request->input('id'));

        $formation->update([
            "membres_jury"                  =>  $request->input('membres_jury'),
            "numero_convention"             =>  $request->input('numero_convention'),
            "frais_evaluateur"              =>  $request->input('frais_evaluateur'),
            "type_certificat"               =>  $request->input('type_certificat'),
            "recommandations"               =>  $request->input('recommandations'),
            "date_pv"                       =>  $request->input('date_pv'),
            "evaluateurs_id"                => $request->input('evaluateur'),
            "onfpevaluateurs_id"            => $request->input('onfpevaluateur'),
        ]);

        $formation->save();

        Alert::success('Fait !', 'Enregistré avec succès');

        return redirect()->back();
    }

    public function updateObservations(Request $request)
    {
        $request->validate([
            'observations' => 'required',
            'string'
        ]);

        $individuelle = Individuelle::findOrFail($request->input('id'));

        $individuelle->update([
            "observations"       =>  $request->input('observations'),
        ]);

        $individuelle->save();

        Alert::success('Fait !', 'Observations ajoutées');

        return redirect()->back();
    }

    public function updateObservationsCollective(Request $request)
    {
        $request->validate([
            'observations' => 'required',
            'string'
        ]);

        $listecollective = Listecollective::findOrFail($request->input('id'));

        $listecollective->update([
            "observations"       =>  $request->input('observations'),
        ]);

        $listecollective->save();

        Alert::success('Fait !', 'Observations ajoutées');

        return redirect()->back();
    }

    public function updateAttestations(Request $request)
    {
        $date_retrait = date_format(date_create($request->date_retrait), 'd/m/Y');
        $request->validate([
            'date_retrait' => 'required',
            'date',
        ]);
        if ($request->input('moi') == 'moi') {
            $retrait_diplome = 'retiré par son propriétaire le ' . $date_retrait;
        } else {
            $request->validate([
                'cin' => 'required',
                'string',
                'max:15',
                'min:12',
                'name' => 'required',
                'string',
                'observations' => 'nullable',
                'string',
                'max:50'
            ]);
            $retrait_diplome = 'retiré par ' . $request->input('name') . ' le ' . $date_retrait . ' n° cin : ' . $request->input('cin');
        }

        $commentaires = $request->input('commentaires');

        if (isset($commentaires)) {
            $retrait_diplome = $retrait_diplome . '; ' . $commentaires;
        }


        $individuelle = Individuelle::findOrFail($request->input('id'));

        $individuelle->update([
            "retrait_diplome"       =>  $retrait_diplome,
        ]);

        $individuelle->save();

        Alert::success('Merci et à bientôt !', 'Bonne chance pour la suite');

        return redirect()->back();
    }

    public function ficheSuivi(Request $request)
    {

        $formation = Formation::find($request->input('id'));

        $title = 'Fiche de suivi de la formation en  ' . $formation->name;

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Formation');
        $dompdf->setOptions($options);


        $dompdf->loadHtml(view('formations.individuelles.fichesuivi', compact(
            'formation',
            'title'
        )));

        // (Optional) Setup the paper size and orientation (portrait ou landscape)
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        /* $anne = date('d');
        $anne = $anne . ' ' . date('m');
        $anne = $anne . ' ' . date('Y');
        $anne = $anne . ' à ' . date('H') . 'h';
        $anne = $anne . ' ' . date('i') . 'min';
        $anne = $anne . ' ' . date('s') . 's'; */

        $name = 'Fiche de suivi de la formation en  ' . $formation->name . ', code ' . $formation->code . '.pdf';

        // Output the generated PDF to Browser
        $dompdf->stream($name, ['Attachment' => false]);
    }

    public function pvEvaluation(Request $request)
    {

        $formation = Formation::find($request->input('id'));

        if ($formation->statut == 'terminer') {

            $title = 'PV Evaluation de la formation en  ' . $formation->name;

            $membres_jury = explode(";", $formation->membres_jury);
            $count_membres = count($membres_jury);

            $dompdf = new Dompdf();
            $options = $dompdf->getOptions();
            $options->setDefaultFont('Formation');
            $dompdf->setOptions($options);


            $dompdf->loadHtml(view('formations.individuelles.pvevaluation', compact(
                'formation',
                'title',
                'membres_jury',
                'count_membres',
            )));

            // (Optional) Setup the paper size and orientation (portrait ou landscape)
            $dompdf->setPaper('A4', 'landscape');

            // Render the HTML as PDF
            $dompdf->render();

            /*  $anne = date('d');
        $anne = $anne . ' ' . date('m');
        $anne = $anne . ' ' . date('Y');
        $anne = $anne . ' à ' . date('H') . 'h';
        $anne = $anne . ' ' . date('i') . 'min';
        $anne = $anne . ' ' . date('s') . 's'; */

            $name = 'PV Evaluation de la formation en  ' . $formation->name . ', code ' . $formation->code . '.pdf';

            // Output the generated PDF to Browser
            $dompdf->stream($name, ['Attachment' => false]);
        } else {
            Alert::warning('Désolez !', "la formation n'est pas encore terminée");
            return redirect()->back();
        }
    }

    public function pvVierge(Request $request)
    {

        $formation = Formation::find($request->input('id'));

        if ($formation->statut == 'terminer') {

            $title = 'PV Evaluation de la formation en  ' . $formation->name;

            $membres_jury = explode(";", $formation->membres_jury);
            $count_membres = count($membres_jury);

            $dompdf = new Dompdf();
            $options = $dompdf->getOptions();
            $options->setDefaultFont('Formation');
            $dompdf->setOptions($options);


            $dompdf->loadHtml(view('formations.individuelles.pvevaluation-vierge', compact(
                'formation',
                'title',
                'membres_jury',
                'count_membres',
            )));

            // (Optional) Setup the paper size and orientation (portrait ou landscape)
            $dompdf->setPaper('A4', 'landscape');

            // Render the HTML as PDF
            $dompdf->render();

            /*  $anne = date('d');
        $anne = $anne . ' ' . date('m');
        $anne = $anne . ' ' . date('Y');
        $anne = $anne . ' à ' . date('H') . 'h';
        $anne = $anne . ' ' . date('i') . 'min';
        $anne = $anne . ' ' . date('s') . 's'; */

            $name = 'PV Evaluation de la formation en  ' . $formation->name . ', code ' . $formation->code . '.pdf';

            // Output the generated PDF to Browser
            $dompdf->stream($name, ['Attachment' => false]);
        } else {
            Alert::warning('Désolez !', "la formation n'est pas encore terminée");
            return redirect()->back();
        }
    }

    public function ficheSuiviCol(Request $request)
    {

        $formation = Formation::find($request->input('id'));

        $title = 'Fiche de suivi de la formation en  ' . $formation->name;

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Formation');
        $dompdf->setOptions($options);


        $dompdf->loadHtml(view('formations.collectives.fichesuivicol', compact(
            'formation',
            'title'
        )));

        // (Optional) Setup the paper size and orientation (portrait ou landscape)
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        $name = 'Fiche de suivi de la formation en  ' . $formation->name . ', code ' . $formation->code . '.pdf';

        // Output the generated PDF to Browser
        $dompdf->stream($name, ['Attachment' => false]);
    }
    public function pvEvaluationCol(Request $request)
    {

        $formation = Formation::find($request->input('id'));

        if ($formation->statut == 'terminer') {

            $title = 'PV Evaluation de la formation en  ' . $formation->name;

            $membres_jury = explode(";", $formation->membres_jury);
            $count_membres = count($membres_jury);

            $dompdf = new Dompdf();
            $options = $dompdf->getOptions();
            $options->setDefaultFont('Formation');
            $dompdf->setOptions($options);


            $dompdf->loadHtml(view('formations.collectives.pvevaluationcol', compact(
                'formation',
                'title',
                'membres_jury',
                'count_membres',
            )));

            // (Optional) Setup the paper size and orientation (portrait ou landscape)
            $dompdf->setPaper('A4', 'landscape');

            // Render the HTML as PDF
            $dompdf->render();

            $name = 'PV Evaluation de la formation en  ' . $formation->name . ', code ' . $formation->code . '.pdf';

            // Output the generated PDF to Browser
            $dompdf->stream($name, ['Attachment' => false]);
        } else {
            Alert::warning('Désolez !', "la formation n'est pas encore terminée");
            return redirect()->back();
        }
    }


    public function addformationdemandeurscollectives($idformation, $idcollectivemodule, $idlocalite)
    {
        $formation = Formation::findOrFail($idformation);
        $collectivemodule = Collectivemodule::findOrFail($idcollectivemodule);
        $localite = Region::findOrFail($idlocalite);

        $listecollectives = Listecollective::where('collectivemodules_id', $idcollectivemodule)
            ->whereBetween('statut', ['attente', 'retenu', 'retirer', 'former'])
            ->get();

        $candidatsretenus = Listecollective::where('collectivemodules_id', $idcollectivemodule)
            ->where('formations_id', $idformation)
            ->get();

        $listecollectiveFormation = DB::table('listecollectives')
            ->where('formations_id', $idformation)
            ->pluck('formations_id', 'formations_id')
            ->all();

        return view("formations.collectives.add-listecollectives", compact('formation', 'listecollectives', 'listecollectiveFormation', 'collectivemodule', 'localite', 'candidatsretenus'));
    }

    public function giveformationdemandeurscollectives($idformation, $idcollectivemodule, $idlocalite, Request $request)
    {
        $request->validate([
            'listecollectives' => ['required']
        ]);

        $formation = Formation::findOrFail($idformation);

        if ($formation->statut == 'terminer') {
            Alert::warning('Désolez !', 'formation déjà exécutée');
        } elseif ($formation->statut == 'annuler') {
            Alert::warning('Désolez !', 'formation annulée');
        } else {
            $listecollectiveformations = Listecollective::where('formations_id', $idformation)->get();
            foreach ($listecollectiveformations as $key => $listecollectiveformation) {
                $listecollectiveformation->update([
                    "formations_id"      =>  null,
                    "statut"             =>  'attente',
                ]);
                $listecollectiveformation->save();
            }

            foreach ($request->listecollectives as $listecollective) {
                $listecollective = Listecollective::findOrFail($listecollective);

                $listecollective->update([
                    "formations_id"      =>  $idformation,
                    "statut"             =>  'retenu',
                ]);

                $listecollective->save();
            }

            /*  $validated_by = new Validationcollective([
                'validated_id'       =>      Auth::user()->id,
                'action'             =>      'retenu',
                'collectives_id'   =>      $listecollective->id
            ]);

            $validated_by->save(); */

            Alert::success('Effectuée !', 'Candidat(s) ajouté(s)');
        }

        return redirect()->back();
    }


    public function lettreEvaluation(Request $request)
    {

        $formation = Formation::find($request->input('id'));

        if ($formation->statut == 'terminer') {

            $title = 'Lettre de mission évaluation formation en  ' . $formation->name;

            $membres_jury = explode(";", $formation->membres_jury);
            $count_membres = count($membres_jury);

            $dompdf = new Dompdf();
            $options = $dompdf->getOptions();
            $options->setDefaultFont('Formation');
            $dompdf->setOptions($options);

            $dompdf->loadHtml(view('formations.lettrevaluation', compact(
                'formation',
                'title',
                'membres_jury',
                'count_membres',
            )));

            // (Optional) Setup the paper size and orientation (portrait ou landscape)
            $dompdf->setPaper('A4', 'portrait');

            // Render the HTML as PDF
            $dompdf->render();



            /*  $anne = date('d');
        $anne = $anne . ' ' . date('m');
        $anne = $anne . ' ' . date('Y');
        $anne = $anne . ' à ' . date('H') . 'h';
        $anne = $anne . ' ' . date('i') . 'min';
        $anne = $anne . ' ' . date('s') . 's'; */

            $name = 'Lettre de mission évaluation formation en  ' . $formation->name . ', code ' . $formation->code . '.pdf';

            // Output the generated PDF to Browser
            $dompdf->stream($name, ['Attachment' => false]);
        } else {
            Alert::warning('Désolez !', "la formation n'est pas encore terminée");
            return redirect()->back();
        }
    }

    public function abeEvaluation(Request $request)
    {

        $formation = Formation::find($request->input('id'));

        $admis = Individuelle::where('formations_id', $formation->id)
            ->where('note_obtenue', '>=', '12')
            ->get();

        $recales = Individuelle::where('formations_id', $formation->id)
            ->where('note_obtenue', '<', '12')
            ->get();

        $admis_h_count = Individuelle::join('users', 'users.id', 'individuelles.users_id')
            ->select('individuelles.*')
            ->where('formations_id', $formation->id)
            ->where('users.civilite', "M.")
            ->where('note_obtenue', '>=', '12')
            ->count();

        $admis_f_count = Individuelle::join('users', 'users.id', 'individuelles.users_id')
            ->select('individuelles.*')
            ->where('formations_id', $formation->id)
            ->where('users.civilite', "Mme")
            ->where('note_obtenue', '>=', '12')
            ->count();

        $formes_h_count = Individuelle::join('users', 'users.id', 'individuelles.users_id')
            ->select('individuelles.*')
            ->where('formations_id', $formation->id)
            ->where('users.civilite', "M.")
            ->count();

        $formes_f_count = Individuelle::join('users', 'users.id', 'individuelles.users_id')
            ->select('individuelles.*')
            ->where('formations_id', $formation->id)
            ->where('users.civilite', "Mme")
            ->count();

        $formes_total = $formes_h_count + $formes_f_count;

        $retenus_h_count = Individuelle::join('users', 'users.id', 'individuelles.users_id')
            ->select('individuelles.*')
            ->where('formations_id', $formation->id)
            ->where('users.civilite', "M.")
            ->count();

        $retenus_f_count = Individuelle::join('users', 'users.id', 'individuelles.users_id')
            ->select('individuelles.*')
            ->where('formations_id', $formation->id)
            ->where('users.civilite', "Mme")
            ->count();

        $retenus_total = $retenus_h_count + $retenus_f_count;

        if ($formation->statut == 'terminer') {

            $title = 'Attestation de bonne execution ' . $formation->name;

            $membres_jury = explode(";", $formation->membres_jury);
            $count_membres = count($membres_jury);

            $dompdf = new Dompdf();
            $options = $dompdf->getOptions();
            $options->setDefaultFont('Formation');
            $dompdf->setOptions($options);

            $dompdf->loadHtml(view('formations.abe', compact(
                'formation',
                'title',
                'membres_jury',
                'count_membres',
                'admis',
                'recales',
                'admis_h_count',
                'admis_f_count',
                'formes_h_count',
                'formes_f_count',
                'formes_total',
                'retenus_h_count',
                'retenus_f_count',
                'retenus_total',
            )));

            // (Optional) Setup the paper size and orientation (portrait ou landscape)
            $dompdf->setPaper('A4', 'portrait');

            // Render the HTML as PDF
            $dompdf->render();



            /*  $anne = date('d');
        $anne = $anne . ' ' . date('m');
        $anne = $anne . ' ' . date('Y');
        $anne = $anne . ' à ' . date('H') . 'h';
        $anne = $anne . ' ' . date('i') . 'min';
        $anne = $anne . ' ' . date('s') . 's'; */

            $name = 'Attestation de bonne execution ' . $formation->name . ', code ' . $formation->code . '.pdf';

            // Output the generated PDF to Browser
            $dompdf->stream($name, ['Attachment' => false]);
        } else {
            Alert::warning('Désolez !', "la formation n'est pas encore terminée");
            return redirect()->back();
        }
    }

    public function rapports(Request $request)
    {
        $title = 'rapports formations';
        return view('formations.rapports', compact(
            'title'
        ));
    }
    public function generateRapport(Request $request)
    {
        $this->validate($request, [
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        $now =  Carbon::now()->format('H:i:s');

        $from_date = date_format(date_create($request->from_date), 'd/m/Y');

        $to_date = date_format(date_create($request->to_date), 'd/m/Y');

        $formations = Formation::whereBetween(DB::raw('DATE(date_debut)'), array($request->from_date, $request->to_date))->get();

        $count = $formations->count();

        if ($from_date == $to_date) {
            if (isset($count) && $count < "1") {
                $title = 'aucune formation effctuée le ' . $from_date;
            } elseif (isset($count) && $count == "1") {
                $title = $count . ' formation effctuée le ' . $from_date;
            } else {
                $title = $count . ' formations effctuées le ' . $from_date;
            }
        } else {
            if (isset($count) && $count < "1") {
                $title = 'aucune formation effctuée entre le ' . $from_date . ' et le ' . $to_date;
            } elseif (isset($count) && $count == "1") {
                $title = $count . ' formation effctuée entre le ' . $from_date . ' et le ' . $to_date;
            } else {
                $title = $count . ' formations effctuées entre le ' . $from_date . ' et le ' . $to_date;
            }
        }

        return view('formations.rapports', compact(
            'formations',
            'from_date',
            'to_date',
            'title'
        ));
    }

    public function rapportsformes(Request $request)
    {
        $regions = Region::get();
        $title = 'rapports formés';
        return view('formes.rapports', compact(
            'regions',
            'title'
        ));
    }
    public function generateRapportFormes(Request $request)
    {
        $this->validate($request, [
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        $now =  Carbon::now()->format('H:i:s');

        $from_date = date_format(date_create($request->from_date), 'd/m/Y');

        $to_date = date_format(date_create($request->to_date), 'd/m/Y');

        if (isset($request->module) && isset($request->region)) {
            $module = Module::where('name', $request->module)->first();
            $region = Region::where('nom', $request->region)->first();
            $title_region_module = ' dans la région de ' . $request->region .  ' en ' . $request->module;

            $formes = Individuelle::join('formations', 'formations.id', 'individuelles.formations_id')
                ->select('individuelles.*')
                ->where('individuelles.statut', 'former')
                ->where('individuelles.modules_id', 'LIKE', "%{$module?->id}%")
                ->where('individuelles.regions_id',  $region?->id)
                ->whereBetween(DB::raw('DATE(formations.date_debut)'), array($request->from_date, $request->to_date))
                ->get();
        } elseif (isset($request->region)) {
            $region = Region::where('nom', $request->region)->first();
            $title_region_module = ' dans la région de ' . $request->region;

            $formes = Individuelle::join('formations', 'formations.id', 'individuelles.formations_id')
                ->select('individuelles.*')
                ->where('individuelles.statut', 'former')
                ->where('individuelles.regions_id',  $region?->id)
                ->whereBetween(DB::raw('DATE(formations.date_debut)'), array($request->from_date, $request->to_date))
                ->get();
        } elseif (isset($request->module)) {
            $module = Module::where('name', $request->module)->first();
            $title_region_module = ' en ' . $request->module;

            $formes = Individuelle::join('formations', 'formations.id', 'individuelles.formations_id')
                ->select('individuelles.*')
                ->where('individuelles.statut', 'former')
                ->where('individuelles.modules_id', 'LIKE', "%{$module?->id}%")
                ->whereBetween(DB::raw('DATE(formations.date_debut)'), array($request->from_date, $request->to_date))
                ->get();
        } else {
            $title_region_module = '';
            $formes = Individuelle::join('formations', 'formations.id', 'individuelles.formations_id')
                ->select('individuelles.*')
                ->where('individuelles.statut', 'former')
                ->whereBetween(DB::raw('DATE(formations.date_debut)'), array($request->from_date, $request->to_date))
                ->get();
        }

        $count = $formes->count();

        if ($from_date == $to_date) {
            if (isset($count) && $count < "1") {
                $title = 'aucun bénéficiaire formé le ' . $from_date . ' ' . $title_region_module;
            } elseif (isset($count) && $count == "1") {
                $title = $count . ' bénéficiaire formé le ' . $from_date . ' ' . $title_region_module;
            } else {
                $title = $count . ' bénéficiaires formé le ' . $from_date . ' ' . $title_region_module;
            }
        } else {
            if (isset($count) && $count < "1") {
                $title = 'aucun bénéficiaire formé entre entre le ' . $from_date . ' et le ' . $to_date . ' ' . $title_region_module;
            } elseif (isset($count) && $count == "1") {
                $title = $count . ' bénéficiaire formé entre entre le ' . $from_date . ' et le ' . $to_date . ' ' . $title_region_module;
            } else {
                $title = $count . ' bénéficiaires formés entre entre le ' . $from_date . ' et le ' . $to_date . ' ' . $title_region_module;
            }
        }

        $regions = Region::get();
        return view('formes.rapports', compact(
            'formes',
            'regions',
            'title'
        ));
    }

    public function suiviformes(Request $request)
    {
        $regions = Region::get();
        $title = 'Base de données des formés suivis';

        $formes = Individuelle::where('suivi', 'suivi')->get();

        return view('formes.suivi', compact(
            'regions',
            'formes',
            'title'
        ));
    }
    public function generateSuiviFormes(Request $request)
    {
        $this->validate($request, [
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);

        $now =  Carbon::now()->format('H:i:s');

        $from_date = date_format(date_create($request->from_date), 'd/m/Y');

        $to_date = date_format(date_create($request->to_date), 'd/m/Y');

        if (isset($request->module) && isset($request->region)) {
            $module = Module::where('name', $request->module)->first();
            $region = Region::where('nom', $request->region)->first();
            $title_region_module = ' dans la région de ' . $request->region .  ' en ' . $request->module;

            $formes = Individuelle::join('formations', 'formations.id', 'individuelles.formations_id')
                ->select('individuelles.*')
                ->where('individuelles.statut', 'former')
                ->where('individuelles.modules_id', 'LIKE', "%{$module?->id}%")
                ->where('individuelles.regions_id',  $region?->id)
                ->whereBetween(DB::raw('DATE(formations.date_debut)'), array($request->from_date, $request->to_date))
                ->get();
        } elseif (isset($request->region)) {
            $region = Region::where('nom', $request->region)->first();
            $title_region_module = ' dans la région de ' . $request->region;

            $formes = Individuelle::join('formations', 'formations.id', 'individuelles.formations_id')
                ->select('individuelles.*')
                ->where('individuelles.statut', 'former')
                ->where('individuelles.regions_id',  $region?->id)
                ->whereBetween(DB::raw('DATE(formations.date_debut)'), array($request->from_date, $request->to_date))
                ->get();
        } elseif (isset($request->module)) {
            $module = Module::where('name', $request->module)->first();
            $title_region_module = ' en ' . $request->module;

            $formes = Individuelle::join('formations', 'formations.id', 'individuelles.formations_id')
                ->select('individuelles.*')
                ->where('individuelles.statut', 'former')
                ->where('individuelles.modules_id', 'LIKE', "%{$module?->id}%")
                ->whereBetween(DB::raw('DATE(formations.date_debut)'), array($request->from_date, $request->to_date))
                ->get();
        } else {
            $title_region_module = '';
            $formes = Individuelle::join('formations', 'formations.id', 'individuelles.formations_id')
                ->select('individuelles.*')
                ->where('individuelles.statut', 'former')
                ->whereBetween(DB::raw('DATE(formations.date_debut)'), array($request->from_date, $request->to_date))
                ->get();
        }

        $count = $formes->count();

        if ($from_date == $to_date) {
            if (isset($count) && $count < "1") {
                $title = 'aucun bénéficiaire formé le ' . $from_date . ' ' . $title_region_module;
            } elseif (isset($count) && $count == "1") {
                $title = $count . ' bénéficiaire formé le ' . $from_date . ' ' . $title_region_module;
            } else {
                $title = $count . ' bénéficiaires formé le ' . $from_date . ' ' . $title_region_module;
            }
        } else {
            if (isset($count) && $count < "1") {
                $title = 'aucun bénéficiaire formé entre entre le ' . $from_date . ' et le ' . $to_date . ' ' . $title_region_module;
            } elseif (isset($count) && $count == "1") {
                $title = $count . ' bénéficiaire formé entre entre le ' . $from_date . ' et le ' . $to_date . ' ' . $title_region_module;
            } else {
                $title = $count . ' bénéficiaires formés entre entre le ' . $from_date . ' et le ' . $to_date . ' ' . $title_region_module;
            }
        }

        $regions = Region::get();
        return view('formes.suivi', compact(
            'formes',
            'regions',
            'title'
        ));
    }

    public function SuivreFormes(Request $request, $id)
    {
        $individuelle = Individuelle::findOrFail($id);

        $individuelle->update([
            'suivi' => 'suivi'
        ]);

        $individuelle->save();

        Alert::success('Demandeur suivi !');
        return redirect()->back();
    }

    public function FormeSuivi(Request $request)
    {
        $this->validate($request, [
            'informations_suivi' => 'required|string',
        ]);

        $individuelle = Individuelle::findOrFail($request->id);

        $individuelle->update([
            'informations_suivi' => $request->informations_suivi
        ]);

        $individuelle->save();

        Alert::success('Enregistrement effectué !');

        return redirect()->back();
    }
}
