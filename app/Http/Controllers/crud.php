<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class crud extends Controller
{
    function delete(Request $r){
        if($r->table == "admin" && \Session::get('level') !== 3){
            return "Anda tidak memiliki Hak Akses";
        }else if ($r->table == "merchants" || $r->table == "products" && \Session::get('level') !== 1){
            return "Anda tidak memiliki Hak Akses";
        }else {
            DB::table($r->table)->where('id',$r->id)->delete();
        }
    }

    function tambahadmin(Request $r){
        if (!filter_var($r->email, FILTER_VALIDATE_EMAIL)) {
            return "Email Invalid";
        }
        $req = $r->all();
        if(Admin::where('email',$r->email)->exists()){
            return "Email sudah tersedia";
        }else if(Admin::where('username',$r->username)->exists()){
            return "Username Sudah Tersedia";
        }
        $req['password'] = bcrypt($r->password);
        Admin::create($req);
    }
    function editadmin(Request $r){
        if (!filter_var($r->email, FILTER_VALIDATE_EMAIL)) {
            return "Email Invalid";
        }
        $data = Admin::find($r->id);
        $checkemail = Admin::where('email', $r->email);
        $checkname = Admin::where('username', $r->username);
        if ($checkname->exists() && $r->name !== $data->name && $checkemail->exists() && $r->email !== $data->email) {
            return "Username dan Email sudah tersedia";
        } else if ($checkname->exists() && $r->name !== $data->name) {
            return "Username Sudah Tersedia";
        } else if ($checkemail->exists() && $r->email !== $data->email) {
            return "Email Sudah Tersedia";
        }
        $req = $r->all();
        if(empty($r->password)){
            unset($req['password']);
        }else{
            $req['password'] = bcrypt($r->password);
        }
        Admin::find($r->id)->update($req);
    }
    function chgstadmin(Request $r){
        Admin::find($r->id)->update([
            "status"=>$r->status
        ]);
    }
}
