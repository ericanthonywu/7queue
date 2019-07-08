<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Feedback;
use App\Models\Merchant;
use App\Models\Setting;
use App\Models\Token;
use App\Models\Trending;
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

    function home(Request $r)
    {
        $trending = TrendingCategory::all();
        foreach ($trending as $k => $v) {
            $data = TrendingMerchant::whereTrending($v['id'])->select('merchant')->distinct()->inRandomOrder()->limit(10)->get();
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
     * @param $r
     * @param $status
     * @param $message
     * @param array $data
     * @param null $header
     * @return JsonResponse
     */
    function response($r, $status, $message, $data = [], $header = null)
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
            ) AS distance,nickname,id,foto")->orderBy('distance')->limit(10)->get();
        foreach ($data as $k => $v) {
            $data[$k]['jarak'] = round($v['distance'], 2);
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
        return $this->response($r, 1, "List Merchant Terdekat", ["merchant"=>$data]);
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
    function feedback(Request $r){
        $req = $r->all();
        $user = Token::whereTokenNew($r->apiKey)->orWhere('token_old',$r->apiKey)->first()['user'];
        $req['email'] = User::find($user)['email'];
        Feedback::create($req);
    }
}
