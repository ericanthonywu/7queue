<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 25 Jun 2019 11:32:56 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

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
 * @mixin \Eloquent
 */
class Feedback extends Eloquent
{
	protected $casts = [
		'rating' => 'int'
	];

	protected $fillable = [
		'email',
		'feedback',
		'rating'
	];
}
