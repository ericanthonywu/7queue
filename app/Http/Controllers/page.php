<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Merchant;
use Illuminate\Http\Request;

class page extends Controller
{
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
//    function editproducts($id){
//        $data = Admin::find($id);
//        return $data->exists() ? view('page.admin.edit',[
//            "dataadmin"=>$data
//        ]) : redirect()->back();
//    }
}
