<?php

namespace App\Http\Middleware;

use App\Models\Token;
use Closure;

class oauthcheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $r
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($r, Closure $next)
    {
        $data_old = Token::where('token_old',$r->apiKey);
        $data_new = Token::where('token_new',$r->apiKey);

        if ($data_old->exists()) {
            return $next($r);
        } else if($data_new->exists()) {
            $token = $data_new->first();
            $token->token_old = $r->apiKey;
            $token->save();
//            if (Carbon::now()->toDateTimeString() > $token['expire']) {
//                return response()->json([
//                    "status"=>0,
//                    "data"=>[
//                        "message"=>"Token expire"
//                    ]
//                ],200);
//            }else{
            return $next($r);
//            }
        }else{
            return response()->json([
                "status"=>-1,
                "message"=>"Token expire",
                "data"=>new \stdClass()
            ],200);
        }
    }
}
