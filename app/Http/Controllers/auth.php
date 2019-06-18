<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class auth extends Controller
{
    public function response($status, $message, $apikey, $data, $header = null)
    {
        return
            $apikey !== null
                ?
                response()->json([
                    "status" => $status,
                    "message" => $message,
                    "apiKey" => $apikey,
                    "data" => $data
                ], $header ? (int)$header : 200)
                :
                response()->json([
                    "status" => $status,
                    "message" => $message,
                    "data" => $data
                ], $header ? (int)$header : 200);
    }
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
            return "Username dan Email sudah tersedia. <br> Mungkin anda sudah mendaftarkannya";
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
            "token"=>$token,
            "data"=>"manager"
        ],function($message) use ($r) {
            $message->from('no-reply@7queue.net');
            $message->to($r->email)->subject('Verifikasi Email');
        });
        $req['emailtoken'] = $token;
        Manager::create($req);
    }
    function verify_email($token,$role){
        if(empty($token)){
            return response()->view('error.404',[],404);
        }
        switch ($role){
            case "manager":
                $check = Manager::where('emailtoken',$token);
                if($check->exists()){
                    if($check->first()['email_st'] == 1){
                        \Session::put('alertemail','Your email already verified! You can login now');
                        return redirect('/');
                    }
                    $data = Manager::where('emailtoken',$token);
                    $data->update([
                        "email_st"=>1,
                        "emailtoken"=>null
                    ]);
                    \Session::put('alertemail','Your email has been verified! You can login now');
                    return redirect('/');
                }else{
                    return response()->view('error.404',[],404);
                }
                break;
            case "user":
                $check = User::where('email_token',$token);
                if($check->exists()){
                    if($check->first()['email_st'] == 1){
                       return $this->response(1,'Your email already verified! You can login now',null,new \stdClass());
                    }
                    $data = Manager::where('emailtoken',$token);
                    $data->update([
                        "email_st"=>1,
                        "emailtoken"=>null
                    ]);
                    return $this->response(1,'Your email has been verified! You can login now',null,new \stdClass());;
                }else{
                    return response()->view('error.404',[],404);
                }
        }

    }
    function logout(Request $r){
        $lvl = \Session::get('level');
        \Session::flush();
        return $lvl == 1 ? redirect('/'): redirect('/admin');
    }
}
