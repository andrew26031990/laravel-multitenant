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

class Product extends Model
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

    public $table = 'products';
    public $timestamps = true;

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function variants(){
        return $this->hasMany(Variant::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    //protected $connection = 'pgsql';

}
