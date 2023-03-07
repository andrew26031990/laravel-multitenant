<?php

namespace App\Models\Tenant;


use App\Models\Employee;
use App\Models\Tenant;
use App\Models\Test;
use App\Models\VerificationCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Stancl\Tenancy\Contracts\Syncable;
use Stancl\Tenancy\Database\Concerns\ResourceSyncing;
use Stancl\Tenancy\Database\Models\TenantPivot;

class User extends Authenticatable implements Syncable
{
    use HasApiTokens, HasFactory, Notifiable;

    use ResourceSyncing;

    //protected $connection = 'pgsql';
    protected $guarded = [];
    public $timestamps = false;

    public $keyType = 'string';
    protected $primaryKey = 'id';
    //public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone',
        'first_name',
        'last_name',
        'is_active',
    ];

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
        return Employee::class;
    }

    public function getSyncedAttributeNames(): array
    {
        return [
            'is_active',
            'first_name',
            'last_name'
        ];
    }
}
