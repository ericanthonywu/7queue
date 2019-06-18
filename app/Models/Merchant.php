<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 18 Jun 2019 11:43:06 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Merchant
 *
 * @property int $id
 * @property string $username
 * @property string $nickname
 * @property string $email
 * @property string $password
 * @property int $status
 * @property int $created_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereUsername($value)
 * @mixin \Eloquent
 */
class Merchant extends Eloquent
{
	protected $casts = [
		'status' => 'int',
		'created_by' => 'int'
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
		'created_by'
	];
}
