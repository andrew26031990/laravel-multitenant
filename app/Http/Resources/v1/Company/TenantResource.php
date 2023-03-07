<?php

namespace App\Http\Resources\v1\Company;

use Illuminate\Http\Resources\Json\JsonResource;


/**
 *
 * Class TenantResource.
 * @OA\Schema (schema="v1.Company.TenantResource")
 * @mixin \App\Models\Tenant
 *
 */

class TenantResource extends JsonResource
{
    /**
     * @OA\Property(
     *    property="id",
     *    type="string",
     *    example="",
     *    description="ID компании"
     *  )
     *
     *
     * @OA\Property(
     *    property="name",
     *    type="string",
     *    example="",
     *    description="Название компании"
     *  )
     *
     *   @OA\Property(
     *    property="slug",
     *    type="string",
     *    example="",
     *    description="Slug"
     *  )
     *
     *   @OA\Property(
     *    property="tenancy_db_name",
     *    type="string",
     *    example="",
     *    description="База данных компании"
     *  )
     */
    public function toArray($request)
    {
        return [
            'id' => is_object($this->id) ? $this->id->toString() : $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'domains' => DomainResource::collection($this->whenLoaded('domains'))
        ];
    }
}
