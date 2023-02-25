<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Test
 * 
 * @property int $id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property User $user
 * @property Collection|TestLog[] $test_logs
 * @property Collection|TestTranslation[] $test_translations
 *
 * @package App\Models
 */
class Test extends Model
{
	use SoftDeletes;
	protected $table = 'tests';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function test_logs()
	{
		return $this->hasMany(TestLog::class);
	}

	public function test_translations()
	{
		return $this->hasMany(TestTranslation::class);
	}
}
