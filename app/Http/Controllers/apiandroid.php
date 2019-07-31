<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Feedback;
use App\Models\Merchant;
use App\Models\MerchantProduct;
use App\Models\Message;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Token;
use App\Models\TrendingCategory;
use App\Models\TrendingMerchant;
use App\Models\User;
use File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Session;
use stdClass;
use Storage;

class apiandroid extends Controller
{
    public $ext = ["jpg", "jpeg", "png", 'pneg'];

    function home(Request $r)
    {
        $trending = TrendingCategory::all();
        foreach ($trending as $k => $v) {
            $data = TrendingMerchant::whereTrending($v['id'])->select('merchant')
                ->distinct()->inRandomOrder()->limit(10)->get();
            $arr = [];
            foreach ($data as $key => $val) {
                $merchant = Merchant::find($val['merchant']);
                if ($merchant) {
                    foreach ($merchant as $asdsadsda) {
                        $merchant['urlfoto'] = url("uploads/merchant/$merchant[foto]");
                    }
                    unset($merchant['foto']);
                }
                array_push($arr, $merchant);
            }
            $trending[$k]['merchant_name'] = $arr;
        }
        $banner = Banner::orderBy('order')->get();
        foreach ($banner as $kb => $vb) {
            $arr = ['phone', 'url', 'lat', 'long', 'confirmation'];
            foreach ($arr as $item) {
                $banner[$kb][$item] = is_null($banner[$kb][$item]) ? "" : $vb[$item];
            }
            $banner[$kb]['gambar'] = url("uploads/banner/$vb[file]");
            unset($banner[$kb]['file']);
        }
        return $this->response($r, 1, 'Data Home', [
            "banner" => $banner,
            "trending" => $trending
        ]);
    }

    /**
     * @param Request $r
     * @param int $status
     * @param string $message
     * @param array $data
     * @param int $header
     * @return JsonResponse
     */
    function response($r, $status = 1, $message = '', $data = [], $header = null)
    {
        $newtoken = bcrypt(Str::random(100) . time());
        $token = Token::whereTokenNew($r->apiKey)->orWhere('token_old', $r->apiKey)->first();
        $token->token_new = $newtoken;
        $token->save();
        return response()->json([
            "status" => $status,
            "message" => $message,
            "apiKey" => $newtoken,
            "debug" => $r->all(),
            "data" => $data == [] ? new stdClass() : $data
        ], !is_null($header) ? (int)$header : 200);
    }

    function nearestmerchant(Request $r)
    {
        if (empty($r->lat) || empty($r->long)) {
            return $this->response($r, 0, "GPS belum di nyalakan", new stdClass());
        }
        $data = Merchant::selectRaw("(
                6371 *   (
                            cos ( radians($r->lat) )
                            * cos( radians( lat ) )
                            * cos( radians( `long` ) - radians($r->long) )
                        + sin ( radians($r->lat) )
                                * sin( radians( lat ) )
                )
            ) AS distance,nickname,id,foto")->limit(10)->get();
        foreach ($data as $k => $v) {
            $data[$k]['jarak'] = round($v['distance'], 2);
            $data[$k]['id_merchant'] = $v['id'];
            $trending = DB::table('trending_merchant')->select(
                'trending_merchant.id as id',
                'trending_merchant.trending as trending',
                'trending_merchant.merchant as merchant',
                'trending_category.kategori as kategori'
            )->where('merchant', '=', $v['id'])
                ->join('trending_category',
                    'trending_merchant.trending',
                    '=',
                    'trending_category.id'
                )
                ->get();
            $kategori = '';
            foreach ($trending as $a => $b) {
                $kategori .= $b->kategori . ", ";
            }
            $data[$k]['kategori'] = rtrim($kategori, ', ');
            $data[$k]['urlfoto'] = asset("uploads/merchant/$v[foto]");
            unset($data[$k]['foto']);
            unset($data[$k]['distance']);
            unset($data[$k]['id']);
        }
        return $this->response($r, 1, "List Merchant Terdekat", ["merchant" => $data]);
    }

    function settings(Request $r)
    {
        return $this->response($r, 1, "Data Settings 7Queue", Setting::first());
    }

    function profile(Request $r)
    {
        $userID = Token::whereTokenNew($r->apiKey)->orWhere('token_old', $r->apiKey)->first()['user'];
        $user = User::find($userID);
        if (count(array_filter($r->all())) > 1) {
            $req = array_filter($r->all());
            unset($r->id);
            if ($r->hasFile('foto_profil')) {
                $filename = $this->insertimage('user', $r->file('foto_profil'));
                if ($filename) {
                    $req['foto_profil'] = $filename;
                } else {
                    return $this->response($r, 0, "Mohon upload gambar saja", new stdClass());
                }
            }
            $user->update($req);
            $data = User::find($userID);
            $data['urlfoto_profil'] = empty($user['foto_profil'])
                ? asset('assets_user/images/logo-7queue.png')
                : url("uploads/user/$user[foto_profil]");
            return $this->response($r, 1, "Data User $user[nickname]", $data);
        } else {
            $user['urlfoto_profil'] = url("uploads/user/$user[foto_profil]");
            return $this->response($r, 1, "Data User $user[nickname]", $user);
        }
    }

