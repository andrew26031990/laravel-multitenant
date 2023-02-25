<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TestTranslation
 * 
 * @property int $test_id
 * @property string $locale
 * @property string|null $title
 * 
 * @property Test $test
 *
 * @package App\Models
 */
class TestTranslation extends Model
{
	protected $table = 'test_translations';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'test_id' => 'int'
	];

	protected $fillable = [
		'title'
	];

	public function test()
	{
		return $this->belongsTo(Test::class);
	}
}
