<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndividuelleStoreRequest;
use App\Models\Demandeur;
use App\Models\Departement;
use App\Models\Individuelle;
use App\Models\Module;
use App\Models\Projet;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class IndividuelleController extends Controller
{
    public function __construct()
    {
        // examples:
        $this->middleware('auth');
        $this->middleware(['role:super-admin|admin|Demandeur']);
        /* $this->middleware(['permission:arrive-show']); */
        // or with specific guard
        /* $this->middleware(['role_or_permission:super-admin']); */
    }
    public function index()
    {
        /* $individuelles = Individuelle::skip(0)->take(1000)->get(); */
        $individuelles = Individuelle::get();
        $departements = Departement::orderBy("created_at", "desc")->get();
        $modules = Module::orderBy("created_at", "desc")->get();

        /* $today = date('Y-m-d');
        $annee = date('Y');
        $annee_lettre = 'Diagramme à barres, année: ' . date('Y');
        $count_today = Individuelle::where("created_at", "LIKE",  "{$today}%")->count();

        $janvier = DB::table('individuelles')->whereMonth("created_at", "01")->where("created_at", "LIKE", "{$annee}%")->where('deleted_at', null)->count();
        $fevrier = DB::table('individuelles')->whereMonth("created_at", "02")->where("created_at", "LIKE", "{$annee}%")->where('deleted_at', null)->count();
        $mars = DB::table('individuelles')->whereMonth("created_at", "03")->where("created_at", "LIKE", "{$annee}%")->where('deleted_at', null)->count();
        $avril = DB::table('individuelles')->whereMonth("created_at", "04")->where("created_at", "LIKE", "{$annee}%")->where('deleted_at', null)->count();
        $mai = DB::table('individuelles')->whereMonth("created_at", "05")->where("created_at", "LIKE", "{$annee}%")->where('deleted_at', null)->count();
        $juin = DB::table('individuelles')->whereMonth("created_at", "06")->where("created_at", "LIKE", "{$annee}%")->where('deleted_at', null)->count();
        $juillet = DB::table('individuelles')->whereMonth("created_at", "07")->where("created_at", "LIKE", "{$annee}%")->where('deleted_at', null)->count();
        $aout = DB::table('individuelles')->whereMonth("created_at", "08")->where("created_at", "LIKE", "{$annee}%")->where('deleted_at', null)->count();
        $septembre = DB::table('individuelles')->whereMonth("created_at", "09")->where("created_at", "LIKE", "{$annee}%")->where('deleted_at', null)->count();
        $octobre = DB::table('individuelles')->whereMonth("created_at", "10")->where("created_at", "LIKE", "{$annee}%")->where('deleted_at', null)->count();
        $novembre = DB::table('individuelles')->whereMonth("created_at", "11")->where("created_at", "LIKE", "{$annee}%")->where('deleted_at', null)->count();
        $decembre = DB::table('individuelles')->whereMonth("created_at", "12")->where("created_at", "LIKE", "{$annee}%")->where('deleted_at', null)->count();

        $masculin = Individuelle::join('users', 'users.id', 'individuelles.users_id')
            ->select('individuelles.*')
            ->where('users.civilite', "M.")
            ->count();

        $feminin = Individuelle::join('users', 'users.id', 'individuelles.users_id')
            ->select('individuelles.*')
            ->where('users.civilite', "Mme")
            ->count();

        $attente = Individuelle::where('statut', 'attente')
            ->count();

        $nouvelle = Individuelle::where('statut', 'nouvelle')
            ->count();

        $retenue = Individuelle::where('statut', 'retenue')
            ->count();

        $terminer = Individuelle::where('statut', 'terminer')
            ->count();

        $rejeter = Individuelle::where('statut', 'rejeter')
            ->count();

        $pourcentage_hommes = ($masculin / $individuelles->count()) * 100;
        $pourcentage_femmes = ($feminin / $individuelles->count()) * 100; 

        return view("individuelles.index", compact("pourcentage_femmes", "pourcentage_hommes", "rejeter", "terminer", "retenue", "nouvelle", "attente", "individuelles", "modules", "departements", "count_today", 'janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'decembre', 'annee', 'annee_lettre', 'masculin', 'feminin'));*/
        return view("individuelles.index", compact('individuelles', 'departements', 'modules'));
    }

    public function create()
    {
        //
    }

    /* public function store(IndividuelleStoreRequest $request): RedirectResponse */
    public function store(Request $request)
    {
        $this->validate($request, [
            'telephone_secondaire'          => ['required', 'string', 'max:9', 'min:9'],
            'adresse'                       => ['required', 'string', 'max:255'],
            'departement'                   => ['required', 'string', 'max:255'],
            'module'                        => ['required', 'string', 'max:255'],
            'niveau_etude'                  => ['required', 'string', 'max:255'],
            'diplome_academique'            => ['required', 'string', 'max:255'],
            'diplome_professionnel'         => ['required', 'string', 'max:255'],
            'projet_poste_formation'        => ['required', 'string', 'max:255'],
        ]);

        $user = Auth::user();

        $individuelle_total = Individuelle::where('users_id', $user->id)->count();

        if ($individuelle_total >= 3) {
            Alert::warning('Attention ! ', 'Vous avez atteint le nombre de demandes autoriées');
            return redirect()->back();
        } else {

            /* $annee = date('y');
            $cin  =   $request->input('cin');
            $cin  =   str_replace(' ', '', $cin);
            $date_depot =   date('Y-m-d');

            $rand = rand(0, 999);

            $letter1 = chr(rand(65, 90));
            $letter2 = chr(rand(65, 90));
            $random = $letter1.''.$rand . '' . $letter2;

            $longueur = strlen($random);

            if ($longueur == 1) {
                $numero_individuelle   =   strtoupper("0000" . $random);
            } elseif ($longueur >= 2 && $longueur < 3) {
                $numero_individuelle   =   strtoupper("000" . $random);
            } elseif ($longueur >= 3 && $longueur < 4) {
                $numero_individuelle   =   strtoupper("00" . $random);
            } elseif ($longueur >= 4 && $longueur < 5) {
                $numero_individuelle   =   strtoupper("0" . $random);
            } else {
                $numero_individuelle   =   strtoupper($random);
            }
            $numero_individuelle = 'I' . $annee . $numero_individuelle; */

            $cin  =   $request->input('cin');
            $cin  =   str_replace(' ', '', $cin);
            $date_depot =   date('Y-m-d');

            $annee = date('y');
            $numero_individuelle = Individuelle::get()->last();
            if (isset($numero_individuelle)) {
                $numero_individuelle = Individuelle::get()->last()->numero;
                $numero_individuelle = ++$numero_individuelle;
                $longueur = strlen($numero_individuelle);
                if ($longueur <= 1) {
                    $numero_individuelle   =   strtolower("0000" . $numero_individuelle);
                } elseif ($longueur >= 2 && $longueur < 3) {
                    $numero_individuelle   =   strtolower("000" . $numero_individuelle);
                } elseif ($longueur >= 3 && $longueur < 4) {
                    $numero_individuelle   =   strtolower("00" . $numero_individuelle);
                } elseif ($longueur >= 4 && $longueur < 5) {
                    $numero_individuelle   =   strtolower("0" . $numero_individuelle);
                } else {
                    $numero_individuelle   =   strtolower($numero_individuelle);
                }
            } else {
                $numero_individuelle = "00001";
                $numero_individuelle = 'I' . $annee . $numero_individuelle;
            }

            $numero_individuelle = strtoupper($numero_individuelle);

            $departement = Departement::where('nom', $request->input("departement"))->first();

            $regionid = $departement->region->id;

            $module_find    = DB::table('modules')->where('name', $request->input("module"))->first();

            $demandeur_ind = Individuelle::where('users_id', $user->id)->get();

            if (isset($module_find)) {
                foreach ($demandeur_ind as $key => $value) {
                    if ($value->module->name == $module_find->name) {
                        Alert::warning('Attention ! le module ' . $value->module->name, 'a déjà été choisi');
                        return redirect()->back();
                    }
                }
                $individuelle = new Individuelle([
                    'date_depot'                        =>  $date_depot,
                    'numero'                            =>  $numero_individuelle,
                    'adresse'                           =>  $request->input('adresse'),
                    'fixe'                              =>  $request->input('telephone_secondaire'),
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
                    "departements_id"                   =>  $departement->id,
                    "regions_id"                        =>  $regionid,
                    "modules_id"                        =>  $module_find->id,
                    /* 'autre_module'                      =>  $request->input('autre_module'), */
                    'statut'                            => 'nouvelle',
                    'users_id'                          =>  $user->id,
                ]);
            } else {
                $module = new Module([
                    'name'            => $request->input('module'),
                ]);

                $module->save();

                $individuelle = new Individuelle([
                    'date_depot'                        =>  $date_depot,
                    'numero'                            =>  $numero_individuelle,
                    'adresse'                           =>  $request->input('adresse'),
                    'fixe'                              =>  $request->input('telephone_secondaire'),
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
                    "departements_id"                   =>  $departement->id,
                    "regions_id"                        =>  $regionid,
                    "modules_id"                        =>  $module->id,
                    /* 'autre_module'                      =>  $request->input('autre_module'), */
                    'statut'                            => 'nouvelle',
                    'users_id'                          =>  $user->id,
                ]);
            }
        }

        $individuelle->save();

        Alert::success('Enregistrée ! ', 'demande ajoutée avec succès');

        return Redirect::back();
    }

    public function addIndividuelle(Request $request)
    {
        $this->validate($request, [
            'civilite'                      => ["required", "string"],
            'date_depot'                    => ["required", "date"],
            "cin"                           => ["required", "string", "min:13", "max:15", Rule::unique(User::class)],
            'firstname'                     => ['required', 'string', 'max:50'],
            'lastname'                      => ['required', 'string', 'max:25'],
            'telephone'                     => ['required', 'string', 'max:25', 'min:9', 'max:9'],
            'telephone_secondaire'          => ['required', 'string', 'max:25', 'min:9', 'max:9'],
            'date_naissance'                => ['required', 'date'],
            'lieu_naissance'                => ['string', 'required'],
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

        $cin  =   $request->input('cin');
        $cin  =   str_replace(' ', '', $cin);

        /* $rand = rand(0, 999);
        $letter1 = chr(rand(65, 90));
        $letter2 = chr(rand(65, 90));
        $random = $letter1.''.$rand . '' . $letter2;
        $longueur = strlen($random);

        if ($longueur == 1) {
            $numero_individuelle   =   strtoupper("0000" . $random);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $numero_individuelle   =   strtoupper("000" . $random);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $numero_individuelle   =   strtoupper("00" . $random);
        } elseif ($longueur >= 4 && $longueur < 5) {
            $numero_individuelle   =   strtoupper("0" . $random);
        } else {
            $numero_individuelle   =   strtoupper($random);
        } */

        $annee = date('y');
        $numero_individuelle = Individuelle::get()->last();
        if (isset($numero_individuelle)) {
            $numero_individuelle = Individuelle::get()->last()->numero;
            $numero_individuelle = ++$numero_individuelle;
            $longueur = strlen($numero_individuelle);
            if ($longueur <= 1) {
                $numero_individuelle   =   strtolower("0000" . $numero_individuelle);
            } elseif ($longueur >= 2 && $longueur < 3) {
                $numero_individuelle   =   strtolower("000" . $numero_individuelle);
            } elseif ($longueur >= 3 && $longueur < 4) {
                $numero_individuelle   =   strtolower("00" . $numero_individuelle);
            } elseif ($longueur >= 4 && $longueur < 5) {
                $numero_individuelle   =   strtolower("0" . $numero_individuelle);
            } else {
                $numero_individuelle   =   strtolower($numero_individuelle);
            }
        } else {
            $numero_individuelle = "00001";
            $numero_individuelle = 'I' . $annee . $numero_individuelle;
        }

        $numero_individuelle = strtoupper($numero_individuelle);


        $departement = Departement::where('nom', $request->input("departement"))->first();
        $regionid = $departement->region->id;

        $module_find    = DB::table('modules')->where('name', $request->input("module"))->first();

        $user = User::create([
            'civilite'                          => $request->input('civilite'),
            'cin'                               => $cin,
            'firstname'                         => $request->input('firstname'),
            'name'                              => $request->input('lastname'),
            'date_naissance'                    => $request->input('date_naissance'),
            'lieu_naissance'                    => $request->input('lieu_naissance'),
            'email'                             => $request->input('email'),
            'telephone'                         => $request->input('telephone'),
            'telephone_secondaire'              => $request->input('telephone_secondaire'),
            'situation_familiale'               => $request->input('situation_familiale'),
            'situation_professionnelle'         => $request->input('situation_professionnelle'),
            'adresse'                           => $request->input('adresse'),
            'password'                          => Hash::make($request->email),
        ]);

        $user->save();

        $user->update([
            'username'                          => $request->input('lastname') . '' . $user->id,
        ]);

        $user->save();

        $user->assignRole('Demandeur');

        if (isset($module_find)) {
            $individuelle = new Individuelle([
                'date_depot'                        =>  $request->input('date_depot'),
                'numero'                            =>  $numero_individuelle,
                'fixe'                              =>  $request->input('telephone_secondaire'),
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
                "departements_id"                   =>  $departement->id,
                "regions_id"                        =>  $regionid,
                "modules_id"                        =>  $module_find->id,
                /* 'autre_module'                      =>  $request->input('autre_module'), */
                'statut'                            => 'nouvelle',
                'users_id'                          =>  $user->id,
            ]);
        } else {
            $module = new Module([
                'name'            => $request->input('module'),
            ]);

            $module->save();

            $individuelle = new Individuelle([
                'date_depot'                        =>  $request->input('date_depot'),
                'numero'                            =>  $numero_individuelle,
                'niveau_etude'                      =>  $request->input('niveau_etude'),
                'fixe'                              =>  $request->input('telephone_secondaire'),
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
                "departements_id"                   =>  $departement->id,
                "regions_id"                        =>  $regionid,
                "modules_id"                        =>  $module->id,
                /* 'autre_module'                      =>  $request->input('autre_module'), */
                'statut'                            => 'nouvelle',
                'users_id'                          =>  $user->id,
            ]);
        }

        $individuelle->save();

        Alert::success('Enregistrée ! ', 'demande ajoutée avec succès');

        return redirect()->back();
    }

    public function edit($id)
    {
        $individuelle       = Individuelle::findOrFail($id);
        $departements       = Departement::orderBy("created_at", "desc")->get();
        $modules            = Module::orderBy("created_at", "desc")->get();
        $projets            = Projet::orderBy("created_at", "desc")->get();

        if ($individuelle->statut != 'nouvelle') {
            Alert::warning('Attention ! ', 'action impossible demande déjà traitée');
            return redirect()->back();
        } else {
            return view("individuelles.update", compact("individuelle", "departements", "modules", "projets"));
        }
    }
    public function update(Request $request, $id)
    {
        $individuelle       = Individuelle::findOrFail($id);
        $user_id            = $individuelle?->users_id;


        $this->validate($request, [
            'telephone_secondaire'          => ['required', 'string', 'max:25', 'min:9', 'max:9'],
            'adresse'                       => ['required', 'string', 'max:255'],
            'departement'                   => ['required', 'string', 'max:255'],
            'module'                        => ['required', 'string', 'max:255'],
            'niveau_etude'                  => ['required', 'string', 'max:255'],
            'diplome_academique'            => ['required', 'string', 'max:255'],
            'diplome_professionnel'         => ['required', 'string', 'max:255'],
            'projet_poste_formation'        => ['required', 'string', 'max:255'],
        ]);

        $departement        = Departement::where('nom', $request->input("departement"))->first();

        $regionid           = $departement->region->id;
        $user               = Auth::user();

        $module_find    = DB::table('modules')->where('name', $request->input("module"))->first();

        $demandeur_ind  = Individuelle::where('users_id', $user->id)->get();

        if (isset($individuelle->module) && ($individuelle->module->name == $module_find->name)) {
            $individuelle->update([
                'niveau_etude'                      =>  $request->input('niveau_etude'),
                'fixe'                              =>  $request->input('telephone_secondaire'),
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
                "departements_id"                   =>  $departement->id,
                "projets_id"                        =>  $request->input("projet"),
                "regions_id"                        =>  $regionid,
                'users_id'                          =>  $user_id,
            ]);
        } elseif (isset($module_find)) {
            foreach ($demandeur_ind as $value) {
                if ($value->module->name == $module_find->name) {
                    Alert::warning('Attention ! le module ' . $value->module->name, 'a déjà été choisi');
                    return redirect()->back();
                }
            }
            $individuelle->update([
                'niveau_etude'                      =>  $request->input('niveau_etude'),
                'fixe'                              =>  $request->input('telephone_secondaire'),
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
                "departements_id"                   =>  $departement->id,
                "projets_id"                        =>  $request->input("projet"),
                "regions_id"                        =>  $regionid,
                "modules_id"                        =>  $module_find->id,
                /* 'autre_module'                      =>  $request->input('autre_module'), */
                'users_id'                          =>  $user_id,
            ]);
        } else {

            $module = new Module([
                'name'            => $request->input('module'),
            ]);

            $module->save();

            $individuelle->update([
                'niveau_etude'                      =>  $request->input('niveau_etude'),
                'fixe'                              =>  $request->input('telephone_secondaire'),
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
                "departements_id"                   =>  $departement->id,
                "projets_id"                        =>  $request->input("projet"),
                "regions_id"                        =>  $regionid,
                "modules_id"                        =>  $module->id,
                /* 'autre_module'                      =>  $request->input('autre_module'), */
                'users_id'                          =>  $user_id,
            ]);
        }

        $individuelle->save();

        Alert::success('Modification ! ', 'demande modifié avec succès');
        return Redirect::route("demandesIndividuelle");
    }

    public function show($id)
    {
        $individuelle = Individuelle::findOrFail($id);
        return view("individuelles.show", compact("individuelle"));
    }

    public function rejeterIndividuelle(Request $request)
    {
        $request->validate([
            'motif' => 'required',
            'string'
        ]);

        $individuelle = Individuelle::findOrFail($request->input('id'));
        $individuelle->numero = $request->input('motif');
        $individuelle->save();

        return redirect()->route('modal')->with('success', 'Région modifiée avec succès');
    }
    public function destroy($id)
    {
        $individuelle   = Individuelle::find($id);

        if ($individuelle->statut != 'nouvelle') {
            Alert::warning('Attention ! ', 'action impossible demande déjà traitée');
            return redirect()->back();
        } else {
            $individuelle->update([
                'numero'        => $individuelle->numero . '/' . $id,
            ]);

            $individuelle->save();

            $individuelle->delete();

            Alert::success('Fait !', 'demande supprimée');

            return redirect()->back();
        }
    }
    public function validationsRejetMessage(Request $request, $id)
    {
        $individuelle = Individuelle::findOrFail($id);
        return view("individuelles.validationsrejetmessage", compact('individuelle'));
    }

    public function demandesIndividuelle()
    {
        $departements = Departement::orderBy("created_at", "desc")->get();
        $modules = Module::orderBy("created_at", "desc")->get();
        $user = Auth::user();
        $individuelle = Individuelle::where('users_id', $user->id)->get();
        $individuelle_total = $individuelle->count();

        return view("individuelles.show-individuelle", compact("individuelle_total", "departements", "modules"));
    }
}
