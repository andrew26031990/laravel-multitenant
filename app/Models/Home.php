<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Home
 * 
 * @property int $id
 * @property string $number
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 *
 * @package App\Models
 */
class Home extends Model
{
	use SoftDeletes;
	use HasFactory;
	public static $snakeAttributes = false;

	protected $fillable = [
		'number'
	];
}
