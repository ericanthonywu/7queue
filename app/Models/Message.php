<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 21 Jul 2019 17:27:20 +0700.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Message
 *
 * @property int $id
 * @property int $customer
 * @property string $judul
 * @property string $pesan
 * @property string $gambar
 * @property int $push_notif
 * @property int $tipe
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereCustomer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereGambar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message wherePesan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message wherePushNotif($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereTipe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Message whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Message extends Eloquent
{
	protected $table = 'message';

	protected $casts = [
		'customer' => 'int',
		'push_notif' => 'int',
		'tipe' => 'int'
	];

	protected $fillable = [
		'customer',
		'judul',
		'pesan',
		'gambar',
		'push_notif',
		'tipe'
	];
}
