<?php

namespace App\Models\Tenant;


use App\Models\Employee;
use App\Models\Test;
use App\Models\VerificationCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Stancl\Tenancy\Contracts\Syncable;
use Stancl\Tenancy\Database\Concerns\ResourceSyncing;

class User extends Authenticatable implements Syncable
{
    use HasApiTokens, HasFactory, Notifiable;

    use ResourceSyncing;

    protected $guarded = [];
    public $timestamps = false;

    //public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phone',
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
        ];
    }
}
