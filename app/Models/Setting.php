<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 09 Aug 2019 07:15:33 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Setting
 *
 * @property int $id
 * @property string $notelp
 * @property string $email
 * @property string $privacy_policy
 * @property string $faq
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereFaq($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereNotelp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting wherePrivacyPolicy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Setting extends Eloquent
{
	protected $fillable = [
		'notelp',
		'email',
		'privacy_policy',
		'faq'
	];
}
