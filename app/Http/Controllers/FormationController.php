<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Formation;
use App\Models\Module;
use App\Models\Operateur;
use App\Models\Region;
use App\Models\Statut;
use App\Models\TypesFormation;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $annee = date('y');
        $mois = date('m');

        $rand1 = rand(100, 999);
        $rand2 = chr(rand(65, 90));

        $rand = $rand1 . '' . $rand2;

        $types_formation = TypesFormation::findOrFail($request->input('types_formation'));

        if ($types_formation->name == "Individuelle") {
            $fic = "FI";
        } else {
            $fic = "FC";
        }

        $rand = $fic . '' . $mois . $annee . $rand;

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
            "code"                  =>   $rand,
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

    public function destroy($id)
    {
        $formation   = Formation::find($id);

        $formation->delete();

        Alert::success('La formation ' . $formation->name, 'a été supprimée');

        return redirect()->back();
    }
}
