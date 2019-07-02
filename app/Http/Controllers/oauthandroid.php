<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Product;
use App\Models\Token;
use App\Models\User;
use Carbon\Carbon;
use File;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;
use stdClass;
use Validator;

class oauthandroid extends Controller
{
//    public function log($desc,$apikey)
//    {
//        $user = '';
//        if($apikey !== [,null) {
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
    public $ext = ['jpg','jpeg','png','pneg'];

    public function insertimage($disk, $file)
    {
        if(in_array(strtolower($file->getClientOriginalExtension()),$this->ext)) {
            $filename = str_replace(' ', '_', \Session::get('name')) . Str::random(100) . time() . "." . $file->getClientOriginalExtension();
            \Storage::disk($disk)->put($filename, File::get($file));
            return $filename;
        }else{
            return false;
        }
    }
    public function response($r,$status, $message, $data,$apikey, $header = null)
    {
        return
            response()->json([
                "status" => $status,
                "message" => $message,
                "apiKey" => $apikey,
                "debug"=>$r->all(),
                "data" => $data == [] ? new stdClass() : $data
            ], $header !== null ? $header : 200);
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
            'gender'=> 'required',
        ]);
        if ($validator->fails()) {
            $this->response($r,0, $validator->fails(), [],null);
        }
        if(User::whereEmail($r->email)->exists()){
            return $this->response($r,0, "Email $r->email sudah tersedia", [],null, [],null);
        }
        $input = $r->all();
        if($r->hasFile('foto')) {
            $filename = $this->insertimage('user', $r->file('foto'));
            if ($filename) {
                $input['foto_profil'] = $filename;
            } else {
                return "Hanya menerima ekstensi " . implode($this->ext, ',') . " extensi anda " . $r->file('foto')->getClientOriginalExtension();
            }
        }
        $input['password'] = bcrypt($input['password']);
        $input['status'] = 0;
        $token = md5(Str::random('100').time());
        Mail::send(['html' => 'emails.konfemail'], [
            "name"=>$r->username,
            "token"=>$token,
            "data"=>"user"
        ],function($message) use ($r) {
            $message->from('no-reply@7queue.net');
            $message->to($r->email)->subject('Verifikasi Email');
        });
        $input['email_token'] = $token;
        User::create($input);
        return $this->response($r,1, "User $r->nickname berhasil register \n cek email anda untuk konfirmasi ", [],null);
    }

    function login(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'email' => 'email | required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            $this->response($r,0, $validator->errors(), [],null);
        }
        $data = User::whereEmail($r->email)->first();
        if ($data && Hash::check($r->password, $data['password'])) {
            if($data['email_st'] == 0){
                return $this->response($r,0,'Email belum di verifikasi!',[],null);
            }
            if($data['status'] == 1){
                return $this->response($r,0,'Akun anda telah di block ',[],null);
            }elseif ($data['status'] == 2 && $data['suspend_time'] > Carbon::now()->format('Y-m-d H:i:s')){
                return $this->response($r,0,'Akun anda telah di suspend dalam jangka waktu tertentu',[],null);
            }
            $token = $this->generatetoken($data['id']);
            if ($token) {
//                $this->log("<b>$r->name</b> (marketing) logged in",[,null);
                return $this->response($r,1, 'Berhasil Login',[],$token);
            } else {
                return $this->response($r,0, 'User tidak ditemukan', [],null);
            }
        } else {
            return $this->response($r,0, 'Unauthorized', [],null);
        }
    }

    function logout(Request $r)
    {
        $datany = Token::where('token_old', $r->apiKey)->orWhere('token_new', $r->apiKey);
//        $marketing = User::find($datany->first()['user'])['name'];
//        $this->log("<b>$marketing</b> (marketing) has logged out",[,null);
        if ($datany->exists()) {
            $data = $datany->first();
            $data->first();
            $data->expire = Carbon::now()->toDateTimeString();
            $data->save();
        }
        return $this->response($r,1, 'Berhasil Logout', [],null);
    }
    function forgotpassword(Request $r){
        $data = User::where('email',$r->email);
        if($data->exists()){
            $token = Str::random(16).time();
            try{
                Mail::send(['html' => 'emails.konfemail'], [
                    "name"=>$data->first()['nickname'],
                    "token"=>$token,
                    "data"=>"forgotuser"
                ],function($message) use ($r) {
                    $message->from('no-reply@7queue.net');
                    $message->to($r->email)->subject('Verifikasi Email');
                });
                User::whereEmail($r->email)->update([
                    "email_token"=>$token,
                    "email_expired"=>Carbon::now()->addMinutes(10)
                ]);
                return $this->response($r,1,'Kami telah ngirimkan verifikasi ke email anda, mohon di klik agar dapat login kembali',[],null);
            }catch (Exception $e){
                return $this->response($r,0,$e->getMessage(),[],null);
            }
        }else{
            return $this->response($r,0,'Email tidak terdaftar! Mohon register dengan email ini',[],null);
        }
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
            return $this->response($r,1, '', $apiKey,[],null);
        } else {
            return $this->response($r,-1, 'Token Expire', [],null);
        }
    }
}
