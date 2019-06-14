<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\KategoriProduk;
use App\Models\Merchant;
use App\Models\Product;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use MongoDB\Driver\Manager;
use Carbon\Carbon;

class crud extends Controller
{
    public $ext = ['jpg','jpeg','png','pneg'];

    public function insertimage($disk, $file)
    {
        if(in_array(strtolower($file->getClientOriginalExtension()),$this->ext)) {
            $filename = str_replace(' ', '_', \Session::get('name')) . Str::random(100) . time() . "." . $file->getClientOriginalExtension();
            \Storage::disk($disk)->put($filename, File::get($file));
            return $filename;
        }else{
            return false;
        }
    }

    function delete(Request $r){
        if($r->table == "admin" && \Session::get('level') !== 3){
            return "Anda tidak memiliki Hak Akses";
        }else if (($r->table == "merchants" || $r->table == "products") && \Session::get('level') !== 1){
            return "Anda tidak memiliki Hak Akses";
        }else {
            DB::table($r->table)->where('id',$r->id)->delete();
        }
    }

    function tambahadmin(Request $r){
        if (!filter_var($r->email, FILTER_VALIDATE_EMAIL)) {
            return "Email Invalid";
        }
        $req = $r->all();
        if(Admin::where('email',$r->email)->exists()){
            return "Email sudah tersedia";
        }else if(Admin::where('username',$r->username)->exists()){
            return "Username Sudah Tersedia";
        }
        $req['password'] = bcrypt($r->password);
        Admin::create($req);
    }
    function editadmin(Request $r){
        if (!filter_var($r->email, FILTER_VALIDATE_EMAIL)) {
            return "Email Invalid";
        }
        $data = Admin::find($r->id);
        $checkemail = Admin::where('email', $r->email);
        $checkname = Admin::where('username', $r->username);
        if ($checkname->exists() && $r->name !== $data->name && $checkemail->exists() && $r->email !== $data->email) {
            return "Username dan Email sudah tersedia";
        } else if ($checkname->exists() && $r->name !== $data->name) {
            return "Username Sudah Tersedia";
        } else if ($checkemail->exists() && $r->email !== $data->email) {
            return "Email Sudah Tersedia";
        }
        $req = $r->all();
        if(empty($r->password)){
            unset($req['password']);
        }else{
            $req['password'] = bcrypt($r->password);
        }
        Admin::find($r->id)->update($req);
    }
    function chgstadmin(Request $r){
        Admin::find($r->id)->update([
            "status"=>$r->status
        ]);
    }
    function toggleuser(Request $r){
        Admin::find($r->id)->update([
            "status"=>$r->status,
            "suspend_time"=>Carbon::parse($r->suspend_time)->format('Y-m-d h:i:s')
        ]);
    }
    function tambahmerchants(Request $r){
        if (!filter_var($r->email, FILTER_VALIDATE_EMAIL)) {
            return "Email Invalid";
        }
        $req = $r->all();
        if(Merchant::where('email',$r->email)->exists()){
            return "Email sudah tersedia";
        }else if(Merchant::where('username',$r->username)->exists()){
            return "Username Sudah Tersedia";
        }
        $req['password'] = bcrypt($r->password);
        $req['created_by'] = \Session::get('id');
        Merchant::create($req);
    }
    function editmerchants(Request $r){
        if (!filter_var($r->email, FILTER_VALIDATE_EMAIL)) {
            return "Email Invalid";
        }
        $data = Merchant::find($r->id);
        $checkemail = Merchant::where('email', $r->email);
        $checkname = Merchant::where('username', $r->username);
        if ($checkname->exists() && $r->name !== $data->name && $checkemail->exists() && $r->email !== $data->email) {
            return "Username dan Email sudah tersedia";
        } else if ($checkname->exists() && $r->name !== $data->name) {
            return "Username Sudah Tersedia";
        } else if ($checkemail->exists() && $r->email !== $data->email) {
            return "Email Sudah Tersedia";
        }
        $req = $r->all();
        if(empty($r->password)){
            unset($req['password']);
        }else{
            $req['password'] = bcrypt($r->password);
        }
        Merchant::find($r->id)->update($req);
    }
    function tambahproducts(Request $r){
        $req = $r->all();
        $filename = $this->insertimage('products',$r->file('foto'));
        if($filename){
            $req['foto'] = $filename;
            Product::create($req);
        }else{
            return "Hanya menerima ekstensi ".implode($this->ext,',')." extensi anda ".$r->file('foto')->getClientOriginalExtension();
        }
    }
    function editproducts(Request $r){
        $req = $r->all();
        if($r->hasFile('foto')) {
            $filename = $this->insertimage('products',$r->file('foto'));
            if ($filename) {
                \Storage::disk('products')->delete(Product::find($r->id)['foto']);
                $req['foto'] = $filename;
            } else {
                return "Hanya menerima ekstensi " . implode($this->ext, ',') . " extensi anda " . $r->file('foto')->getClientOriginalExtension();
            }
        }
        Product::find($r->id)->update($req);
    }
    function tambahkategoriproduk(Request $r){
        KategoriProduk::create($r->all());
    }
    function editkategoriproduk(Request $r){
        KategoriProduk::find($r->id)->update([
            "kategori"=>$r->kategori
        ]);
    }
}
