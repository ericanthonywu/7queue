<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 27 Jun 2019 09:00:46 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

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
 * @mixin \Eloquent
 */
class Token extends Eloquent
{
	protected $table = 'token';

	protected $casts = [
		'user' => 'int',
		'os' => 'int'
	];

	protected $dates = [
		'expire'
	];

	protected $hidden = [
		'devicetoken'
	];

	protected $fillable = [
		'token_old',
		'token_new',
		'user',
		'expire',
		'os',
		'devicetoken'
	];
}
