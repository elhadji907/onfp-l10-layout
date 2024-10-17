<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Collective;
use App\Models\Individuelle;
use App\Models\Projet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{

    /**
     * Display the user's profile show.
     */
    public function profilePage(Request $request): View
    {
        $user = Auth::user();
        $projets = Projet::where('statut', 'ouvert')
            ->orwhere('statut', 'fermer')
            ->get();

        $individuelles = Individuelle::where('users_id', $user->id)
            ->where('projets_id',  null)
            ->get();

        $collectives = Collective::where('users_id', $user->id)
            ->get();

        foreach (Auth::user()->roles as $role) {
            if ($role->name == 'Operateur') {
                return view('profile.profile-operateur-page', [
                    'user' => $request->user(),
                    'projets' => $projets,
                ]);
            } else {
                return view('profile.profile-page', [
                    'user' => $request->user(),
                    'projets' => $projets,
                    'individuelles' => $individuelles,
                    'collectives' => $collectives,
                ]);
            }
        }

        return view('profile.profile-page', [
            'user' => $request->user(),
            'projets' => $projets,
        ]);
    }

    /**
     * Display the user's lin.
     */
    public function loginPage(Request $request): View
    {
        return view('user.login-page');
    }
    /**
     * Display the user's register.
     */
    public function registerPage(Request $request): View
    {
        return view('user.register-page');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

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

            /* dd($fileNameToStore); */

            $image = Image::make(public_path("/storage/{$imagePath}"))->fit(800, 800);

            $image->save();

            $request->user()->update([
                'image' => $imagePath
            ]);
        }

        $request->user()->save();

        Alert::success('Effectuée ! ', 'Votre profil a été modifié avec succès');

        /* return Redirect::route('profile.edit')->with('status', 'profile-updated'); */
        /* return Redirect::route('profil')->with('status', 'Votre profil a été modifié avec succès'); */
        return Redirect::route('profil');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
