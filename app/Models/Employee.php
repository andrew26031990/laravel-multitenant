<?php

namespace App\Models;

use App\Models\Tenant\User;
use App\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Stancl\Tenancy\Contracts\SyncMaster;
use Stancl\Tenancy\Database\Concerns\CentralConnection;
use Stancl\Tenancy\Database\Concerns\ResourceSyncing;
use Stancl\Tenancy\Database\Models\TenantPivot;

//use Illuminate\Database\Eloquent\SoftDeletes;

//use Spatie\MediaLibrary\HasMedia;
//use Spatie\MediaLibrary\InteractsWithMedia;
//use Spatie\MediaLibrary\MediaCollections\Models\Media;

//use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
//use Astrotomic\Translatable\Translatable;

/**
 * App\Models\Employee
 * @OA\Schema (schema="_CentralUser")
 */

class Employee extends Model implements SyncMaster
    //implements
    //HasMedia
    //TranslatableContract
{
    use
        HasFactory,
        HasApiTokens,
        Notifiable,
        //InteractsWithMedia,
        //Translatable,
        //SoftDeletes,
        ColumnFillable,
        ResourceSyncing, CentralConnection;

    protected $guarded = [];
    protected $fillable = [
        'phone',
        'is_active',
    ];

    public $timestamps = false;
    public $table = 'users';
//    public $incrementing = false;


    public function tenants(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tenant::class, 'tenant_users', 'user_id', 'tenant_id', 'id')
            ->using(TenantPivot::class);
    }

    public function verificationCodes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(VerificationCode::class, 'user_id', 'id');
    }

    public function getTenantModelName(): string
    {
        return User::class;
    }

    public function getGlobalIdentifierKey()
    {
        return $this->getAttribute($this->getGlobalIdentifierKeyName());
    }

    public function getGlobalIdentifierKeyName(): string
    {
        return 'id';
    }

    public function getCentralModelName(): string
    {
        return static::class;
    }

    public function getSyncedAttributeNames(): array
    {
        return [
            'is_active',
        ];
    }
}
