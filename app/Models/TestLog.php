<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TestLog
 * 
 * @property int $id
 * @property string|null $name
 * @property int $test_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property Test $test
 *
 * @package App\Models
 */
class TestLog extends Model
{
	use SoftDeletes;
	protected $table = 'test_logs';

	protected $casts = [
		'test_id' => 'int'
	];

	protected $fillable = [
		'name',
		'test_id'
	];

	public function test()
	{
		return $this->belongsTo(Test::class);
	}
}
