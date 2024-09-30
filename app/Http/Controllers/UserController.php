<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Arrive;
use App\Models\Depart;
use App\Models\Departement;
use App\Models\Direction;
use App\Models\Employee;
use App\Models\Individuelle;
use App\Models\Interne;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        // examples:
        $this->middleware('auth');
        $this->middleware(['role:super-admin|admin|DIOF|DEC|DPP']);
        $this->middleware("permission:role-view", ["only" => ["index"]]);
        $this->middleware("permission:role-create", ["only" => ["create", "store"]]);
        $this->middleware("permission:role-update", ["only" => ["update", "edit"]]);
        $this->middleware("permission:role-show", ["only" => ["show"]]);
        $this->middleware("permission:role-delete", ["only" => ["destroy"]]);
        $this->middleware("permission:give-role-permissions", ["only" => ["givePermissionsToRole"]]);
        /* $this->middleware(['permission:arrive-show']); */
        // or with specific guard
        /* $this->middleware(['role_or_permission:super-admin']); */
    }

    public function homePage()
    {
        $total_user = User::count();
        $email_verified_at = DB::table(table: 'users')->where('email_verified_at', '!=', null)->count();
        $total_arrive = Arrive::count();
        $total_depart = Depart::count();
        $total_interne = Interne::count();

        $total_courrier = $total_arrive + $total_depart + $total_interne;

        if ($total_courrier != 0) {
            $pourcentage_arrive = ($total_arrive / $total_courrier) * 100;
            $pourcentage_depart = ($total_depart / $total_courrier) * 100;
            $pourcentage_interne = ($total_interne / $total_courrier) * 100;
        } else {
            $pourcentage_arrive = 0;
            $pourcentage_depart = 0;
            $pourcentage_interne = 0;
        }

        $total_individuelle = Individuelle::count();
        $roles = Role::orderBy('created_at', 'desc')->get();
        /* return view("home-page", compact("total_user", 'roles', 'total_arrive', 'total_depart', 'total_individuelle')); */



        /* $individuelles = Individuelle::skip(0)->take(1000)->get(); */
        $individuelles = Individuelle::get();
        $departements = Departement::orderBy("created_at", "desc")->get();
        $modules = Module::orderBy("created_at", "desc")->get();

        $today = date('Y-m-d');
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
        $email_verified_at = ($email_verified_at / $total_user) * 100;

        return view("home-page", compact("total_user", 'roles', 'total_arrive', 'total_depart', 'total_individuelle', "pourcentage_femmes", "pourcentage_hommes", "rejeter", "terminer", "retenue", "nouvelle", "attente", "individuelles", "modules", "departements", "count_today", 'janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'decembre', 'annee', 'annee_lettre', 'masculin', 'feminin', 'email_verified_at', 'total_interne', 'pourcentage_arrive', 'pourcentage_depart', 'pourcentage_interne'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();

        return view("user.create", compact("roles"));
    }

    public function index()
    {
        $user_liste = User::orderBy('created_at', 'desc')->get();
        return view("user.index", compact("user_liste"));
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->validate($request, [
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)],
        ]);

        if ($request->password) {
            $password = Hash::make($request->password);
        } else {
            $password = Hash::make($request->email);
        }

        $user = User::create([
            'firstname' => $request->firstname,
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'password' => $password,
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('avatars', 'public');
            $file = $request->file('image');
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Remove unwanted characters
            $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
            $filename = preg_replace("/\s+/", '-', $filename);
            // Get the original image extension
            $extension = $file->getClientOriginalExtension();

            // Create unique file name
            $fileNameToStore = 'avatars/' . $filename . '' . time() . '.' . $extension;

            //dd($fileNameToStore);

            $image = Image::make(public_path("/storage/{$imagePath}"))->fit(800, 800);

            $image->save();

            $user->update([
                'image' => $imagePath
            ]);
        }

        $user->syncRoles($request->roles);

        /* $user = User::create($request->all()); */

        $status = "Enregistrement effectué avec succès";
        return redirect()->back()->with("status", $status);
    }

    public function edit($id)
    {
        $roles = Role::pluck('name', 'name')->all();

        $user = User::findOrFail($id);

        $userRoles = $user->roles->pluck('name', 'name')->all();

        return view("user.update", compact('user', 'roles', 'userRoles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->input('employe') == "1") {
            $this->validate($request, [
                /* "matricule"           => ['nullable', 'string', 'min:8', 'max:8',Rule::unique(Employee::class)], */
                "matricule"           => ['nullable', 'string', 'min:8', 'max:8', "unique:employees,matricule,Null,{$user?->employee?->id},deleted_at,NULL"],
                /* 'cin'                 => ['required', 'string', 'min:13', 'max:15',Rule::unique(User::class)], */
                'direction'           => ['required', 'string'],
            ]);
            Employee::create([
                'users_id'      => $user?->id,
                /* 'cin'           => $request?->input('employe'), */
                'matricule'     => $request?->input('matricule'),
                'directions_id' => $request?->input('direction'),
            ]);
            Alert::success('Effectuée ! ', 'employé ajouté');

            $user->assignRole('Employe');
            
            return Redirect::back();
        } else {

            $this->validate($request, [
                'civilite'         => ['nullable', 'string', 'max:10'],
                'username'         => ['required', 'string', 'max:150'],
                "cin"              => ["required", "string", "min:13", "max:15", Rule::unique(User::class)->ignore($id)],
                'firstname'        => ['required', 'string', 'max:150'],
                'name'             => ['required', 'string', 'max:50'],
                'date_naissance'   => ['string', 'nullable'],
                'lieu_naissance'   => ['string', 'nullable'],
                'image'            => ['image', 'max:255', 'nullable', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
                'telephone'        => ['required', 'string', 'max:25', 'min:9'],
                'adresse'          => ['required', 'string', 'max:255'],
                'password'         => ['string', 'max:255', 'nullable'],
                'roles.*'          => ['string', 'max:255', 'nullable', 'max:255'],
                "email"            => ["lowercase", 'email', "max:255", Rule::unique(User::class)->ignore($id)],
            ]);

            if (request('image')) {
                $imagePath = request('image')->store('avatars', 'public');
                $file = $request->file('image');
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Remove unwanted characters
                $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
                $filename = preg_replace("/\s+/", '-', $filename);
                // Get the original image extension
                $extension = $file->getClientOriginalExtension();

                // Create unique file name
                $fileNameToStore = 'avatars/' . $filename . '' . time() . '.' . $extension;

                //dd($fileNameToStore);

                $image = Image::make(public_path("/storage/{$imagePath}"))->fit(800, 800);

                $image->save();

                $user->update([
                    'image' => $imagePath
                ]);
            }
            if (isset($request->password)) {
                $password = Hash::make($request->password);
                $user->update([
                    'password'                  =>  $password,
                    'civilite'                  =>  $request->civilite,
                    'username'                  =>  $request->username,
                    'cin'                       =>  $request->cin,
                    'firstname'                 =>  $request->firstname,
                    'name'                      =>  $request->name,
                    'date_naissance'            =>  $request->date_naissance,
                    'lieu_naissance'            =>  $request->lieu_naissance,
                    'situation_familiale'       =>  $request->situation_familiale,
                    'situation_professionnelle' =>  $request->situation_professionnelle,
                    'email'                     =>  $request->email,
                    'telephone'                 =>  $request->telephone,
                    'adresse'                   =>  $request->adresse,
                    'twitter'                   =>  $request->twitter,
                    'facebook'                  =>  $request->facebook,
                    'instagram'                 =>  $request->instagram,
                    'linkedin'                  =>  $request->linkedin,
                    'updated_by'                =>  Auth::user()->id,
                ]);
            } else {
                $user->update([
                    'civilite'                  =>  $request->civilite,
                    'username'                  =>  $request->username,
                    'cin'                       =>  $request->cin,
                    'firstname'                 =>  $request->firstname,
                    'name'                      =>  $request->name,
                    'date_naissance'            =>  $request->date_naissance,
                    'lieu_naissance'            =>  $request->lieu_naissance,
                    'situation_familiale'       =>  $request->situation_familiale,
                    'situation_professionnelle' =>  $request->situation_professionnelle,
                    'email'                     =>  $request->email,
                    'telephone'                 =>  $request->telephone,
                    'adresse'                   =>  $request->adresse,
                    /* 'password'                  =>  $request->newPassword, */
                    'twitter'                   =>  $request->twitter,
                    'facebook'                  =>  $request->facebook,
                    'instagram'                 =>  $request->instagram,
                    'linkedin'                  =>  $request->linkedin,
                    'updated_by'                =>  Auth::user()->id,
                ]);
            }

            /* $user->save(); */

            $user->syncRoles($request->roles);


            Alert::success('Effectuée ! ', 'Mise à jour effectuée');

            /*  $status = 'Mise à jour effectuée avec succès'; */

            /* return Redirect::route('user.index')->with('status', $status); */
            return Redirect::route('user.index');
        }
    }

    public function show($id)
    {
        $user = User::find($id);

        if ($user->created_by == null || $user->updated_by == null) {
            $user_create_name = "moi même";
            $user_update_name = "moi même";
        } else {
            $user_created_id = $user->created_by;
            $user_updated_id = $user->updated_by;

            $user_create = User::findOrFail($user_created_id);
            $user_update = User::findOrFail($user_updated_id);

            $user_create_name = $user_create->firstname . " " . $user_create->firstname;
            $user_update_name = $user_update->firstname . " " . $user_update->firstname;
        }

        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        $directions = Direction::orderBy('created_at', 'desc')->get();


        return view("user.show", compact("user", "user_create_name", "user_update_name", "roles", "userRoles", "directions"));
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->roles()->detach();
        $user->delete();

        /* $mesage = $user->firstname . ' ' . $user->name . ' a été supprimé(e)';
        return redirect()->back()->with("danger", $mesage); */

        Alert::success('Fait ! ' . $user->firstname . ' ' . $user->name, 'a été(e) supprimé(e)');

        return redirect()->back();
    }
}
