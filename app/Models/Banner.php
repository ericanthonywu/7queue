<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 19 Jul 2019 18:04:56 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Banner
 *
 * @property int $id
 * @property string $nama
 * @property string $file
 * @property string $phone
 * @property string $url
 * @property string $lat
 * @property string $long
 * @property string $confirmation
 * @property int $order
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereConfirmation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Banner whereUrl($value)
 * @mixin \Eloquent
 */
class Banner extends Eloquent
{
	protected $table = 'banner';

	protected $casts = [
		'order' => 'int'
	];

	protected $fillable = [
		'nama',
		'file',
		'phone',
		'url',
		'lat',
		'long',
		'confirmation',
		'order'
	];
}
