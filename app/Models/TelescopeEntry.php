<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class TelescopeEntry
 * 
 * @property int $sequence
 * @property uuid $uuid
 * @property uuid $batch_id
 * @property string|null $family_hash
 * @property bool $should_display_on_index
 * @property string $type
 * @property string $content
 * @property Carbon|null $created_at
 * 
 * @property TelescopeEntriesTag $telescopeEntriesTag
 *
 * @package App\Models
 */
class TelescopeEntry extends Model
{
	use HasFactory;
	protected $primaryKey = 'sequence';
	public $timestamps = false;
	public static $snakeAttributes = false;

	protected $casts = [
		'uuid' => 'uuid',
		'batch_id' => 'uuid',
		'should_display_on_index' => 'bool'
	];

	protected $fillable = [
		'uuid',
		'batch_id',
		'family_hash',
		'should_display_on_index',
		'type',
		'content'
	];

	public function telescopeEntriesTag(): HasOne
	{
		return $this->hasOne(TelescopeEntriesTag::class, 'entry_uuid', 'uuid');
	}
}
