<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function homePage(){
        $total_user = User::count();
        return view("user.home-page", compact("total_user"));
    }

    public function userListe(){
        $user_liste = User::get();
        return view("user.user-liste", compact("user_liste"));
    }
}
