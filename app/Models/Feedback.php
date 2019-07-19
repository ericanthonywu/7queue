<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 19 Jul 2019 18:04:56 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Feedback
 *
 * @property int $id
 * @property string $comments
 * @property string $email
 * @property int $rating
 * @property int $merchant_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereComments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Feedback whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Feedback extends Eloquent
{
	protected $casts = [
		'rating' => 'int',
		'merchant_id' => 'int'
	];

	protected $fillable = [
		'comments',
		'email',
		'rating',
		'merchant_id'
	];
}
