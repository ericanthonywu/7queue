<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 02 Jul 2019 16:47:06 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

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
 * @mixin \Eloquent
 */
class Trending extends Eloquent
{
	protected $table = 'trending';

	protected $casts = [
		'merchants' => 'int',
		'created_by' => 'int'
	];

	protected $fillable = [
		'merchants',
		'created_by'
	];
}
