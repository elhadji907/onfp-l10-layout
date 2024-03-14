<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class UserController extends Controller
{
    public function homePage()
    {
        $total_user = User::count();
        return view("home-page", compact("total_user"));
    }

    public function index()
    {
        $user_liste = User::orderBy('created_at', 'desc')->get();
        /* dd($user_liste); */
        return view("user.index", compact("user_liste"));
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        return redirect()->back()->with("success", "Enregistrement effectué avec succès");
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
        
        $user->save();

        return Redirect::route('user.index')->with('status', 'Mise à jour effectuée avec succès');
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
