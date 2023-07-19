<?php

namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="TransferResource",
 *     description="Transfer resource",
 *     type="object"
 * )
 */
class TransferResource extends JsonResource
{
    /**
     * @OA\Property (property="id", type="string", example="1")
     * @OA\Property (property="wallet_id", type="string", example="e6361d62-2666-11ee-be56-0242ac120002")
     * @OA\Property (property="wallet_payee_id", type="string", example="e6361d62-2666-11ee-be56-0242ac120002")
     * @OA\Property (property="amount", type="integer", example=0)
     * @OA\Property (property="transaction_id", type="string", example="1")
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
            'wallet_id' => $this->wallet_id,
            'wallet_payee_id' => $this->wallet_payee_id,
            'transaction_id' => $this->transaction_id,
            'amount' => $this->amount,
            'updated_at' => $this->updated_at,
        ];
    }
}

