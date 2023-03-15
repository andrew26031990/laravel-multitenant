<?php

namespace App\Http\Resources\v1\Profile;

use Illuminate\Http\Resources\Json\JsonResource;


/**
 *
 * Class UserResource.
 * @OA\Schema (schema="v1.Profile.UserResource")
 * @mixin \App\Models\CentralUser
 *
 */

class UserResource extends JsonResource
{

    /**
     *  @OA\Property(
     *    property="id",
     *    type="integer",
     *    example="",
     *    description="ID пользователя"
     *  )
     *
     *
     *  @OA\Property(
     *    property="phone",
     *    type="string",
     *    example="",
     *    description="Номер телефона пользователя"
     *  )
     *
     *  @OA\Property(
     *    property="first_name",
     *    type="string",
     *    example="",
     *    description="Имя"
     *  )
     *
     *
     *  @OA\Property(
     *    property="last_name",
     *    type="string",
     *    example="",
     *    description="Фамилия"
     *  )
     *
     *
     *  @OA\Property(
     *    property="is_active",
     *    type="boolean",
     *    example="",
     *    description="Статус пользователя"
     *  )
     *
     *
     *  @OA\Property(
     *    property="created_at",
     *    type="datetime",
     *    example="",
     *    description="Дата создания сотрудника"
     *  )
     *
     * @OA\Property(
     *    property="updated_at",
     *    type="string",
     *    example="",
     *    description="Дата обновления сотрудника"
     *  )
     *
     */

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'phone' => $this->phone,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    public function withResponse($request, $response)
    {
        if (optional($this)->access) {
            $response->header('X-Access-Token', (string) optional($this->access)->accessToken);
            $response->header('X-Access-Token-Expires-At', (string) optional(optional($this->access)->token)['expires_at']);
        }
    }
}
