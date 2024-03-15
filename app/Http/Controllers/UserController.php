<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function homePage()
    {
        $total_user = User::count();
        return view("home-page", compact("total_user"));
    }

    public function create()
    {
        return view("user.create");
    }

    public function index()
    {
        $user_liste = User::orderBy('created_at', 'desc')->get();
        /* dd($user_liste); */
        return view("user.index", compact("user_liste"));
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = User::create([
            'firstname' => $request->firstname,
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'password' => Hash::make($request->email),
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

        /* $user = User::create($request->all()); */

        $status = "Enregistrement effectué avec succès";
        return redirect()->back()->with("status", $status);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view("user.update", compact("user"));
    }

    public function update(StoreUserRequest $request, $id): RedirectResponse
    {
        $user = User::find($id);
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
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

            //dd($fileNameToStore);

            $image = Image::make(public_path("/storage/{$imagePath}"))->fit(800, 800);

            $image->save();

            $user->update([
                'image' => $imagePath
            ]);
        }
        $user->save();

        $status = 'Mise à jour effectuée avec succès';

        return Redirect::route('user.index')->with('status', $status);
    }

    public function show($id)
    {
        $user = User::find($id);
        return view("user.show", compact("user"));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        $mesage = $user->firstname . ' ' . $user->name . ' a été supprimé(e)';
        return redirect()->back()->with("success", $mesage);
    }
}
