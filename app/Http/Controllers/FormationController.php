<?php

namespace App\Http\Controllers;

use App\Models\Collective;
use App\Models\Collectivemodule;
use App\Models\Departement;
use App\Models\Direction;
use App\Models\Domaine;
use App\Models\Formation;
use App\Models\Indisponible;
use App\Models\Individuelle;
use App\Models\Ingenieur;
use App\Models\Listecollective;
use App\Models\Module;
use App\Models\Operateur;
use App\Models\Operateurmodule;
use App\Models\Region;
use App\Models\Statut;
use App\Models\TypesFormation;
use App\Models\Validationcollective;
use App\Models\Validationformation;
use App\Models\Validationindividuelle;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class FormationController extends Controller
{
    public function index()
    {
        $formations = Formation::where('statut', '!=', 'supprimer')->orderBy('created_at', 'desc')->get();
        $modules = Module::orderBy("created_at", "desc")->get();
        $departements = Departement::orderBy("created_at", "desc")->get();
        $regions = Region::orderBy("created_at", "desc")->get();
        $operateurs = Operateur::orderBy("created_at", "desc")->get();
        $types_formations = TypesFormation::orderBy("created_at", "desc")->get();
        return view("formations.index", compact("formations", "modules", "departements", "regions", "operateurs", 'types_formations'));
    }


    public function create()
    {
        return view("formations.create");
    }

    public function store(Request $request)
    {
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
            "titre"                 =>   $request->input('titre'),
            "date_debut"            =>   $request->input('date_debut'),
            "date_fin"              =>   $request->input('date_fin'),
            "statut"                =>   "attente",
            "annee"                 =>   $annee,

        ]);

        $formation->save();


        $statut = new Statut([
            "statut"                =>   "attente",
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
        return view("formations.update", compact("formation", "departements", "types_formations"));
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

        $formation->update([
            "name"                  =>   $request->input('name'),
            "regions_id"            =>   $request->input('region'),
            "departements_id"       =>   $request->input('departement'),
            "lieu"                  =>   $request->input('lieu'),
            "types_formations_id"   =>   $request->input('types_formation'),
            "niveau_qualification"  =>   $request->input('niveau_qualification'),
            "titre"                 =>   $request->input('titre'),
            "date_debut"            =>   $request->input('date_debut'),
            "date_fin"              =>   $request->input('date_fin'),

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

        $collectivemodule = Collectivemodule::where('collectives_id', $formation->collectives_id)->get();

        $collectiveFormation = DB::table('formations')
            ->where('collectivemodules_id', $formation->collectivemodules_id)
            ->pluck('collectivemodules_id', 'collectivemodules_id')
            ->all();

        return view('formations.' . $type_formation . "s.show", compact("formation", "count_demandes", "operateur", "module", "type_formation", "individuelles", "collectiveFormation", "ingenieur"));
    }

    public function destroy($id)
    {
        $formation   = Formation::find($id);

        /* $formation->delete(); */

        $formation->update([
            "statut"       =>   "supprimer",
        ]);

        $formation->save();


        $statut = new Statut([
            "statut"                =>   "supprimer",
            "formations_id"         =>   $formation->id,
        ]);

        $statut->save();

        Alert::success('La formation ' . $formation->name, 'a été supprimer');

        return redirect()->back();
    }

    public function addformationdemandeurs($idformation, $idmodule, $idlocalite)
    {
        $formation = Formation::findOrFail($idformation);
        $module = Module::findOrFail($idmodule);
        $localite = Region::findOrFail($idlocalite);

        $individuelles = Individuelle::where('regions_id', $idlocalite)
            ->where('modules_id', $idmodule)
            ->where('statut', 'accepter')
            ->orWhere('statut', 'retirer')
            ->orWhere('statut', 'programmer')
            ->get();


        $individuelleFormation = DB::table('individuelles')
            ->where('formations_id', $idformation)
            ->pluck('formations_id', 'formations_id')
            ->all();

        return view("formations.individuelles.add-individuelles", compact('formation', 'individuelles', 'individuelleFormation', 'module', 'localite'));
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
                    "statut"             =>  'retenue',
                ]);

                $individuelle->save();
            }

            $validated_by = new Validationindividuelle([
                'validated_id'       =>      Auth::user()->id,
                'action'             =>      'retenue',
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
                'motif'              =>      $request->input('motif'),
                'individuelles_id'   =>      $individuelle->id
            ]);

            $validated_by->save();

            Alert::success('Effectué', 'demandeur retiré de cette formation');
        }
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

        $operateurmodules   =   Operateurmodule::where('module', $modulename)->where('statut', 'agréer')->get();

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

        return view("formations.individuelles.add-ingenieur", compact('formation', 'ingenieurs', 'ingenieur', 'ingenieurFormation', 'domaines'));
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

        $collectives = Collective::get();

        $collectiveFormation = DB::table('formations')
            ->where('collectives_id', $formation->collectives_id)
            ->pluck('collectives_id', 'collectives_id')
            ->all();

        return view("formations.collectives.add-modules-collectives", compact('formation', 'collectives', 'collectiveFormation'));
    }


    public function giveformationcollectives($idformation, Request $request)
    {
        $request->validate([
            'collective' => ['required']
        ]);

        $formation = Formation::findOrFail($idformation);

        if (isset($formation->collectives_id)) {
            $collective = Collective::findOrFail($formation->collectives_id);
            $collective->update([
                "statut_demande"      =>  'accepter',
            ]);
            $collective->save();
        }
        $collective = Collective::findOrFail($request->input("collective"));
        $collective->update([
            "statut_demande"      =>  'retenue',
        ]);

        $collective->save();

        $formation->update([
            "collectives_id"      =>  $request->input("collective"),
        ]);

        $formation->save();

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
            $count = $formation->collective->count();
        } elseif($type == 'individuelle') {
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

            $individuelle->update([
                "note_obtenue"       =>  $value,
                "appreciation"       =>  $appreciation,
                "statut"             =>  'terminer',
            ]);

            $individuelle->save();
        }

        $validated_by = new Validationindividuelle([
            'validated_id'       =>      Auth::user()->id,
            'action'             =>      'terminer',
            'individuelles_id'   =>      $individuelle->id
        ]);

        $validated_by->save();

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
            'suivi_dossier' => 'required', 'string',
            'date_suivi' => 'required', 'date'
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
            'membres_jury' => 'required', 'string',
        ]);

        $formation = Formation::findOrFail($request->input('id'));
        $formation->update([
            "membres_jury"    =>  $request->input('membres_jury'),
        ]);

        $formation->save();

        Alert::success('Fait !', 'enregistré avec succès');

        return redirect()->back();
    }

    public function updateObservations(Request $request)
    {
        $request->validate([
            'observations' => 'required', 'string'
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
            'observations' => 'required', 'string'
        ]);

        $listecollective = Listecollective::findOrFail($request->input('id'));

        $listecollective->update([
            "observations"       =>  $request->input('observations'),
        ]);

        $listecollective->save();

        Alert::success('Fait !', 'Observations ajoutées');

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


    public function addformationdemandeurscollectives($idformation, $idcollectivemodule, $idlocalite)
    {
        $formation = Formation::findOrFail($idformation);
        $collectivemodule = Collectivemodule::findOrFail($idcollectivemodule);
        $localite = Region::findOrFail($idlocalite);

        $listecollectives = Listecollective::where('collectivemodules_id', $idcollectivemodule)
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
                    "statut"             =>  'retenue',
                ]);

                $listecollective->save();
            }

            /*  $validated_by = new Validationcollective([
                'validated_id'       =>      Auth::user()->id,
                'action'             =>      'retenue',
                'collectives_id'   =>      $listecollective->id
            ]);

            $validated_by->save(); */

            Alert::success('Effectuée !', 'Candidat(s) ajouté(s)');
        }

        return redirect()->back();
    }
}
