<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function homePage(){
        return view("user.home-page");
    }
}
