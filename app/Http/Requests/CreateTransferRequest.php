<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransferRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'wallet_id' => [
                'required',
                'exists:wallets,id',
                'string',
            ],
            'amount' => [
                'required',
                'between:1,100000000',
                'integer',
            ],
            'wallet_payee_id' => [
                'required',
                'exists:wallets,id',
                'string',
            ],
        ];
    }
}
