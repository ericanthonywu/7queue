<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;

class table extends Controller
{
    function admin(){
        $data = Admin::where('level',2)->get();
        $no = 1;
        foreach ($data as $key => $value){
            $data[$key]['no'] = $no;
            $data[$key]['access'] = \Session::get('level') == 3;
            $no++;
        }
        return response()->json([
           "data"=>$data
        ]);
    }
    function manager(){
        return response()->json([
            "data"=>Admin::where('level',1)->get()
        ]);
    }
    function merchants(){
        $data = Merchant::where('created_by',\Session::get('userID'))->get();
        foreach ($data as $k => $val){
            $data[$k]['readedit'] = \Session::get('level') == 1;
        }
        return response()->json([
            "data"=>$data
        ]);
    }
    function customers(){
        $data = User::where('created_by',\Session::get('userID'))->get();
        foreach ($data as $k => $val){
            $data[$k]['blocksuspend'] = \Session::get('level') == 1;
        }
        return response()->json([
            "data"=>$data
        ]);
    }
}
