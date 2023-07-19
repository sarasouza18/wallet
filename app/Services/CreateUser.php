<?php

namespace App\Services;

use App\Models\User\User;
use Illuminate\Validation\ValidationException;

class CreateUser extends Service
{
    /**
     * Get the validation rules that apply to the service.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:10',
                'max:70',
                'string',
            ],
            'document' => [
                'required',
                'unique:users',
                'max:14',
                'string',
            ],
            'email' => [
                'required',
                'unique:users',
                'string',
            ],
            'password' => [
                'min:6'
            ],
            'type_id' => [
                'integer',
                'required',
                'exists:user_types,id',
            ]
        ];
    }

    /**
     * Create an activity type.
     *
     * @param array $data
     *
     * @return User
     * @throws ValidationException
     */
    public function execute(array $data): User
    {
        $this->validate($data);

        $user = new User($data);
        $user->save();

        return $user;
    }
}
