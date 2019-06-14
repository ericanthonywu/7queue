<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Manager;
use Illuminate\Http\Request;
use Prophecy\Promise\PromiseInterface;

class auth extends Controller
{
    function login(Request $r){
        $data = $r->status == "admin" ? Admin::where('username',$r->username) : Manager::where('username',$r->username);
        if($data->exists() && \Hash::check($r->password,$data->first()['password'])){
            $data = $data->first();
            \Session::flush();
            \Session::put('name',$data->nickname);
            \Session::put('level',$r->status == "admin" ? $data->level : 1);
            \Session::put('id',$data->id);
            $words = explode(" ", $data->nickname);
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
        $lvl = \Session::get('level');
        \Session::flush();
        return $lvl == 1 ? redirect('/'): redirect('/admin');
    }
}
