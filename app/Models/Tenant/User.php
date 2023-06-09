<?php

namespace App\Models\Tenant;


use App\Models\CentralUser;
use App\Models\Tenant;
use App\Models\Test;
use App\Models\VerificationCode;
use App\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Stancl\Tenancy\Contracts\Syncable;
use Stancl\Tenancy\Database\Concerns\ResourceSyncing;
use Stancl\Tenancy\Database\Models\TenantPivot;

class User extends Authenticatable implements Syncable
{
    use HasApiTokens, HasFactory, Notifiable;

    use ResourceSyncing, ColumnFillable;

    //protected $connection = 'pgsql';
    protected $guarded = [];
    public $timestamps = true;

    public $keyType = 'string';
    protected $primaryKey = 'id';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    /*protected $fillable = [
        'id',
        'phone',
        'first_name',
        'last_name',
        'is_active',
    ];*/

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tenants(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tenant::class, 'tenant_users', 'user_id', 'tenant_id', 'id')
            ->using(TenantPivot::class);
    }

    public function tests()
    {
        return $this->hasMany(Test::class);
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
        return CentralUser::class;
    }

    public function getSyncedAttributeNames(): array
    {
        return [
            //'id',
            'is_active',
            'first_name',
            'last_name',
            'created_at',
            'updated_at',
            'deleted_at',
        ];
    }
}
