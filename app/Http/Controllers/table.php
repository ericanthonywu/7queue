<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Banner;
use App\Models\Feedback;
use App\Models\KategoriProduk;
use App\Models\Manager;
use App\Models\Merchant;
use App\Models\Message;
use App\Models\Product;
use App\Models\Trending;
use App\Models\TrendingCategory;
use App\Models\TrendingMerchant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        if ($r->input('query.generalSearch') == null) {
            $data = Manager::orderBy($r->sort['field'] !== "no" ? $r->sort['field'] : 'id', $r->sort['sort'])->limit($r->pagination['perpage']);
        } else {
            $data = Manager::orderBy($r->sort['field'] !== "no" ? $r->sort['field'] : 'id', $r->sort['sort'])->limit($r->pagination['perpage']);
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

    function merchants(Request $r)
    {
        return $this->serversidetable($r, 'merchants', ["nickname"], [
            "readedit" => Session::get('level') == 1
        ]);
//        $limit = empty($r->pagination['perpage']) ? 10 : (int)$r->pagination['perpage'];
////        $limit = (int) $r->pagination['perpage'];
//        $current_paginate = is_null($r->pagination['page']) ? 1 : $r->pagination['page'];
//        $offset = $limit * ($current_paginate - 1);
//        $total = Merchant::all()->count();
//        $totalpage = ceil($total / $limit);
//
//        $data = is_null($r->input('query.generalSearch'))
//            ?
//            Merchant::limit($limit)->offset($offset)
//                ->orderBy($r->sort['field'] == "no" ? "id" : $r->sort['field'], $r->sort['sort'])
//                ->get()
//            :
//            Merchant::limit($limit)->offset($offset)
//                ->orderBy($r->sort['field'] == "no" ? "id" : $r->sort['field'], $r->sort['sort'])
//                ->whereRaw("match (nickname) AGAINST ('".$r->input('query.generalSearch')."*' IN BOOLEAN MODE)")
//                ->get();
//        $no = $offset + 1;
//        foreach ($data as $k => $val) {
//            $data[$k]['no'] = $no;
//            $data[$k]['readedit'] = Session::get('level') == 1;
//            $no++;
//        }
//        return response()->json([
//            "meta" => [
//                "page" => $current_paginate,
//                "pages" => $totalpage,
//                "perpage" => $limit,
//                "total" => $total,
//                "sort" => $r->sort['sort'],
//                "field" => $r->sort['field'] == "no" ? "id" : $r->sort['field']
//            ],
//            "data" => $data,
//        ]);
    }

    function serversidetable($r, $tbl, $search, $customdata = [])
    {
        $limit = empty($r->pagination['perpage']) ? 10 : (int)$r->pagination['perpage'];
//        $limit = (int) $r->pagination['perpage'];
        $current_paginate = is_null($r->pagination['page']) ? 1 : $r->pagination['page'];
        $offset = $limit * ($current_paginate - 1);
        $total = is_string($tbl) ? DB::table($tbl)->get()->count() : $tbl->get()->count();
        $totalpage = ceil($total / $limit);

        $datas = is_string($tbl) ? DB::table($tbl) : $tbl;

        $datas = $datas->limit($limit)->offset($offset)
            ->orderBy($r->sort['field'] == "no" ? "id" : $r->sort['field'], $r->sort['sort']);
        if (!is_null($r->input('query.generalSearch'))) {
            if (is_string($search)) {
                $datas->whereRaw("match ($search) AGAINST ('" . $r->input('query.generalSearch') . "*' IN BOOLEAN MODE)");
            } else {
                foreach ($search as $searchnya) {
                    $datas->whereRaw("match ($searchnya) AGAINST ('" . $r->input('query.generalSearch') . "*' IN BOOLEAN MODE)");
                }
            }
        }
        $data = $datas->get();

        $no = $offset + 1;
        foreach ($data as $k => $val) {
            $data[$k]->no = $no;
            if ($customdata !== []) {
                foreach ($customdata as $key => $value) {
                    $data[$k]->$key = $value;
                }
            }
            $no++;
        }
        return response()->json([
            "meta" => [
                "page" => $current_paginate,
                "pages" => $totalpage,
                "perpage" => $limit,
                "total" => $total,
                "sort" => $r->sort['sort'],
                "field" => $r->sort['field'] == "no" ? "id" : $r->sort['field']
            ],
            "data" => $data,
        ]);
    }

    function customers(Request $r)
    {
        return $this->serversidetable($r, 'users', "nickname", [
            "blocksuspend" => Session::get('level') == 1
        ]);
//        $data = User::all();
//        $no = 1;
//        foreach ($data as $k => $val) {
//            $data[$k]['no'] = $no;
//            $data[$k]['blocksuspend'] = Session::get('level') == 1;
//            $no++;
//        }
//        return response()->json([
//            "data" => $data
//        ]);
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

    function products(Request $r)
    {
        $query = Product::select([
            'kategori_produk.kategori as kategorinya',
            'nama',
            'foto',
            'harga',
            'description',
            'products.created_at as created_at'
        ])->join('kategori_produk',
            'kategori_produk.id',
            '=',
            'products.kategori'
        );
        return $this->serversidetable($r, $query, "nama", [
            "access" => Session::get('level') == 1,
        ]);
//        $data = Product::all();
//        $no = 1;
//        foreach ($data as $key => $value) {
//            $data[$key]['no'] = $no;
//            $data[$key]['access'] = Session::get('level') == 1;
//            $data[$key]['kategorinya'] = KategoriProduk::find($value['kategori'])['kategori'];
//            $no++;
//        }
//        return response()->json([
//            "data" => $data
//        ]);
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

    function feedback(Request $r)
    {
        $q = Feedback::orderByDesc('id')->select(
            'feedback.id as id',
            'feedback.email',
            'merchants.nickname as merchants',
            'rating',
            'feedback.created_at',
            'comments'
        )->join('merchants', 'merchants.id', '=', 'feedback.merchant_id');
        return $this->serversidetable($r, $q, ["feedback", "email"]);
//        $data = Feedback::all();
//        $no = 1;
//        foreach ($data as $key => $value) {
//            $data[$key]['no'] = $no;
//            $data[$key]['tgl_dibuat'] = $value['created_at']->format('D, d M Y H:i');
//            $no++;
//        }
//        return response()->json([
//            "data" => $data
//        ]);
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
        $trending_merchant = TrendingMerchant::whereTrending($r->id)->select('merchant', 'created_at')->get();
        foreach ($trending_merchant as $k => $v) {
            $trending_merchant[$k]['merchant_name'] = Merchant::find($v['merchant'])['nickname'];
            $trending_merchant[$k]['date_added'] = $v['created_at']->format('D, d M Y H:i');
        }

        $data_merchant = Merchant::whereNotIn('id', function ($q) use ($r) {
            $q->select('merchant')
                ->from('trending_merchant')
                ->where('trending', $r->id);
        })->select('id', 'nickname')->get();
        foreach ($data_merchant as $k => $v) {
            $data_merchant[$k]['jumlah_trending'] = TrendingMerchant::whereMerchant($v['id'])->distinct()->get()->count();
        }
        return response()->json([
            0 => TrendingCategory::find($r->id)['kategori'],
            1 => $trending_merchant,
            2 => $data_merchant
        ]);
    }

    function get_filtered_merchant_list(Request $r)
    {
        switch ($r->status) {
            case "list_merchant":
                if ($r->val) {
                    $data = Merchant::whereRaw("match (nickname) AGAINST ('$r->val*' IN BOOLEAN MODE)")->select('id')->get();
                    $trending_merchants = TrendingMerchant::whereTrending($r->id)->select('merchant', 'created_at');
                    $trending_merchants->where(function ($q) use ($data) {
                        $q->where('merchant', 0);
                        foreach ($data as $k => $val) {
                            $q->orWhere('merchant', $val['id']);
                        }
                    });
                    $trending_merchant = $trending_merchants->get();
                } else {
                    $trending_merchant = TrendingMerchant::whereTrending($r->id)->select('merchant', 'created_at')
                        ->get();
                }
                foreach ($trending_merchant as $k => $v) {
                    $trending_merchant[$k]['merchant_name'] = Merchant::find($v['merchant'])['nickname'];
                    $trending_merchant[$k]['date_added'] = $v['created_at']->format('D, d M Y H:i');
                }
                return response()->json($trending_merchant);
                break;
            case "list_notmerchant":
                if (!empty($r->val)) {
                    $data_merchant = Merchant::whereNotIn('id', function ($q) use ($r) {
                        $q->select('merchant')
                            ->from('trending_merchant')
                            ->where('trending', $r->id);
                    })->select('id', 'nickname')->whereRaw("match (nickname) AGAINST ('$r->val*' IN BOOLEAN MODE)")
                        ->get();
                } else {
                    $data_merchant = Merchant::whereNotIn('id', function ($q) use ($r) {
                        $q->select('merchant')
                            ->from('trending_merchant')
                            ->where('trending', $r->id);
                    })->select('id', 'nickname')
                        ->get();
                }
                foreach ($data_merchant as $k => $v) {
                    $data_merchant[$k]['jumlah_trending'] = TrendingMerchant::whereMerchant($v['id'])->distinct()->get()->count();
                }
                return response()->json($data_merchant);
                break;
            default:
                return response()->view('error.404', [], 404);
        }
    }

    function message(Request $r)
    {
        $q = Message::select([
            "message.id as id",
            "judul",
            "pesan",
            "users.nickname as customers",
            "push_notif",
            "tipe",
            "message.created_at"
        ])->join('users', 'users.id', '=', 'message.customer');
        return $this->serversidetable($r, $q, ["judul", "pesan"]);
    }
}
