<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 30 Jun 2019 19:56:56 +0700.
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
    protected $hidden = [
        "id",
        "created_at",
        "updated_at"
    ];

	protected $fillable = [
		'notelp',
		'email',
		'privacy_policy',
		'faq'
	];
}