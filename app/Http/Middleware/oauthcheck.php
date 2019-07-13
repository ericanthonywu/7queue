<?php

namespace App\Http\Middleware;

use App\Models\Token;
use Closure;
use Illuminate\Http\Request;
use stdClass;

class oauthcheck
{
    /**
     * Handle an incoming request.
     *
     * @param Request $r
     * @param Closure $next
     * @return mixed
     */
    public function handle($r, Closure $next)
    {
        $data_old = Token::where('token_old', $r->apiKey);
        $data_new = Token::where('token_new', $r->apiKey);

        if ($data_old->exists()) {
            return $next($r);
        } else if ($data_new->exists()) {
            $token = $data_new->first();
            $token->token_old = $r->apiKey;
            $token->save();
            return $next($r);
        } else {
            return response()->json([
                "status" => -1,
                "message" => "Token expire",
                "data" => new stdClass()
            ], 200);
        }
    }
}
