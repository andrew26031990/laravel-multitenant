<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use App\Traits\ColumnFillable;

//use Illuminate\Database\Eloquent\SoftDeletes;

//use Spatie\MediaLibrary\HasMedia;
//use Spatie\MediaLibrary\InteractsWithMedia;
//use Spatie\MediaLibrary\MediaCollections\Models\Media;

//use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
//use Astrotomic\Translatable\Translatable;

/**
 * App\Models\User
 * @OA\Schema (schema="_User")
 */ 

class User extends Model 
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

    
    /**
    
    *  @OA\Property(
    *    property="id",
    *    type="integer",
    *    example="",
    *    description=""
    *  ) 
    

    
    *  @OA\Property(
    *    property="name",
    *    type="string",
    *    example="",
    *    description="Имя"
    *  ) 
    

    
    *  @OA\Property(
    *    property="email",
    *    type="string",
    *    example="",
    *    description=""
    *  ) 
    

    
    *  @OA\Property(
    *    property="email_verified_at",
    *    type="string",
    *    example="",
    *    description=""
    *  ) 
    

    
    *  @OA\Property(
    *    property="password",
    *    type="string",
    *    example="",
    *    description=""
    *  ) 
    

    
    *  @OA\Property(
    *    property="remember_token",
    *    type="string",
    *    example="",
    *    description=""
    *  ) 
    

    
    *  @OA\Property(
    *    property="created_at",
    *    type="string",
    *    example="",
    *    description=""
    *  ) 
    

    
    *  @OA\Property(
    *    property="updated_at",
    *    type="string",
    *    example="",
    *    description=""
    *  ) 
    

    */    

    public $timestamps = true;

    protected $casts = [];

    protected $appends = [];

    protected $hidden = [];

    //public $translatedAttributes = [
    //    'title'
    //];

    //public function registerMediaConversions(
    //    Media $media = null
    //): void {
    //    $this->addMediaConversion('medium')
    //        ->width(400)
    //       ->nonQueued();
    //}

    //public function registerMediaCollections(Media $media = null): void
    //{
    //    $this->addMediaCollection('preview')
    //        ->singleFile();
    //}

}
