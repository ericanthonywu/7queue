<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * Class Admin
 *
 * @property int $id
 * @property string $nickname
 * @property string $email
 * @property int $level
 * @property string $password
 * @property int $status
 * @property \Carbon\Carbon $suspend_time
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereSuspendTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereUpdatedAt($value)
 */
	class Admin extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Banner
 *
 * @property int $id
 * @property string $nama
 * @property string $file
 * @property string $phone
 * @property string $url
 * @property string $lat
 * @property string $long
 * @property string $confirmation
 * @property int $order
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereConfirmation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereUrl($value)
 */
	class Banner extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Feedback
 *
 * @property int $id
 * @property string $email
 * @property string $feedback
 * @property int $rating
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereFeedback($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereUpdatedAt($value)
 */
	class Feedback extends \Eloquent {}
}

namespace App\Models{
/**
 * Class KategoriProduk
 *
 * @property int $id
 * @property string $kategori
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\KategoriProduk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\KategoriProduk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\KategoriProduk query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\KategoriProduk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\KategoriProduk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\KategoriProduk whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\KategoriProduk whereUpdatedAt($value)
 */
	class KategoriProduk extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Manager
 *
 * @property int $id
 * @property string $nickname
 * @property string $email
 * @property int $email_st
 * @property string $emailtoken
 * @property string $password
 * @property \Carbon\Carbon $email_expired
 * @property int $status
 * @property \Carbon\Carbon $suspend_time
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager whereEmailExpired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager whereEmailSt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager whereEmailtoken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager whereSuspendTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager whereUpdatedAt($value)
 */
	class Manager extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Merchant
 *
 * @property int $id
 * @property string $nickname
 * @property string $email
 * @property string $password
 * @property string $lat
 * @property string $long
 * @property string $foto
 * @property int $status
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereUpdatedAt($value)
 */
	class Merchant extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Product
 *
 * @property int $id
 * @property string $nama
 * @property int $kategori
 * @property string $foto
 * @property int $harga
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereHarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Token
 *
 * @property int $id
 * @property string $token_old
 * @property string $token_new
 * @property int $user
 * @property \Carbon\Carbon $expire
 * @property int $os
 * @property string $devicetoken
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereDevicetoken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereExpire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereTokenNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereTokenOld($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Token whereUser($value)
 */
	class Token extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Trending
 *
 * @property int $id
 * @property int $merchants
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trending newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trending newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trending query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trending whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trending whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trending whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trending whereMerchants($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Trending whereUpdatedAt($value)
 */
	class Trending extends \Eloquent {}
}

namespace App\Models{
/**
 * Class TrendingCategory
 *
 * @property int $id
 * @property string $kategori
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrendingCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrendingCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrendingCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrendingCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrendingCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrendingCategory whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrendingCategory whereUpdatedAt($value)
 */
	class TrendingCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * Class TrendingMerchant
 *
 * @property int $id
 * @property int $trending
 * @property int $merchant
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrendingMerchant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrendingMerchant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrendingMerchant query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrendingMerchant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrendingMerchant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrendingMerchant whereMerchant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrendingMerchant whereTrending($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrendingMerchant whereUpdatedAt($value)
 */
	class TrendingMerchant extends \Eloquent {}
}

namespace App\Models{
/**
 * Class User
 *
 * @property int $id
 * @property string $nickname
 * @property string $email
 * @property int $email_st
 * @property string $password
 * @property string $gender
 * @property string $foto_profil
 * @property string $email_token
 * @property \Carbon\Carbon $email_expired
 * @property int $status
 * @property \Carbon\Carbon $suspend_time
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailExpired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailSt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFotoProfil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereSuspendTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $username
 * @property string $nickname
 * @property string $email
 * @property string $password
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUsername($value)
 * @mixin \Eloquent
 * @property string|null $suspend_time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSuspendTime($value)
 * @property int $created_by
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedBy($value)
 * @property int $email_st
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailSt($value)
 * @property string $email_token
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailToken($value)
 * @property string|null $email_expired
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailExpired($value)
 * @property string|null $gender
 * @property string|null $foto_profil
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFotoProfil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereGender($value)
 */
	class User extends \Eloquent {}
}

