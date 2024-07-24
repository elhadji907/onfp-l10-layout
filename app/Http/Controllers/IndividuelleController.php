<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndividuelleStoreRequest;
use App\Models\Demandeur;
use App\Models\Departement;
use App\Models\Individuelle;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class IndividuelleController extends Controller
{
    public function index()
    {
        $individuelles = Individuelle::get();
        $departements = Departement::orderBy("created_at", "desc")->get();
        $modules = Module::orderBy("created_at", "desc")->get();
        return view("individuelles.index", compact("individuelles", "modules", "departements"));
    }

    public function create()
    {
        //
    }

    /* public function store(IndividuelleStoreRequest $request): RedirectResponse */
    public function store(Request $request)
    {
        $this->validate($request, [
            'telephone_secondaire'          => ['required', 'string', 'max:25', 'min:9'],
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

        if ($individuelle_total >= 5) {
            Alert::warning('Attention ! ', 'Vous avez atteint le nombre de demandes autoriées');
            return redirect()->back();
        } else {
            $annee = date('y');
            $cin  =   $request->input('cin');
            $cin  =   str_replace(' ', '', $cin);
            $date_depot =   date('Y-m-d');

            $rand = rand(0, 999);

            $letter = chr(rand(65, 90));

            $random = $rand . '' . $letter;

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
            $numero_individuelle = 'I' . $annee . $numero_individuelle;

            $departement = Departement::findOrFail($request->input("departement"));

            $regionid = $departement->region->id;

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
                "departements_id"                   =>  $request->input("departement"),
                "regions_id"                        =>  $regionid,
                "modules_id"                        =>  $request->input("module"),
                'autre_module'                      =>  $request->input('autre_module'),
                'statut'                            => 'attente',
                'users_id'                          =>  $user->id,
            ]);

            $individuelle->save();
        }

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
            'name'                          => ['required', 'string', 'max:25'],
            'telephone'                     => ['required', 'string', 'max:25', 'min:9'],
            'telephone_secondaire'          => ['required', 'string', 'max:25', 'min:9'],
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

        $annee = date('y');
        $rand = rand(0, 999);
        $letter = chr(rand(65, 90));
        $random = $rand . '' . $letter;
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
        $numero_individuelle = 'I' . $annee . $numero_individuelle;

        $departement = Departement::findOrFail($request->input("departement"));
        $regionid = $departement->region->id;

        $user = User::create([
            'civilite'                          => $request->input('civilite'),
            'cin'                               => $cin,
            'firstname'                         => $request->input('firstname'),
            'name'                              => $request->input('name'),
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
            'username'                          => $request->input('name').''.$user->id,
        ]);

        $user->save();

        $user->assignRole('Demandeur');

        $individuelle = new Individuelle([
            'date_depot'                        =>  $request->input('date_depot'),
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
            'statut'                            => 'attente',
            'users_id'                          =>  $user->id,
        ]);

        $individuelle->save();

        Alert::success('Enregistrée ! ', 'demande ajoutée avec succès');

        return redirect()->back();
    }

    public function edit($id)
    {
        $individuelle = Individuelle::findOrFail($id);
        $departements = Departement::orderBy("created_at", "desc")->get();
        $modules = Module::orderBy("created_at", "desc")->get();
        return view("individuelles.update", compact("individuelle", "departements", "modules"));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'telephone_secondaire'          => ['required', 'string', 'max:25', 'min:9'],
            'adresse'                       => ['required', 'string', 'max:255'],
            'departement'                   => ['required', 'string', 'max:255'],
            'module'                        => ['required', 'string', 'max:255'],
            'niveau_etude'                  => ['required', 'string', 'max:255'],
            'diplome_academique'            => ['required', 'string', 'max:255'],
            'diplome_professionnel'         => ['required', 'string', 'max:255'],
            'projet_poste_formation'        => ['required', 'string', 'max:255'],
        ]);

        $individuelle   = Individuelle::findOrFail($id);
        $user_id           = $individuelle?->users_id;
        $departement = Departement::findOrFail($request->input("departement"));
        $regionid = $departement->region->id;

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
            'users_id'                          =>  $user_id,
        ]);

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

        Alert::success('Fait !', 'demande supprimée');

        return redirect()->back();
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
