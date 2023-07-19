<?php

namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="UserResource",
 *     description="User resource",
 *     type="object"
 * )
 */
class UserResource extends JsonResource
{
    /**
     * @OA\Property (property="id", type="string", example="1")
     * @OA\Property (property="name", type="string", example="maria")
     * @OA\Property (property="email", type="string", example="maria@gmail.com")
     * @OA\Property (property="type", type="integer", example=1)
     *
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'type' => $this->type,
        ];
    }
}

