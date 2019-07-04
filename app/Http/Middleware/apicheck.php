<?php

namespace App\Http\Middleware;

use App\Models\Token;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use stdClass;

class apicheck
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($r, Closure $next)
    {
        $data_old = Token::where('token_old', $r->apiKey);
        $data_new = Token::where('token_new', $r->apiKey);

        if ($data_old->exists()) {
            $user = $data_old->first()['user'];
            $data = User::find($user);
            switch ($data['status']){
                case 0:
                    return $next($r);
                case 1:
                    return response()->json([
                        "status"=>-1,
                        "message"=>"Akun anda telah di Block",
                        "data"=> new stdClass()
                    ]);
                case 2:
                    return response()->json([
                        "status"=>-1,
                        "message"=>"Akun anda telah di Suspend",
                        "data"=> new stdClass()
                    ]);
                default:
                    return response()->json([
                        "status"=>-1,
                        "message"=>"Terjadi Kesalahan",
                        "data"=> new stdClass()
                    ]);
            }
        } else if ($data_new->exists()) {
            $token = $data_new->first();
            $data = User::find($token['user']);
            switch ($data['status']){
                case 0:
                    $token->token_old = $r->apiKey;
                    $token->save();
                    return $next($r);
                case 1:
                    return response()->json([
                        "status"=>-1,
                        "message"=>"Akun anda telah di Block",
                        "data"=> new stdClass()
                    ]);
                case 2:
                    return response()->json([
                        "status"=>-1,
                        "message"=>"Akun anda telah di Suspend",
                        "data"=> new stdClass()
                    ]);
                default:
                    return response()->json([
                        "status"=>-1,
                        "message"=>"Terjadi Kesalahan",
                        "data"=> new stdClass()
                    ]);
            }
        } else {
            return response()->json([
                "status" => -1,
                "message" => "Token expire",
                "data" => new stdClass()
            ], 200);
        }
    }
}
