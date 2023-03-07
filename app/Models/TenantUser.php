<?php

namespace App\Models;

use App\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use Illuminate\Database\Eloquent\SoftDeletes;

//use Spatie\MediaLibrary\HasMedia;
//use Spatie\MediaLibrary\InteractsWithMedia;
//use Spatie\MediaLibrary\MediaCollections\Models\Media;

//use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
//use Astrotomic\Translatable\Translatable;

/**
 * App\Models\TenantUser
 * @OA\Schema (schema="_TenantUser")
 */

class TenantUser extends Model
    //implements
    //HasMedia
    //TranslatableContract
{
    use
        HasFactory,
        //InteractsWithMedia,
        //Translatable,
        //SoftDeletes,
        ColumnFillable;

    public $table = 'tenant_users';

}
