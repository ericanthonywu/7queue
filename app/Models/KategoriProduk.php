<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 15 Jun 2019 13:14:14 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class KategoriProduk
 *
 * @property int $id
 * @property string $kategori
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\KategoriProduk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\KategoriProduk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\KategoriProduk query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\KategoriProduk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\KategoriProduk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\KategoriProduk whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\KategoriProduk whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class KategoriProduk extends Eloquent
{
	protected $table = 'kategori_produk';

	protected $fillable = [
		'kategori'
	];
}
