<?php

namespace App\Models\Tenant;

use App\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//use Illuminate\Database\Eloquent\SoftDeletes;

//use Spatie\MediaLibrary\HasMedia;
//use Spatie\MediaLibrary\InteractsWithMedia;
//use Spatie\MediaLibrary\MediaCollections\Models\Media;

//use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
//use Astrotomic\Translatable\Translatable;

/**
 * App\Models\CategoryProduct
 * @OA\Schema (schema="_CategoryProduct")
 */

class CategoryProduct extends Model
    //implements
    //HasMedia
    //TranslatableContract
{
    use
        //InteractsWithMedia,
        //Translatable,
        SoftDeletes,
        ColumnFillable;

    public $table = 'category_product';
    public $timestamps = true;

    //protected $connection = 'pgsql';

}
