<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Collective;
use App\Models\Demandeur;
use App\Models\Individuelle;
use App\Models\Pcharge;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        /*  return view('auth.register'); */
        return view('user.register-page');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'prenom'                => ['required', 'string', 'max:50'],
            'name'                  => ['required', 'string', 'max:25'],
            'email'                 => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'telephone'             => ['required', 'string', 'max:25', 'min:9'],
            /* 'adresse'               => ['required', 'string', 'max:255'], */
            'date_naissance'        => ['required', 'date'],
            'lieu_naissance'        => ['required', 'string', 'max:50'],
            'password'              => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'firstname' => $request->prenom,
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'date_naissance' => $request->date_naissance,
            'lieu_naissance' => $request->lieu_naissance,
            'password' => Hash::make($request->password),
        ]);

        $demandeur = Demandeur::create([
            'users_id' => $user->id,
        ]);

        $individuelle = Individuelle::create([
            'demandeurs_id' => $demandeur->id,
            'users_id' => $user->id,
        ]);

        $collective = Collective::create([
            'demandeurs_id' => $demandeur->id,
            'users_id' => $user->id,
        ]);

        $pcharge = Pcharge::create([
            'demandeurs_id' => $demandeur->id,
            'users_id' => $user->id,
        ]);

        Alert::success('Félicitations ! ' . $user->firstname . ' ' . $user->name, ' Votre compte est créé, introduisez vos identifiants pour vous connecter.');

        $user->assignRole('Demandeur');

        event(new Registered($user));
        event(new Registered($demandeur));
        event(new Registered($individuelle));
        event(new Registered($collective));
        event(new Registered($pcharge));

        /* Se connecter automatiquement après inscription */
        /* Auth::login($user); */

        /* Redirection vers le home directement après incrption */
        /* return redirect(RouteServiceProvider::HOME); */


        /* Redirection vers le connexion après incrption */
        /* $status = "Compte créé, merci de vous connecter";
        return redirect(RouteServiceProvider::LOGIN)->with('status', $status); */

        return redirect(RouteServiceProvider::LOGIN);
    }
}
