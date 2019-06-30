<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 30 Jun 2019 19:56:56 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

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
 * @mixin \Eloquent
 */
class TrendingMerchant extends Eloquent
{
	protected $table = 'trending_merchant';

	protected $casts = [
		'trending' => 'int',
		'merchant' => 'int'
	];

	protected $fillable = [
		'trending',
		'merchant'
	];
}
