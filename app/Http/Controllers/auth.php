<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Manager;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use stdClass;

class auth extends Controller
{
    public function response($r,$status, $message, $apikey, $data, $header = null)
    {
        return
            !is_null($apikey)
                ?
                response()->json([
                    "status" => $status,
                    "message" => $message,
                    "apiKey" => $apikey,
                    "data" => $data
                ], !is_null($header) ? (int)$header : 200)
                :
                response()->json([
                    "status" => $status,
                    "message" => $message,
                    "data" => $data
                ], !is_null($header) ? (int)$header : 200);
    }
    function login(Request $r){
        $data = $r->status == "admin"
            ? Admin::whereEmail($r->email) :
            Manager::whereEmail($r->email);
        if($data->exists() && $r->status == "manager" && $data->first()['email_st'] == 0){
            return "Your email hasn't verified yet";
        }
        if($data->first()['status'] == 1){
            return $this->response($r,0,'Akun anda telah di block ',null,new stdClass());
        }elseif ($data->first()['status'] == 2 && $data->first()['suspend_time'] < Carbon::now()->format('Y-m-d H:i:s')){
            return $this->response($r,0,'Akun anda telah di suspend dalam jangka waktu tertentu',null,new stdClass());
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
            return "Email / Password anda salah";
        }
    }
    function register(Request $r){
        $req = $r->all();
        if (!filter_var($r->email, FILTER_VALIDATE_EMAIL)) {
            return "Email Invalid";
        }
        $emailcheck = Manager::whereEmail($r->email)->exists();
        if($emailcheck){
            return "Email sudah tersedia. <br> Mungkin anda sudah mendaftarkannya";
        }
        $req['password'] = bcrypt($r->password);
        $token = Str::random(16).time();
        Mail::send(['html' => 'emails.konfemail'], [
            "name"=>ucwords($r->nickname),
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
        if(empty($token) || empty($role)){
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
                        return response()->view('notify.notify',[
                            "message"=>"Your email already verified! You can login now",
                            "status"=>1
                        ]);
                    }
                    $data = User::whereEmailToken($token);
                    $data->update([
                        "email_st"=>1,
                        "email_token"=>null
                    ]);
                    return response()->view('notify.notify',[
                        "message"=>"Your email has been verified! You can login now",
                        "status"=>1
                    ]);
                }else{
                    return response()->view('error.404',[],404);
                }
                break;
            case "forgotuser":
                $check = User::where('email_token',$token);
                if($check->exists()){
                    if($check->first()['email_expired'] > Carbon::now()->format('Y-m-d H:i:s')){
                        return response()->view('notify.notify',[
                            "message"=>"Kami mengirimkan link baru ke email Anda, silahkan di cek lagi",
                            "status"=>1
                        ]);
                    }
                    $useragent=$_SERVER['HTTP_USER_AGENT'];

                    if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
                        \Session::put('device', "android");
                    }else{
                        \Session::put('device', "PC");
                    }
                    return response()->view('verify',[
                        "data"=>$check->first()['id'],
                        "email"=>$check->first()['email'],
                        'role'=>'user'
                    ],200);
                }else{
                    return response()->view('error.404',[],404);
                }
                break;
            case "fmanager" :
                $check = Manager::where('emailtoken',$token);
                if($check->exists()){
                    if($check->first()['email_expired'] > Carbon::now()->format('Y-m-d H:i:s')){
                        $token = Str::random(16).time();
                        Mail::send(['html' => 'emails.konfemail'], [
                            "name"=>$check->first()['email'],
                            "token"=>$token,
                        ],function($message) use ($check) {
                            $message->from('no-reply@7queue.net');
                            $message->to($check->first()['email'])->subject('Verifikasi Email');
                        });
                        Manager::whereEmail($check->first()['email'])->update([
                            "emailtoken"=>$token
                        ]);
                        return response()->view('notify.notify',[
                            "message"=>"Kami mengirimkan link baru ke email Anda, silahkan di cek lagi",
                            "status"=>0
                        ]);
                    }
                    $useragent=$_SERVER['HTTP_USER_AGENT'];

                    if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
                        \Session::put('device', "android");
                    }else{
                        \Session::put('device', "PC");
                    }
                    return response()->view('verify',[
                        "data"=>$check->first()['id'],
                        "email"=>$check->first()['email'],
                        'role'=>'manager'
                    ],200);
                }else{
                    return response()->view('error.404',[],404);
                }
                break;
            default:
                return response()->view('error.404',[],404);
        }

    }
    function fpasswordmanager(Request $r){
        if (!filter_var($r->email, FILTER_VALIDATE_EMAIL)) {
            return "Email Invalid";
        }
        $check = Manager::whereEmail($r->email);
        if($check->exists()){
            $data = $check->first();
            $token = Str::random(16).time();
            Mail::send(['html' => 'emails.konfemail'], [
                "name"=>$data['email'],
                "token"=>$token,
                "data"=>"fmanager"
            ],function($message) use ($r) {
                $message->from('no-reply@7queue.net');
                $message->to($r->email)->subject('Verifikasi Email');
            });
            Manager::whereEmail($r->email)->update([
                "emailtoken"=>$token
            ]);
        }else{
            return "Email tidak ditemukan, Mungkin anda belum mendaftar";
        }
    }
    function cpassword(Request $r){
        User::find($r->user)->update([
            "password"=>bcrypt($r->password),
            "email_token"=>null
        ]);
        if(\Session::get('device') === "android"){
            return "android";
        }
        \Session::remove('device');
    }
    function cmanager(Request $r){
        Manager::find($r->user)->update([
            "password"=>bcrypt($r->password),
            "emailtoken"=>null
        ]);
        if(\Session::get('device') === "android"){
            return "android";
        }
        \Session::remove('device');
    }
    function logout(){
        $lvl = \Session::get('level');
        \Session::flush();
        return $lvl == 1 ? redirect('/'): redirect('/admin');
    }
}
