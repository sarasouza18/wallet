<?php

namespace App\Services;

use App\Models\Wallet;
use Illuminate\Validation\ValidationException;

class CreateWallet extends Service
{
    /**
     * Get the validation rules that apply to the service.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_id' => [
                'required',
                'string',
                'exists:users,id'
            ],
        ];
    }

    /**
     * Create an activity type.
     *
     * @param array $data
     *
     * @return Wallet
     * @throws ValidationException
     */
    public function execute(array $data): Wallet
    {
        $this->validate($data);

        $wallet = new Wallet($data);
        $wallet->save();

        return $wallet;
    }
}
