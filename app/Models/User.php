<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 02 Jul 2019 16:47:06 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 *
 * @property int $id
 * @property string $nickname
 * @property string $email
 * @property int $email_st
 * @property string $password
 * @property string $gender
 * @property string $foto_profil
 * @property string $email_token
 * @property \Carbon\Carbon $email_expired
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailExpired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailSt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereFotoProfil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereSuspendTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Eloquent
{
	protected $casts = [
		'email_st' => 'int',
		'status' => 'int'
	];

	protected $dates = [
		'email_expired',
		'suspend_time'
	];

	protected $hidden = [
		'password',
		'email_token'
	];

	protected $fillable = [
		'nickname',
		'email',
		'email_st',
		'password',
		'gender',
		'foto_profil',
		'email_token',
		'email_expired',
		'status',
		'suspend_time'
	];
}
