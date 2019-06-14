<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class chart extends Controller
{
    function piechart(){
        return response()->json([
            [
                "Status"=>"Gagal",
                "Total"=>99
            ],
            [
                "Status"=>"Berhasil",
                "Total"=>20
            ]
        ]);
    }
}
