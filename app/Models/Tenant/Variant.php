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
 * App\Models\Product
 * @OA\Schema (schema="_Product")
 */

class Variant extends Model
    //implements
    //HasMedia
    //TranslatableContract
{
    use
        HasFactory,
        //InteractsWithMedia,
        //Translatable,
        SoftDeletes,
        ColumnFillable;

    public $table = 'variants';

    public function product(){
        return $this->belongsTo(Product::class);
    }

    //protected $connection = 'pgsql';

}
