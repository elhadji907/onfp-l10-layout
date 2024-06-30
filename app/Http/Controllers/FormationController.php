<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Formation;
use App\Models\Indisponible;
use App\Models\Individuelle;
use App\Models\Module;
use App\Models\Operateur;
use App\Models\Region;
use App\Models\Statut;
use App\Models\TypesFormation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class FormationController extends Controller
{
    public function index()
    {
        $formations = Formation::orderBy('created_at', 'desc')->get();
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

        if ($types_formation->name == "Individuelle") {
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
            "region"                =>   "required|string",
            "departement"           =>   "required|string",
            "lieu"                  =>   "required|string",
            "module"                =>   "required|string",
            "operateur"             =>   "required|string",
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
            "modules_id"            =>   $request->input('module'),
            "operateurs_id"         =>   $request->input('operateur'),
            "types_formations_id"   =>   $request->input('types_formation'),
            "niveau_qualification"  =>   $request->input('niveau_qualification'),
            "titre"                 =>   $request->input('titre'),
            "date_debut"            =>   $request->input('date_debut'),
            "date_fin"              =>   $request->input('date_fin'),
            "statut"                =>   "Attente",
            "annee"                 =>   $annee,

        ]);

        $formation->save();


        $statut = new Statut([
            "statut"                =>   "Attente",
            "formations_id"         =>   $formation->id,
        ]);

        $statut->save();


        Alert::success("La formation "  . $formation->name, " a été créée avec succès");

        return redirect()->back();
    }

    public function show($id)
    {
        $formation = Formation::findOrFail($id);
        return view("formations.show", compact("formation"));
    }

    public function destroy($id)
    {
        $formation   = Formation::find($id);

        /* $formation->delete(); */

        $formation->update([
            "statut"       =>   "Supprimée",
        ]);

        $formation->save();

        foreach ($formation->statuts as $statut) {
        }

        $statut->update([
            "statut"                =>   "Supprimée",
            "formations_id"         =>   $formation->id,
        ]);

        $statut->save();

        Alert::success('La formation ' . $formation->name, 'a été supprimée');

        return redirect()->back();
    }

    public function addformationdemandeurs($idformation, $idmodule, $idlocalite)
    {
        $formation = Formation::findOrFail($idformation);
        $module = Module::findOrFail($idmodule);
        $localite = Departement::findOrFail($idlocalite);

        $individuelles = Individuelle::where('departements_id', $idlocalite)
            ->where('modules_id', $idmodule)
            ->where('statut', 'Validée')
            ->get();

        $individuelleFormation = DB::table('individuelles')
            ->where('formations_id', $idformation)
            ->pluck('formations_id', 'formations_id')
            ->all();

        return view("formations.add-demandeurs", compact('formation', 'individuelles', 'individuelleFormation', 'module', 'localite'));
    }

    public function giveformationdemandeurs($idformation, $idmodule, $idlocalite, Request $request)
    {
        $request->validate([
            'individuelles' => ['required']
        ]);

        foreach ($request->individuelles as $individuelle) {
            $individuelle = Individuelle::findOrFail($individuelle);
            $individuelle->update([
                "formations_id"      =>  $idformation,
            ]);

            $individuelle->save();
        }

        Alert::success('Modifications', 'prises en charge');

        return redirect()->back();
    }

    public function giveindisponibles($idformation, $idindividuelle,  Request $request)
    {
        $request->validate([
            'motif' => ['required']
        ]);

        $individuelle = Individuelle::findOrFail($idindividuelle);

        $individuelle->update([
            "formations_id"      =>  null,
        ]);

        $individuelle->save();

        $indisponible = new Indisponible([
            "motif"             => $request->input('motif'),
            "individuelles_id"  => $idindividuelle,
            "formations_id"     => $idformation,
        ]);

        $indisponible->save();

        Alert::success('Effectué', 'demandeur retirer de cette formation');

        return redirect()->back();
    }
}
