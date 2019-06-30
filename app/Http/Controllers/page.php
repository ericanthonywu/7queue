<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Banner;
use App\Models\KategoriProduk;
use App\Models\Merchant;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class page extends Controller
{
    function apk($ver) {
        $path = "app/7queue$ver.apk";
        if(file_exists(storage_path($path))) {
            return response()->file(storage_path($path), [
                'Content-Type' => 'application/vnd.android.package-archive',
                'Content-Disposition' => 'attachment; filename="7queue.apk"',
            ]);
        }else{
            return response()->view('error.404',[],404);
        }
    }
    function manager(){
        return \Session::get('name') && \Session::get('level') ? redirect('/dashboard') : view('manager');
    }
    function editadmin($id){
        $data = Admin::find($id);
        return $data ? view('page.admin.edit',[
            "admin"=>$data
        ]) : response()->view('error.404',[],404);
    }
    function editmerchants($id){
        $data = Merchant::find($id);
        return $data ? view('page.merchants.edit',[
            "merchants"=>$data
        ]) : response()->view('error.404',[],404);
    }
    function kategori(){
        return response()->json(KategoriProduk::all());
    }
    function editbanner($id){
        $data = Banner::find($id);
        return $data ? view('page.banner.edit',[
            "data"=>$data
        ]) : response()->view('error.404',[],404);
    }
    function tambahproducts(){
        return view('page.products.tambah',[
            "kategori"=>KategoriProduk::all()
        ]);
    }
    function editproducts($id){
        $data = Product::find($id);
        return $data ? view('page.products.edit',[
            "kategori"=>KategoriProduk::all(),
            "data"=>$data
        ]) : response()->view('error.404',[],404);
    }
    function settings(){
        $data = Setting::first();
        return view('page.settings.index',[
            "data"=> $data ? $data : []
        ]);
    }
}
