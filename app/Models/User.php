<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 03 Jun 2019 10:51:39 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 *
 * @property int $id
 * @property string $username
 * @property string $nickname
 * @property string $email
 * @property string $password
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereSuspendTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends Eloquent
{
	protected $casts = [
		'status' => 'int'
	];

	protected $dates = [
		'suspend_time'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'username',
		'nickname',
		'email',
		'password',
		'status',
		'suspend_time'
	];
}