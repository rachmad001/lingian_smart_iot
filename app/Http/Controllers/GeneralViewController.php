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
        return view('welcome',['user' => session('profile'), 'apps' => 'main']);
    }

    public function project($project){
        $user = session('profile');
        $app = json_decode(
            file_get_contents(app_path('Models/'.$user->username.'/app.json')),
            true
        );
        foreach($app as $list){
            if($list["nameProject"] == $project){
                return view('project',['user' => session('profile'), 'apps' => 'main', 'project' => $project]);
            }
        }
        return "project not found";
    }

    public function lampu($project, $lampu){
        $user = session('profile');
        $app = json_decode(
            file_get_contents(app_path('Models/'.$user->username.'/app.json')),
            true
        );
        foreach($app as $list){
            if($list["nameProject"] == $project){
                foreach($list["devices"] as $device){
                    if($device["name"] == $lampu && $device["type"] == "lampu"){
                        return view('lampu',['user' => session('profile'), 'apps' => 'main', 'project' => $project, 'device' => $device]);
                    }
                }
            }
        }
        return "project not found";
    }

    public function logout(Request $req){
        session()->flush();
        return redirect('/login');
    }
}
