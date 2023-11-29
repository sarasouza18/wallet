<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
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
}
