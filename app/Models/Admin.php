<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 30 Jun 2019 19:56:55 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Admin
 *
 * @property int $id
 * @property string $nickname
 * @property string $email
 * @property int $level
 * @property string $password
 * @property int $status
 * @property \Carbon\Carbon $suspend_time
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereSuspendTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Admin extends Eloquent
{
	protected $table = 'admin';

	protected $casts = [
		'level' => 'int',
		'status' => 'int'
	];

	protected $dates = [
		'suspend_time'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'nickname',
		'email',
		'level',
		'password',
		'status',
		'suspend_time'
	];
}
