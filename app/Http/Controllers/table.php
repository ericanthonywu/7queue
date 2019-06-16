<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Banner;
use App\Models\Feedback;
use App\Models\KategoriProduk;
use App\Models\Merchant;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class table extends Controller
{
    function admin(){
        $data = Admin::whereLevel(2)->get();
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
        $data = Admin::whereLevel(1)->get();
        $no = 1;
        foreach ($data as $key => $value){
            $data[$key]['no'] = $no;
            $data[$key]['tgl_dibuat'] = $value['created_at']->format('D, d M Y H:i');
            $data[$key]['access'] = \Session::get('level') == 3;
            $no++;
        }
        return response()->json([
            "data"=>$data
        ]);
    }
    function merchants(){
        $data = \Session::get('level') == 1
            ? Merchant::whereCreatedBy(\Session::get('id'))->get()
            : Merchant::all();
        $no = 1;
        foreach ($data as $k => $val){
            $data[$k]['no'] = $no;
            $data[$k]['readedit'] = \Session::get('level') == 1;
            $no++;
        }
        return response()->json([
            "data"=>$data
        ]);
    }
    function customers(){
        $data = User::whereCreatedBy(\Session::get('id'))->get();
        foreach ($data as $k => $val){
            $data[$k]['blocksuspend'] = \Session::get('level') == 1;
        }
        return response()->json([
            "data"=>$data
        ]);
    }
    function banner(){
        $data = Banner::all();
        $no = 1;
        foreach ($data as $key => $value){
            $data[$key]['no'] = $no;
            $no++;
        }
        return response()->json([
            "data"=>$data
        ]);
    }
    function products(){
        $data = Product::all();
        $no = 1;
        foreach ($data as $key => $value){
            $data[$key]['no'] = $no;
            $data[$key]['access'] = \Session::get('level') == 1;
            $data[$key]['kategorinya'] = KategoriProduk::find($value['kategori'])['kategori'];
            $no++;
        }
        return response()->json([
            "data"=>$data
        ]);
    }
    function kategoriproduk(){
        $data = KategoriProduk::all();
        $no = 1;
        foreach ($data as $key => $value){
            $data[$key]['no'] = $no;
            $no++;
        }
        return response()->json([
            "data"=>$data
        ]);
    }
    function feedback(){
        $data = Feedback::all();
        $no = 1;
        foreach ($data as $key => $value){
            $data[$key]['no'] = $no;
            $data[$key]['tgl_dibuat'] = $v['created_at']->format('D, d M Y H:i');
            $no++;
        }
        return response()->json([
            "data"=>$data
        ]);
    }
}
