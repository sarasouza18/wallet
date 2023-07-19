<?php


namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

abstract class Service
{

    /**
     * Get the validation rules that apply to the service.
     *
     * @return array
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * Get the validation messages that apply to the service.
     *
     * @return array
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * Validate all datas to execute the service.
     *
     * @param array $data
     * @return bool
     * @throws ValidationException
     */
    public function validate(array $data): bool
    {
        Validator::make($data, $this->rules(), $this->messages())
            ->validate();

        return true;
    }
}
