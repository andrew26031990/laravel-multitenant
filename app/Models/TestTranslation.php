<?php

namespace App\Models;

use App\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TestTranslation
 * @OA\Schema (schema="_TestTranslation")
 */ 

class TestTranslation extends Model 
{
    use HasFactory, ColumnFillable;

    
    /**
    
    *  @OA\Property(
    *    property="test_id",
    *    type="integer",
    *    example="",
    *    description=""
    *  ) 
    

    
    *  @OA\Property(
    *    property="locale",
    *    type="string",
    *    example="",
    *    description="Язык"
    *  ) 
    

    
    *  @OA\Property(
    *    property="title",
    *    type="string",
    *    example="",
    *    description="Название"
    *  ) 
    

    */   

    protected $primaryKey = [
        //'second_key',
        'locale'
    ];

    public $timestamps = false;

    public $incrementing = false;

}
