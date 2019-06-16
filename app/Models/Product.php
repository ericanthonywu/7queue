<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 16 Jun 2019 14:16:40 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Product
 *
 * @property int $id
 * @property string $nama
 * @property int $kategori
 * @property string $foto
 * @property int $harga
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereHarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Product extends Eloquent
{
	protected $casts = [
		'kategori' => 'int',
		'harga' => 'int'
	];

	protected $fillable = [
		'nama',
		'kategori',
		'foto',
		'harga',
		'description'
	];
}
