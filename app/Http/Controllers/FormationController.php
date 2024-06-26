<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Formation;
use App\Models\Module;
use App\Models\Operateur;
use App\Models\Region;
use App\Models\Statut;
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
        return view("formations.index", compact("formations", "modules", "departements", "regions", "operateurs"));
    }

    public function store(Request $request)
    {
        $annee = date('y');

        if (Formation::where('id', 1)->exists()) {
            $code = Formation::get()->last()->id;;
        } else {
            $code = 0;
        }

        $code = ++$code;

        $longueur = strlen($code);

        if ($longueur == 0) {
            $code            =   strtolower("00000" . $code);
        } elseif ($longueur <= 1) {
            $code            =   strtolower("0000" . $code);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $code            =   strtolower("000" . $code);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $code            =   strtolower("00" . $code);
        } elseif ($longueur >= 4 && $longueur < 5) {
            $code            =   strtolower("0" . $code);
        } else {
            $code            =   strtolower($code);
        }

        /* dd($code); */

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
            "code"                  =>   "FI".$annee.'-'.$code,
            "name"                  =>   $request->input('name'),
            "regions_id"            =>   $request->input('region'),
            "departements_id"       =>   $request->input('departement'),
            "lieu"                  =>   $request->input('lieu'),
            "modules_id"            =>   $request->input('module'),
            "operateurs_id"         =>   $request->input('operateur'),
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
}
