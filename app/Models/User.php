<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 18 Jun 2019 11:43:06 +0000.
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
 * @property int $email_st
 * @property string $password
 * @property string $email_token
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailSt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailToken($value)
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
		'email_st' => 'int',
		'status' => 'int'
	];

	protected $dates = [
		'suspend_time'
	];

	protected $hidden = [
		'password',
		'email_token'
	];

	protected $fillable = [
		'username',
		'nickname',
		'email',
		'email_st',
		'password',
		'email_token',
		'status',
		'suspend_time'
	];
}
