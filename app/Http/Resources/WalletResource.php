<?php

namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="WalletResource",
 *     description="Wallet resource",
 *     type="object"
 * )
 */
class WalletResource extends JsonResource
{
    /**
     * @OA\Property (property="id", type="string", example="e6361d62-2666-11ee-be56-0242ac120002")
     * @OA\Property (property="balance", type="integer", example=0)
     * @OA\Property (property="updated_at", type="string", format="date-time", example="2023-02-01T12:10:34.000000Z"),
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
            'balance' => $this->balance,
            'updated_at' => $this->updated_at,
        ];
    }
}

