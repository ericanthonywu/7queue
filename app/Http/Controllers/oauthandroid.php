<?php

namespace App\Http\Controllers;

use App\Models\Token;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use stdClass;
use Validator;

class oauthandroid extends Controller
{
//    public function log($desc,$apikey)
//    {
//        $user = '';
//        if($apikey !== null) {
//            $datatoken = Token::where("token_old", $apikey)->orWhere('token_new', $apikey)->first();
//            $marketing = User::find($datatoken['user'])['name'];
//
//            switch (Session::get('level')) {
//                case 3:
//                    $user = "<b>$marketing</b> (Marketing)";
//                    break;
//                case 2:
//                    $user = "<b>$marketing</b> (Marketing)";
//                    break;
//                case 1:
//                    $user = "<b>$marketing</b> (Marketing)";
//                    break;
//            }
//        }
//
//        $log = new Logging();
//        $log->activity = $user . $desc;
//        $log->save();
//        return true;
//    }
    function response($status, $message, $apikey, $data, $header = null)
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

    function generatetoken($user)
    {
        $data = User::find($user);
        $token = bcrypt(md5(Str::random(rand(100, 200)) . time()));
        $token2 = bcrypt(md5(Str::random(rand(100, 200)) . time()));
        if ($data) {
            $checktoken = Token::where('user', $data->id)->first();
            if ($checktoken) {
                $checktoken->token_new = $token2;
                $checktoken->token_old = $token;
                $checktoken->devicetoken = '';
                $checktoken->expire = Carbon::now()->addDay(1)->format('Y-m-d H:i:s');
                $checktoken->save();
            } else {
                $datatoken = new Token();
                $datatoken->token_new = $token2;
                $datatoken->token_old = $token;
                $datatoken->user = $user;
                $datatoken->devicetoken = '';
                $datatoken->expire = Carbon::now()->addDay(1)->format('Y-m-d H:i:s');
                $datatoken->save();
            }
            return $token;
        } else {
            return false;
        }
    }

    function register(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            $this->response(0, $validator->fails(), null, new stdClass());
        }
        $data = User::where('username', $r->username)->exists();
        if ($data) {
            return $this->response(0, "Username $r->username sudah tersedia", null, new stdClass());
        }
        $input = $r->all();
        $input['password'] = bcrypt($input['password']);
        $input['nickname'] = $r->username;
        $input['status'] = 0;
        $token = md5(Str::random('100').time());
        Mail::send(['html' => 'emails.konfemail'], [
            "name"=>$r->username,
            "token"=>$token
        ],function($message) use ($r) {
            $message->from('no-reply@7queue.net');
            $message->to($r->email)->subject('Verifikasi Email');
        });
        $input['email_token'] = $token;
        User::create($input);
        return $this->response(1, "User $r->username berhasil register ",null, new stdClass());
    }

    function login(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            $this->response(0, $validator->errors(),null, new stdClass());
        }
        $data = User::where('username', $r->username)->first();
        if ($data && Hash::check($r->password, $data['password'])) {
            if($data['email_st'] == 0){
                return $this->response(0,'Email belum di verifikasi!',null,new stdClass());
            }
            $token = $this->generatetoken($data['id']);
            if ($token) {
//                $this->log("<b>$r->name</b> (marketing) logged in",null);
                return $this->response(1, 'Berhasil Login',$token,new stdClass());
            } else {
                return $this->response(0, 'User tidak ditemukan',null, new stdClass());
            }
        } else {
            return $this->response(0, 'Unauthorized',null, new stdClass());
        }
    }

    function logout(Request $r)
    {
        $datany = Token::where('token_old', $r->apiKey)->orWhere('token_new', $r->apiKey);
        $marketing = User::find($datany->first()['user'])['name'];
//        $this->log("<b>$marketing</b> (marketing) has logged out",null);
        if ($datany->exists()) {
            $data = $datany->first();
            $data->first();
            $data->expire = Carbon::now()->toDateTimeString();
            $data->save();
        }
        return $this->response(1, 'Berhasil Logout',null, new stdClass());
    }

    function token(Request $r)
    {
        $data_old = Token::where('token_old', $r->apiKey);
        if ($data_old->exists()) {
            $data = $data_old->first();
            $apiKey = $data['token_new'];
            if ($data['token_old'] == $data['token_new']) {
                $tokennya = bcrypt(md5(Str::random(rand(100, 200)) . time()));
                $data->token_new = $tokennya;
                $data->devicetoken = $r->deviceToken;
                $data->save();
                $apiKey = $tokennya;
            }
            $data->devicetoken = $r->deviceToken;
            $data->save();
            return $this->response(1, '', $apiKey,new stdClass());
        } else {
            return $this->response(-1, 'Token Expire',null, new stdClass());
        }
    }
}
