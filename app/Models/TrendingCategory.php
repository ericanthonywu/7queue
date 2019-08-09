<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 09 Aug 2019 07:15:33 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

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
 * @mixin \Eloquent
 */
class TrendingCategory extends Eloquent
{
	protected $table = 'trending_category';

	protected $fillable = [
		'kategori'
	];
}
