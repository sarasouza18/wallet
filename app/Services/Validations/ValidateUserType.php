<?php

namespace App\Services\Validations;

use App\Models\User\UserType;
use App\Services\Service;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class ValidateUserType extends Service
{

    /**
     * @param string $userType
     * @throws Exception
     */
    public function execute(string $userType) : void
    {
        try {
            if ($userType != UserType::CUSTOMER) {
                throw new Exception('User type not allowed');
            }
        } catch (Throwable $e) {
            Log::info($e->getMessage(), ['code' => 'user_type_not_allowed', 'exception' => $e,]);
            throw new Exception('User type not allowed for this operation.');
        }
    }
}
