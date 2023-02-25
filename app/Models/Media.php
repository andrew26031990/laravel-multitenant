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
 * App\Models\Media
 *
 * @OA\Schema (schema="_Media")
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property string|null $uuid
 * @property string $collection_name
 * @property string $name
 * @property string $file_name
 * @property string|null $mime_type
 * @property string $disk
 * @property string|null $conversions_disk
 * @property int $size
 * @property mixed $manipulations
 * @property mixed $custom_properties
 * @property mixed $generated_conversions
 * @property mixed $responsive_images
 * @property int|null $order_column
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media query()
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCollectionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereConversionsDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCustomProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereGeneratedConversions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereManipulations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereResponsiveImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUuid($value)
 * @mixin \Eloquent
 */ 

class Media extends Model 
    //implements HasMedia
    //implements TranslatableContract
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
    *    property="model_type",
    *    type="string",
    *    example="",
    *    description=""
    *  ) 
    

    
    *  @OA\Property(
    *    property="model_id",
    *    type="integer",
    *    example="",
    *    description=""
    *  ) 
    

    
    *  @OA\Property(
    *    property="uuid",
    *    type="string",
    *    example="",
    *    description=""
    *  ) 
    

    
    *  @OA\Property(
    *    property="collection_name",
    *    type="string",
    *    example="",
    *    description=""
    *  ) 
    

    
    *  @OA\Property(
    *    property="name",
    *    type="string",
    *    example="",
    *    description=""
    *  ) 
    

    
    *  @OA\Property(
    *    property="file_name",
    *    type="string",
    *    example="",
    *    description=""
    *  ) 
    

    
    *  @OA\Property(
    *    property="mime_type",
    *    type="string",
    *    example="",
    *    description=""
    *  ) 
    

    
    *  @OA\Property(
    *    property="disk",
    *    type="string",
    *    example="",
    *    description=""
    *  ) 
    

    
    *  @OA\Property(
    *    property="conversions_disk",
    *    type="string",
    *    example="",
    *    description=""
    *  ) 
    

    
    *  @OA\Property(
    *    property="size",
    *    type="integer",
    *    example="",
    *    description=""
    *  ) 
    

    
    *  @OA\Property(
    *    property="manipulations",
    *    type="mixed",
    *    example="",
    *    description=""
    *  ) 
    

    
    *  @OA\Property(
    *    property="custom_properties",
    *    type="mixed",
    *    example="",
    *    description=""
    *  ) 
    

    
    *  @OA\Property(
    *    property="generated_conversions",
    *    type="mixed",
    *    example="",
    *    description=""
    *  ) 
    

    
    *  @OA\Property(
    *    property="responsive_images",
    *    type="mixed",
    *    example="",
    *    description=""
    *  ) 
    

    
    *  @OA\Property(
    *    property="order_column",
    *    type="integer",
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
