<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 30 Jul 2019 23:32:52 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class MerchantProduct
 *
 * @property int $id
 * @property int $merchant
 * @property int $products
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantProduct whereMerchant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantProduct whereProducts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MerchantProduct extends Eloquent
{
	protected $casts = [
		'merchant' => 'int',
		'products' => 'int'
	];

	protected $fillable = [
		'merchant',
		'products'
	];
}
