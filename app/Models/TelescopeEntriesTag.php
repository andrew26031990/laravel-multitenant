<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class TelescopeEntriesTag
 * 
 * @property uuid $entry_uuid
 * @property string $tag
 * 
 * @property TelescopeEntry $telescopeEntry
 *
 * @package App\Models
 */
class TelescopeEntriesTag extends Model
{
	use HasFactory;
	public $incrementing = false;
	public $timestamps = false;
	public static $snakeAttributes = false;

	protected $casts = [
		'entry_uuid' => 'uuid'
	];

	protected $fillable = [
		'entry_uuid',
		'tag'
	];

	public function telescopeEntry(): BelongsTo
	{
		return $this->belongsTo(TelescopeEntry::class, 'entry_uuid', 'uuid');
	}
}
