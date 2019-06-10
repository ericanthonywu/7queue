<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class auth extends Controller
{
    function login(Request $r){
        $data = Admin::where('username',$r->username);
        if($data->exists() && \Hash::check($r->password,$data->first()['password'])){
            $data = $data->first();
            \Session::put('name',$data->name);
            \Session::put('level',$data->level);
            \Session::put('id',$data->id);
            $words = explode(" ", $data->name);
            $acronym = "";

            foreach ($words as $w) {
                $acronym .= $w[0];
            }
            if(strlen($acronym) > 2){
                $acronym = substr($acronym, 0, 2);
            }
            \Session::put('initial',strtoupper($acronym));
        }else{
            return "Username / Password anda salah";
        }
    }
    function logout(Request $r){
        \Session::flush();
        return redirect('/');
    }
}
