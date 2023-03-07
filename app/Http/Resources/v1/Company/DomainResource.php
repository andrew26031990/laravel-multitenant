<?php

namespace App\Http\Resources\v1\Company;

use Illuminate\Http\Resources\Json\JsonResource;
use Stancl\Tenancy\Database\Models\Domain;


/**
 *
 * Class DomainResource.
 * @OA\Schema (schema="v1.Company.DomainResource")
 * @mixin \Stancl\Tenancy\Database\Models\Domain
 *
 */

class DomainResource extends JsonResource
{

    /**
     *
     * @OA\Property(
     *    property="id",
     *    type="string",
     *    example="",
     *    description="ID домена"
     *  )
     *
     *
     * @OA\Property(
     *    property="domain",
     *    type="string",
     *    example="",
     *    description="Название домена"
     *  )
     *
     */
    public function toArray($request)
    {
        return [
            'domain' => $this->domain
        ];
    }
}
