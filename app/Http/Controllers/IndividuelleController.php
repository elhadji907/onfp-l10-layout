<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndividuelleStoreRequest;
use App\Models\Departement;
use App\Models\Individuelle;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class IndividuelleController extends Controller
{
    public function index()
    {
        $individuelles = Individuelle::orderBy('created_at', 'desc')->get();
        return view("demandes.individuelles.index", compact("individuelles"));
    }

    public function create()
    {
        $total_individuelle = Individuelle::where('users_id', Auth::user()->id)->count();
        if ($total_individuelle >= 5) {
            /* $status = "Vous avez atteint le nombre de demandes individuels autorisées"; */
            /* return redirect()->back()->with("status", $status); */
            Alert::warning('Attention ! ', 'Vous avez atteint le nombre de demandes autorisées');
            return redirect()->back();
        } else {
            $departements = Departement::orderBy("created_at", "desc")->get();
            $modules = Module::orderBy("created_at", "desc")->get();
            return view("demandes.individuelles.create", compact("departements", "modules"));
        }
    }

    public function store(IndividuelleStoreRequest $request): RedirectResponse
    {

        $total_individuelle = Individuelle::where('users_id', Auth::user()->id)->count();
        if ($total_individuelle >= 5) {
            /* $status = "Vous avez atteint le nombre de demandes individuels autorisées"; */
            /* return redirect()->back()->with("status", $status); */
            Alert::warning('Attention ! ', 'Vous avez atteint le nombre de demandes autoriées');
            return redirect()->back();
        }

        $anne = date('y');
        /* $num = rand(100, 999);
        $letter = chr(rand(65, 90)); */
        /* dd($anne . ' ' . $num . ' ' . $letter); */

        $cin  =   $request->input('cin');
        $cin  =   str_replace(' ', '', $cin);
        $date_depot =   date('Y-m-d');

        /*   $num_demande_inividuelle = Individuelle::get()->last()->numero;
        $num_demande_inividuelle = ++$num_demande_inividuelle;
        $individuelle_id         = Individuelle::latest('id')->first()->id;
        $individuelle_id         = ++$individuelle_id;

        $longueur = strlen($individuelle_id);

        if ($longueur == 0) {
            $num_demande_inividuelle   =   strtolower("00000" . $individuelle_id);
        } elseif ($longueur <= 1) {
            $num_demande_inividuelle   =   strtolower("0000" . $individuelle_id);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $num_demande_inividuelle   =   strtolower("000" . $individuelle_id);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $num_demande_inividuelle   =   strtolower("00" . $individuelle_id);
        } elseif ($longueur >= 4 && $longueur < 5) {
            $num_demande_inividuelle   =   strtolower("0" . $individuelle_id);
        } else {
            $num_demande_inividuelle   =   strtolower($num_demande_inividuelle);
        } */


        $annee = date('y');

        /* $mois = date('m');
        $rand1 = rand(100, 999);
        $rand2 = chr(rand(65, 90));

        $rand = $rand1 . '' . $rand2; */

        $count_individuelle = Individuelle::get()->count();

        $count_individuelle = ++$count_individuelle;

        $longueur = strlen($count_individuelle);

        if ($longueur == 1) {
            $numero_individuelle   =   strtolower("0000" . $count_individuelle);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $numero_individuelle   =   strtolower("000" . $count_individuelle);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $numero_individuelle   =   strtolower("00" . $count_individuelle);
        } elseif ($longueur >= 4 && $longueur < 5) {
            $numero_individuelle   =   strtolower("0" . $count_individuelle);
        } else {
            $numero_individuelle   =   strtolower($count_individuelle);
        }


        $numero_individuelle = 'I' . $annee . '' . $numero_individuelle;

        $departement = Departement::findOrFail($request->input("departement"));
        $regionid = $departement->region->id;

        /*  $user = User::create([
            'civilite'                          => $request->input('civilite'),
            'firstname'                         => $request->input('firstname'),
            'name'                              => $request->input('name'),
            'date_naissance'                    => $request->input('date_naissance'),
            'lieu_naissance'                    => $request->input('lieu_naissance'),
            'email'                             => $request->input('email'),
            'telephone'                         => $request->input('telephone'),
            'situation_familiale'               => $request->input('situation_familiale'),
            'situation_professionnelle'         => $request->input('situation_professionnelle'),
            'adresse'                           => $request->input('adresse'),
        ]);

        $user->save(); */

        /* $demandeur = new Demandeur([
            'type'                              => 'individuelle',
            "departements_id"                   => $request->input("departement"),
            'numero_dossier'                    => "D" . $num_demande_inividuelle . "" . $anne,
            'users_id'                          => Auth::user()->id,
        ]);

        $demandeur->save(); */

        $individuelle = new Individuelle([
            'date_depot'                        =>  $date_depot,
            'numero'                            =>  $numero_individuelle,
            'niveau_etude'                      =>  $request->input('niveau_etude'),
            'diplome_academique'                =>  $request->input('diplome_academique'),
            'autre_diplome_academique'          =>  $request->input('autre_diplome_academique'),
            'option_diplome_academique'         =>  $request->input('option_diplome_academique'),
            'etablissement_academique'          =>  $request->input('etablissement_academique'),
            'diplome_professionnel'             =>  $request->input('diplome_professionnel'),
            'autre_diplome_professionnel'       =>  $request->input('autre_diplome_professionnel'),
            'specialite_diplome_professionnel'  =>  $request->input('specialite_diplome_professionnel'),
            'etablissement_professionnel'       =>  $request->input('etablissement_professionnel'),
            'projet_poste_formation'            =>  $request->input('projet_poste_formation'),
            'projetprofessionnel'               =>  $request->input('projetprofessionnel'),
            'qualification'                     =>  $request->input('qualification'),
            'experience'                        =>  $request->input('experience'),
            "departements_id"                   =>  $request->input("departement"),
            "regions_id"                        =>  $regionid,
            "modules_id"                        =>  $request->input("module"),
            'autre_module'                      =>  $request->input('autre_module'),
            'statut'                             => 'Attente',
            'users_id'                          =>  Auth::user()->id,
            'demandeurs_id'                     =>  Auth::user()->demandeur->id
        ]);

        $individuelle->save();

        $demandeur = $individuelle->demandeur;

        Alert::success('Enregistrée ! ', 'demande ajoutée avec succès');

        /* $status = "Demande ajoutée avec succès"; */
        /* return view("demandes.individuelles.show", compact("individuelle")); */
        /* return Redirect::route("demandeurs.show", compact("demandeur"))->with("success", $status); */
        return Redirect::route("demandeurs.show", compact("demandeur"));
    }


    public function edit($id)
    {
        $individuelle = Individuelle::findOrFail($id);
        $departements = Departement::orderBy("created_at", "desc")->get();
        $modules = Module::orderBy("created_at", "desc")->get();
        return view("demandes.individuelles.update", compact("individuelle", "departements", "modules"));
    }


    public function update(Request $request, $id)
    {
        $individuelle   = Individuelle::findOrFail($id);
        $demandeur      = $individuelle->demandeur;
        $user           = $demandeur->user;

        $this->validate($request, [
            'civilite'                      => ["required", "string"],
            "cin"                           => ["required", "string", "min:13", "max:15", "unique:users,cin,{$user->id}"],
            'firstname'                     => ['required', 'string', 'max:50'],
            'name'                          => ['required', 'string', 'max:25'],
            'telephone'                     => ['required', 'string', 'max:25', 'min:9'],
            'telephone_secondaire'          => ['required', 'string', 'max:25', 'min:9'],
            'date_naissance'                => ['required', 'date'],
            'lieu_naissance'                => ['string', 'required'],
            /* 'email'                         => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)], */
            'adresse'                       => ['required', 'string', 'max:255'],
            'departement'                   => ['required', 'string', 'max:255'],
            'module'                        => ['required', 'string', 'max:255'],
            'situation_professionnelle'     => ['required', 'string', 'max:255'],
            'situation_familiale'           => ['required', 'string', 'max:255'],
            'niveau_etude'                  => ['required', 'string', 'max:255'],
            'diplome_academique'            => ['required', 'string', 'max:255'],
            'diplome_professionnel'         => ['required', 'string', 'max:255'],
            'projet_poste_formation'        => ['required', 'string', 'max:255'],
        ]);

        $annee = date('y');
        /* $num = rand(100, 999);
        $letter = chr(rand(65, 90)); */
        /* dd($annee . ' ' . $num . ' ' . $letter); */

        $cin  =   $request->input('cin');
        $cin  =   str_replace(' ', '', $cin);

        /* $num_demande_inividuelle = Individuelle::get()->last()->id;
        $num_demande_inividuelle = ++$num_demande_inividuelle;
        $individuelle_id         = Individuelle::latest('id')->first()->id;

        $longueur = strlen($individuelle_id); */

        /* if (Individuelle::where('id', 1)->exists()) {
            $code = Individuelle::get()->last()->id;;
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
        } */

        $count_individuelle = Individuelle::get()->count();

        $longueur = strlen($count_individuelle);

        if ($longueur == 1) {
            $numero_ind   =   strtolower("0000" . $count_individuelle);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $numero_ind   =   strtolower("000" . $count_individuelle);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $numero_ind   =   strtolower("00" . $count_individuelle);
        } elseif ($longueur >= 4 && $longueur < 5) {
            $numero_ind   =   strtolower("0" . $count_individuelle);
        } else {
            $numero_ind   =   strtolower($count_individuelle);
        }

        $numero_individuelle = 'I' . $annee . '' . $numero_ind;
        $numero_Demande = 'D' . $annee . '' . $numero_ind;

        $date_depot =   date('Y-m-d');

        $departement = Departement::findOrFail($request->input("departement"));
        $regionid = $departement->region->id;

        $user->update([
            'cin'                           =>  $cin,
            'civilite'                      =>  $request->input('civilite'),
            'firstname'                     =>  $request->input('firstname'),
            'name'                          =>  $request->input('name'),
            'date_naissance'                =>  $request->input('date_naissance'),
            'lieu_naissance'                =>  $request->input('lieu_naissance'),
            'email'                         =>  $request->input('email'),
            'telephone'                     =>  $request->input('telephone'),
            'telephone_secondaire'          =>  $request->input('telephone_secondaire'),
            'situation_familiale'           =>  $request->input('situation_familiale'),
            'situation_professionnelle'     =>  $request->input('situation_professionnelle'),
            'adresse'                       =>  $request->input('adresse'),
        ]);

        $user->save();

        if (isset($individuelle->numero)) {
            $demandeur->update([
                'type'                           =>  'individuelle',
                "departements_id"                =>  $request->input("departement"),
                "regions_id"                     =>  $regionid,
                'users_id'                       =>  $user->id,
            ]);

            $demandeur->save();

            $individuelle->update([
                'niveau_etude'                      =>  $request->input('niveau_etude'),
                'diplome_academique'                =>  $request->input('diplome_academique'),
                'autre_diplome_academique'          =>  $request->input('autre_diplome_academique'),
                'option_diplome_academique'         =>  $request->input('option_diplome_academique'),
                'etablissement_academique'          =>  $request->input('etablissement_academique'),
                'diplome_professionnel'             =>  $request->input('diplome_professionnel'),
                'autre_diplome_professionnel'       =>  $request->input('autre_diplome_professionnel'),
                'specialite_diplome_professionnel'  =>  $request->input('specialite_diplome_professionnel'),
                'etablissement_professionnel'       =>  $request->input('etablissement_professionnel'),
                'projet_poste_formation'            =>  $request->input('projet_poste_formation'),
                'projetprofessionnel'               =>  $request->input('projetprofessionnel'),
                'qualification'                     =>  $request->input('qualification'),
                'experience'                        =>  $request->input('experience'),
                "departements_id"                   =>  $request->input("departement"),
                "regions_id"                        =>  $regionid,
                "modules_id"                        =>  $request->input("module"),
                'autre_module'                      =>  $request->input('autre_module'),
                'users_id'                          =>  $user->id,
                'demandeurs_id'                     =>  $demandeur->id
            ]);

            $individuelle->save();
        } else {

            $demandeur->update([
                'type'                           =>  'individuelle',
                'numero_dossier'                 =>  $numero_Demande,
                "departements_id"                =>  $request->input("departement"),
                "regions_id"                     =>  $regionid,
                'users_id'                       =>  $user->id,
            ]);

            $demandeur->save();

            $individuelle->update([
                'date_depot'                        =>  $date_depot,
                'numero'                            =>  $numero_individuelle,
                'niveau_etude'                      =>  $request->input('niveau_etude'),
                'diplome_academique'                =>  $request->input('diplome_academique'),
                'autre_diplome_academique'          =>  $request->input('autre_diplome_academique'),
                'option_diplome_academique'         =>  $request->input('option_diplome_academique'),
                'etablissement_academique'          =>  $request->input('etablissement_academique'),
                'diplome_professionnel'             =>  $request->input('diplome_professionnel'),
                'autre_diplome_professionnel'       =>  $request->input('autre_diplome_professionnel'),
                'specialite_diplome_professionnel'  =>  $request->input('specialite_diplome_professionnel'),
                'etablissement_professionnel'       =>  $request->input('etablissement_professionnel'),
                'projet_poste_formation'            =>  $request->input('projet_poste_formation'),
                'projetprofessionnel'               =>  $request->input('projetprofessionnel'),
                'qualification'                     =>  $request->input('qualification'),
                'experience'                        =>  $request->input('experience'),
                "departements_id"                   =>  $request->input("departement"),
                "regions_id"                        =>  $regionid,
                "modules_id"                        =>  $request->input("module"),
                'autre_module'                      =>  $request->input('autre_module'),
                'users_id'                          =>  $user->id,
                'demandeurs_id'                     =>  $demandeur->id
            ]);

            $individuelle->save();
        }

        /*  $status = "Modification effectuée avec succès";
        return redirect()->back()->with("status", $status); */

        $demandeur = $individuelle->demandeur;

        Alert::success('Modification ! ', 'demande modifié avec succès');

        /* $status = "Votre demande a été modifiée avec succès"; */
        /* return view("demandes.individuelles.show", compact("individuelle")); */
        /* return Redirect::route("demandeurs.show", compact("demandeur"))->with("success", $status); */
        return Redirect::route("demandeurs.show", compact("demandeur"));
    }

    public function show($id)
    {
        $individuelle = Individuelle::findOrFail($id);
        return view("demandes.individuelles.show", compact("individuelle"));
    }

    public function rejeterIndividuelle(Request $request)
    {
        $request->validate([
            'motif' => 'required', 'string'
        ]);

        $individuelle = Individuelle::findOrFail($request->input('id'));
        $individuelle->numero = $request->input('motif');
        $individuelle->save();

        return redirect()->route('modal')->with('success', 'Région modifiée avec succès');
    }
    public function destroy($id)
    {
        $individuelle   = Individuelle::find($id);

        $individuelle->delete();

        Alert::success('La demande de ' . $individuelle->demandeur->user->firstname . ' ' . $individuelle->demandeur->user->name, 'a été supprimée');

        return redirect()->back();
    }
    public function validationsRejetMessage(Request $request, $id)
    {
        $individuelle = Individuelle::findOrFail($id);
        return view("demandes.individuelles.validationsrejetmessage", compact('individuelle'));
    }
}
