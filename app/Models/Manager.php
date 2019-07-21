<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 21 Jul 2019 17:27:20 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Manager
 *
 * @property int $id
 * @property string $nickname
 * @property string $email
 * @property int $email_st
 * @property string $emailtoken
 * @property string $password
 * @property \Carbon\Carbon $email_expired
 * @property int $status
 * @property \Carbon\Carbon $suspend_time
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager whereEmailExpired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager whereEmailSt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager whereEmailtoken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager whereSuspendTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Manager whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Manager extends Eloquent
{
	protected $table = 'manager';

	protected $casts = [
		'email_st' => 'int',
		'status' => 'int'
	];

	protected $dates = [
		'email_expired',
		'suspend_time'
	];

	protected $hidden = [
		'emailtoken',
		'password'
	];

	protected $fillable = [
		'nickname',
		'email',
		'email_st',
		'emailtoken',
		'password',
		'email_expired',
		'status',
		'suspend_time'
	];
}
