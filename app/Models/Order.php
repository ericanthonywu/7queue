<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 09 Aug 2019 07:15:33 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Order
 *
 * @property int $id
 * @property int $user
 * @property int $merchant
 * @property int $products
 * @property int $num_order
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $note
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereMerchant($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereNumOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereProducts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUser($value)
 * @mixin \Eloquent
 */
class Order extends Eloquent
{
	protected $table = 'order';

	protected $casts = [
		'user' => 'int',
		'merchant' => 'int',
		'products' => 'int',
		'num_order' => 'int'
	];

	protected $fillable = [
		'user',
		'merchant',
		'products',
		'num_order',
		'note'
	];
}
