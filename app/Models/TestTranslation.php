<?php

namespace App\Models;

use App\Traits\ColumnFillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TestTranslation
 */ 

class TestTranslation extends Model 
{
    use HasFactory, ColumnFillable;

    protected $primaryKey = [
        //'second_key',
        'locale'
    ];

    public $timestamps = false;

    public $incrementing = false;

}
