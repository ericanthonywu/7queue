<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Banner;
use App\Models\KategoriProduk;
use App\Models\Merchant;
use App\Models\Message;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Trending;
use App\Models\TrendingCategory;
use App\Models\TrendingMerchant;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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

    public function push_notification($body, $title, $data, $token)
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

        $notification = [
            'title' => $title,
            'body' => $body,
            'sound' => true,
        ];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to' => $token, //single token
            'notification' => $notification,
            'data' => $data
        ];

        $headers = [
            'Authorization: key= AAAAdOyQ1IE:APA91bH_5FjqhP_o4m81ACIadEMKvx5ZArBcIidmHrjK3TGBk5Fa5V1QhPD7j3PcEz_ZbOmZGjkt-0b3k2MHanVBgoAXVvy1sauD4PEv8ISzHnVyJiygdC3jjkTcIL7PIlCB8UmVED0f',
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);
    }

    function delete(Request $r){
        if($r->table == "admin" && \Session::get('level') !== 3){
            return "Anda tidak memiliki Hak Akses";
        }else if (($r->table == "merchants" || $r->table == "products") && \Session::get('level') !== 1){
            return "Anda tidak memiliki Hak Akses";
        }
        switch ($r->table){
            case "banner":
                $file = Banner::select('file')->find($r->id)['file'];
                \Storage::disk('banner')->delete($file);
                break;
            case "products":
                $file = Product::select('foto')->find($r->id)['foto'];
                \Storage::disk('products')->delete($file);
                break;
        }
        DB::table($r->table)->where('id',$r->id)->delete();
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
        DB::table($r->table)->where('id',$r->id)->update([
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
        }
        if($r->hasFile('foto')){
            $filename = $this->insertimage('merchant',$r->foto);
            if($filename){
                $req['foto'] = $filename;
            }else{
                return "Hanya Menerima ekstensi ".implode($this->ext,',')." extensi anda ".$r->file('foto')->getClientOriginalExtension();
            }
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
        if ($checkemail->exists() && $r->email !== $data->email) {
            return "Email Sudah Tersedia";
        }
        $req = $r->all();
        if(empty($r->password)){
            unset($req['password']);
        }else{
            $req['password'] = bcrypt($r->password);
        }
        if($r->hasFile('foto')){
            $filename = $this->insertimage('merchant',$r->foto);
            if($filename){
                $req['foto'] = $filename;
            }else{
                return "Hanya Menerima ekstensi ".implode($this->ext,',')." extensi anda ".$r->file('foto')->getClientOriginalExtension();
            }
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
                return "Hanya menerima ekstensi <strong><b>" . implode($this->ext, ',') . "</b></strong> extensi anda <strong><b>" . $r->file('foto')->getClientOriginalExtension()."</b></strong>";
            }
        }
        Product::find($r->id)->update($req);
    }
    function tambahkategoriproduk(Request $r){
        if(empty($r->kategori)) {
            return "Kategori Kosong";
        }else{
            KategoriProduk::create($r->all());
        }
    }
    function editkategoriproduk(Request $r){
        KategoriProduk::find($r->id)->update([
            "kategori"=>$r->kategori
        ]);
    }
    function tambahbanner(Request $r){
        $req = $r->all();
        if($r->hasFile('file')) {
            $order = Banner::orderByDesc('order')->limit(1)->first()['order'];
            $req['order'] = $order || 1;
            $filename = $this->insertimage('banner',$r->file('file'));
            if($filename){
                $req['file'] = $filename;
                Banner::create($req);
            }else{
                return "Hanya menerima ektensi gambar ".implode($this->ext,",")." extensi anda ".$r->file('file')->getClientOriginalExtension();
            }
        }else {
            return "Harap upload gambar banner";
        }
    }
    function editbanner(Request $r){
        $req = $r->all();
        if($r->hasFile('file')) {
            $filename = $this->insertimage('banner',$r->file('file'));
            if($filename){
                $req['file'] = $filename;
            }else{
                return "Hanya menerima ektensi gambar ".implode($this->ext,",")." extensi anda ".$r->file('file')->getClientOriginalExtension();
            }
        }
        Banner::create($req);
    }
    function tambahtrending(Request $r){
        TrendingCategory::create($r->all());
    }
    function addmerchantrending(Request $r,$action){
        switch ($action){
            case "list_merchant":
                $cek = TrendingMerchant::where([
                    "merchant"=>$r->merchant,
                    "trending"=>$r->trending
                ])->exists();
                if(!$cek) {
                    TrendingMerchant::create([
                        "merchant" => $r->merchant,
                        "trending" => $r->trending
                    ]);
                }else{
                    return "merchant $r->merchant sudah ada di trending $r->trending";
                }
                break;
            case "list_notmerchant":
                TrendingMerchant::where([
                    "merchant"=>$r->merchant,
                    "trending"=>$r->trending
                ])->delete();
                break;
            default:
                return response()->view('error.404',[],404);
        }
    }
    function settings(Request $r){
        $check = Setting::find(1);
        if($check){
            $check->update($r->all());
        }else{
            Setting::create($r->all());
        }
    }

    function tambahmessage(Request $r)
    {
        if (isset($r->push_notif)) {
            $this->push_notification($r->pesan, $r->judul, [
                "tipe" => $r->tipe ? "promo" : "inbox",
            ], '');
        }
        Message::create($r->all());
    }
}
