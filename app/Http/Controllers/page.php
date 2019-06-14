<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Banner;
use App\Models\KategoriProduk;
use App\Models\Merchant;
use App\Models\Product;
use Illuminate\Http\Request;

class page extends Controller
{
    function manager(){
        return \Session::get('name') && \Session::get('level') ? redirect('/dashboard') : view('manager');
    }
    function editadmin($id){
        $data = Admin::find($id);
        return $data ? view('page.admin.edit',[
            "admin"=>$data
        ]) : redirect()->back();
    }
    function editmerchants($id){
        $data = Merchant::find($id);
        return $data ? view('page.merchants.edit',[
            "merchants"=>$data
        ]) : redirect()->back();
    }
    function kategori(){
        return response()->json(KategoriProduk::all());
    }
    function editbanner($id){
        $data = Banner::find($id);
        return $data ? view('page.banner.edit',[
            "data"=>$data
        ]) : redirect()->back();
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
        ]) : redirect()->back();
    }
}
