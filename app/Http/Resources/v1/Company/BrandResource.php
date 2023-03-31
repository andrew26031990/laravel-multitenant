<?php

namespace App\Http\Resources\v1\Company;

use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @OA\Schema (schema="v1.Company.BrandResource")
 */

class BrandResource extends JsonResource
{

    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
