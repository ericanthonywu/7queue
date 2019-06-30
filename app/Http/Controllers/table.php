<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Banner;
use App\Models\Feedback;
use App\Models\KategoriProduk;
use App\Models\Manager;
use App\Models\Merchant;
use App\Models\Product;
use App\Models\Trending;
use App\Models\TrendingCategory;
use App\Models\TrendingMerchant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class table extends Controller
{
    function admin()
    {
        $data = Admin::whereLevel(2)->get();
        $no = 1;
        foreach ($data as $key => $value) {
            $data[$key]['no'] = $no;
            $data[$key]['access'] = Session::get('level') == 3;
            $no++;
        }
        return response()->json([
            "data" => $data
        ]);
    }

    function manager(Request $r)
    {
        if($r->input('query.generalSearch') == null) {
            $data = Manager::orderBy($r->sort['field'] !== "no" ? $r->sort['field'] : 'id',$r->sort['sort'])->limit($r->pagination['perpage']);
        }else{
            $data = Manager::orderBy($r->sort['field'] !== "no" ? $r->sort['field'] : 'id',$r->sort['sort'])->limit($r->pagination['perpage']);
        }
//        $data = Manager::all();
        $no = 1;
        foreach ($data as $key => $value) {
            $data[$key]['no'] = $no;
            $data[$key]['tgl_dibuat'] = $value['created_at']->format('D, d M Y H:i');
            $data[$key]['access'] = Session::get('level') == 3;
            $no++;
        }
        return response()->json([
            "data" => $data
        ]);
    }

    function merchants()
    {
        $data = Session::get('level') == 1
            ? Merchant::whereCreatedBy(Session::get('id'))->get()
            : Merchant::all();
        $no = 1;
        foreach ($data as $k => $val) {
            $data[$k]['no'] = $no;
            $data[$k]['readedit'] = Session::get('level') == 1;
            $no++;
        }
        return response()->json([
            "data" => $data
        ]);
    }

    function customers()
    {
        $data = User::all();
        $no = 1;
        foreach ($data as $k => $val) {
            $data[$k]['no'] = $no;
            $data[$k]['blocksuspend'] = Session::get('level') == 1;
            $no++;
        }
        return response()->json([
            "data" => $data
        ]);
    }

    function banner()
    {
        $data = Banner::all();
        $no = 1;
        foreach ($data as $key => $value) {
            $data[$key]['no'] = $no;
            $no++;
        }
        return response()->json([
            "data" => $data
        ]);
    }

    function products()
    {
        $data = Product::all();
        $no = 1;
        foreach ($data as $key => $value) {
            $data[$key]['no'] = $no;
            $data[$key]['access'] = Session::get('level') == 1;
            $data[$key]['kategorinya'] = KategoriProduk::find($value['kategori'])['kategori'];
            $no++;
        }
        return response()->json([
            "data" => $data
        ]);
    }

    function kategoriproduk()
    {
        $data = KategoriProduk::all();
        $no = 1;
        foreach ($data as $key => $value) {
            $data[$key]['no'] = $no;
            $no++;
        }
        return response()->json([
            "data" => $data
        ]);
    }

    function feedback()
    {
        $data = Feedback::all();
        $no = 1;
        foreach ($data as $key => $value) {
            $data[$key]['no'] = $no;
            $data[$key]['tgl_dibuat'] = $value['created_at']->format('D, d M Y H:i');
            $no++;
        }
        return response()->json([
            "data" => $data
        ]);
    }

    function trending()
    {
        $data = TrendingCategory::all();
        $no = 1;
        foreach ($data as $key => $value) {
            $data[$key]['no'] = $no;
            $data[$key]['added_at'] = $value['created_at']->format('D, d M Y H:i');
            $no++;
        }
        return response()->json([
            "data" => $data
        ]);
    }

    function get_merchant_list(Request $r)
    {
        $trending_merchant = TrendingMerchant::whereTrending($r->id)->get();
        foreach ($trending_merchant as $k => $v){
            $trending_merchant[$k]['merchant_name'] = Merchant::find($v['merchant'])['nickname'];
            $trending_merchant[$k]['date_added'] = $v['created_at']->format('D, d M Y H:i');
        }

        $data_merchant = Merchant::whereNotIn('id',function ($q) use ($r) {
            $q->select('merchant')
                ->from('trending_merchant')
                ->where('trending',$r->id);
            ;
        })->get();
        foreach ($data_merchant as $k => $v){
            $data_merchant[$k]['jumlah_trending'] = TrendingMerchant::whereMerchant($v['id'])->distinct()->get()->count();
        }
        return response()->json([
            0 => TrendingCategory::find($r->id)['kategori'],
            1 => $trending_merchant,
            2 => $data_merchant
        ]);
    }
}
