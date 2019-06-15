<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Prophecy\Promise\PromiseInterface;

class auth extends Controller
{
    function login(Request $r){
        $data = $r->status == "admin" ? Admin::where('username',$r->username) : Manager::where('username',$r->username)->orWhere('email',$r->username);
        if($data->exists() && $r->status == "manager" && $data->first()['email_st'] == 0){
            return "Your email hasn't verified yet";
        }
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
            return "Username / Password anda tidak tersedia";
        }
    }
    function register(Request $r){
        $req = $r->all();
        if (!filter_var($r->email, FILTER_VALIDATE_EMAIL)) {
            return "Email Invalid";
        }
        $emailcheck = Manager::whereEmail($r->email)->exists();
        $usernamecheck = Manager::whereUsername($r->username)->exists();
        if($usernamecheck && $emailcheck){
            return "Username dan Email sudah tersedia Mungkin anda sudah mendaftarkannya";
        }
        if($usernamecheck){
            return "Username sudah tersedia";
        }
        if($emailcheck){
            return "Email Sudah tersedia mohon gunakan email lain";
        }
        $req['nickname'] = $r->username;
        $req['password'] = bcrypt($r->password);
        $token = md5(Str::random('100').time());
        Mail::send(['html' => 'emails.konfemail'], [
            "name"=>$r->username,
            "token"=>$token
        ],function($message) use ($r) {
            $message->from('no-reply@7queue.net');
            $message->to($r->email)->subject('Verifikasi Email');
        });
        $req['emailtoken'] = $token;
        Manager::create($req);
    }
    function verify_email($token){
        if(empty($token)){
            return response()->view('error.404',[],404);
        }
        $data = Manager::whereEmailtoken($token);
        if($data->exists()){
            $data = $data->first();
            $data->update([
                "email_st"=>1
            ]);
            \Session::put('alertemail','Your email has been verified! You can login now');
            $data->update([
                "emailtoken"=>null
            ]);
            return redirect('/');
        }
        return response()->view('error.404',[],404);
    }
    function logout(Request $r){
        $lvl = \Session::get('level');
        \Session::flush();
        return $lvl == 1 ? redirect('/'): redirect('/admin');
    }
}
