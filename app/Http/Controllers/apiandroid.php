<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class apiandroid extends Controller
{
    function response($r, $status, $message, $data, $header = null)
    {
        $newtoken = bcrypt(Str::random(100).time());
            $token = Token::whereTokenNew($r->apiKey)->orWhere('token_old',$r->apiKey)->first();
            $token->token_new = $newtoken;
            $token->save();
            return response()->json([
                "status" => $status,
                "message" => $message,
                "apiKey" => $newtoken,
                "debug" => $r->all(),
                "data" => $data
            ], $header ? (int)$header : 200);
    }
    function home(Request $r){

    }
    function nearestmerchant(Request $r){
        if(empty($r->lat) || empty($r->long)){
            return $this->response($r,0,"GPS belum di nyalakan",new \stdClass());
        }
        $data = Merchant::selectRaw("(
                6371 * acos (
                            cos ( radians($r->lat) )
                            * cos( radians( lat ) )
                            * cos( radians( `long` ) - radians($r->long) )
                        + sin ( radians($r->lat) )
                                * sin( radians( lat ) )
                )
            ) AS distance,nickname")->orderBy('distance')->limit(10)->get();
        foreach ($data as $k=>$v){
            $data[$k]['jarak'] = round($v['distance']);
            unset($data[$k]['distance']);
        }
        return $this->response($r,1,"List Merchant Terdekat",$data);
    }
}
