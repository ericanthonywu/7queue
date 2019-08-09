<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 09 Aug 2019 07:15:33 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Bookmark
 *
 * @property int $id
 * @property int $merchant_id
 * @property int $user
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookmark newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookmark newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookmark query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookmark whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookmark whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookmark whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookmark whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Bookmark whereUser($value)
 * @mixin \Eloquent
 */
class Bookmark extends Eloquent
{
	protected $table = 'bookmark';

	protected $casts = [
		'merchant_id' => 'int',
		'user' => 'int'
	];

	protected $fillable = [
		'merchant_id',
		'user'
	];
}
