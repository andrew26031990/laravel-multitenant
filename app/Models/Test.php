<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Test
 * 
 * @property int $id
 * @property string|null $name
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * 
 * @property User $user
 * @property Collection|TestLog[] $testLogs
 * @property Collection|TestTranslation[] $testTranslations
 *
 * @package App\Models
 */
class Test extends Model
{
	use SoftDeletes;
	use HasFactory;
	protected $table = 'tests';
	public static $snakeAttributes = false;

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'name',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function testLogs()
	{
		return $this->hasMany(TestLog::class);
	}

	public function testTranslations()
	{
		return $this->hasMany(TestTranslation::class);
	}
}
