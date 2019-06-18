<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class apiandroid extends Controller
{
    function response($status, $message, $apikey, $data, $header = null)
    {
        return response()->json([
            "status" => $status,
            "message" => $message,
            "apiKey"=>$apikey,
            "data" => $data
        ], $header ? (int)$header : 200);
    }
}
