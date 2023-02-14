<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralViewController extends Controller
{
    //
    public function login(){
        return view('autenticated.login');
    }

    public function index(){
        return view('welcome',['user' => session('profile')]);
    }
}
