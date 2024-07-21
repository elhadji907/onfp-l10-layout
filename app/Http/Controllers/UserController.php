<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Arrive;
use App\Models\Depart;
use App\Models\Individuelle;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        /* $this->middleware(['role:super-admin|admin']); */
        /* $this->middleware(['permission:arrive-show']); */
        // or with specific guard
        /* $this->middleware(['role_or_permission:super-admin']); */
    }

    public function homePage()
    {
        $total_user = User::count();
        $total_arrive = Arrive::count();
        $total_depart = Depart::count();
        $total_individuelle = Individuelle::count();
        $roles = Role::orderBy('created_at', 'desc')->get();
        return view("home-page", compact("total_user", 'roles', 'total_arrive', 'total_depart', 'total_individuelle'));
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

        $this->validate($request, [
            'civilite' => ['nullable', 'string', 'max:10'],
            'firstname' => ['required', 'string', 'max:150'],
            'name' => ['required', 'string', 'max:50'],
            'date_naissance' => ['string', 'nullable'],
            'lieu_naissance' => ['string', 'nullable'],
            'image' => ['image', 'max:255', 'nullable', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'telephone' => ['required', 'string', 'max:25', 'min:9'],
            'adresse' => ['required', 'string', 'max:255'],
            'password' => ['string', 'max:255', 'nullable'],
            'roles.*' => ['string', 'max:255', 'nullable', 'max:255'],
            "email" => ["lowercase", 'email', "max:255", Rule::unique(User::class)->ignore($id)],
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

        return view("user.show", compact("user", "user_create_name", "user_update_name", "roles", "userRoles"));
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->roles()->detach();
        $user->delete();

        /* $mesage = $user->firstname . ' ' . $user->name . ' a été supprimé(e)';
        return redirect()->back()->with("danger", $mesage); */
        
        Alert::success('Fait ! '.$user->firstname . ' ' . $user->name , 'a été(e) supprimé(e)');

        return redirect()->back();
    }
}
