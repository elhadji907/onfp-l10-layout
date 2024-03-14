<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $user_liste = User::get();
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
        dd($user);
        return view("user.edit", compact("user"));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
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
        $mesage = $user->firstname.' '.$user->name.' a été supprimé(e)';
        return redirect()->back()->with("success", $mesage);
    }
}