    public function insertimage($disk, $file)
    {
        if (in_array(strtolower($file->getClientOriginalExtension()), $this->ext)) {
            $filename = str_replace(' ', '_', Session::get('name')) . Str::random(100) . time() . "." . $file->getClientOriginalExtension();
            Storage::disk($disk)->put($filename, File::get($file));
            return $filename;
        } else {
            return false;
        }
    }

    function feedback(Request $r)
    {
        if (!$r->comments) {
            return $this->response($r, 0, 'ada data kosong');
        }
        $req = array_filter($r->all());
        $user = Token::whereTokenNew($r->apiKey)->orWhere('token_old', $r->apiKey)->first()['user'];
        $req['email'] = User::find($user)['email'];
        Feedback::create($req);
        return $this->response($r, 1, $r->lang == "en" ? "Feedback Received! Thank you for your response" : "Feedback telah di terima! Terima Kasih atas responsenya");
    }

    function inbox(Request $r)
    {
        $user = Token::whereTokenNew($r->apiKey)->orWhere('token_old', $r->apiKey)->first()['user'];
        $data = Message::whereCustomer($user)->where('tipe', (int)$r->tipe)->get();
        foreach ($data as $k => $v) {
            $data[$k]['urlgambar'] = url("uploads/message/$v[gambar]");
            unset($data[$k]['gambar']);
        }
        if ($r->tipe == 1 || $r->tipe == 0) {
            return $this->response($r, 1, 'Data Inbox', [
                "inbox" => $data
            ]);
        } else {
            return $this->response($r, 0, 'Tipe tidak tersedia');
        }
    }

    function merchant_detail(Request $r)
    {
        if(empty($r->m_id) || !isset($r->m_id)){
            return $this->response($r,0,'m_id needed');
        }
        $data = Merchant::find($r->m_id);
        foreach ($data as $k => $v) {
            $data['url_banner'] = !empty($data['banner']) ? url("uploads/merchant_banner/$data[banner]") : asset('assets_user/images/logo-7queue.png');
            $data['url_foto'] = !empty($data['foto']) ?  url("uploads/merchant/$data[foto]") : asset('assets_user/images/logo-7queue.png');
            $m_prod = MerchantProduct::whereMerchant($r->m_id)
                ->select(
                    'products.id as product_id',
                    'products.nama as name',
                    'kategori_produk.kategori as category',
                    'products.harga as price',
                    'products.description as description',
                    'products.foto as foto'
                )
                ->join('products','products.id','=','merchant_products.products')
                ->join('kategori_produk','products.kategori','=','kategori_produk.id')
                ->get();
            foreach ($m_prod as $kprod => $mprod){
                $m_prod[$kprod]['price'] = "Rp. ".number_format($mprod['price']);
                $m_prod[$kprod]['urlfoto'] = url("/uploads/products/$mprod[foto]");
                unset($m_prod[$kprod]['foto']);
            }
            $data['produk'] = $m_prod;
            unset($data['banner']);
            unset($data['foto']);
        }
        return $this->response($r, 1, '', $data);
    }
    function order(Request $r){
        if(empty($r->products) || !isset($r->products)){
            return $this->response($r,0,'products needed');
        }
        if(empty($r->merchant_id) || !isset($r->merchant_id)){
            return $this->response($r,0,'merchant needed');
        }
        $user = Token::whereTokenNew($r->apiKey)->orWhere('token_old', $r->apiKey)->first()['user'];
        $sub = explode(',',$r->products);
        if(!Merchant::find($r->merchant_id)){
            return $this->response($r,0,"Merchant dengan id $r->merchantid tidak tersedia");
        }
        foreach ($sub as $value){
            $expprod = explode('=',$value);
            if((isset($expprod[0]) && isset($expprod[1]) && (!empty($expprod[0]) && !empty($expprod[1])))){
                $prod_id = $expprod[0];
                $num_order = $expprod[1];
                if(Product::find($prod_id)){
                    Order::create([
                        "user"=>$user,
                        "merchant" => $r->merchant_id,
                        "num_order"=>$num_order,
                        "products"=>$prod_id
                    ]);
                }else{
                    return $this->response($r,0,"Produk id $prod_id tidak tersedia");;
                }
            }else{
                return $this->response($r,0,'format salah');
            }
        }
        return $this->response($r);
    }
}
