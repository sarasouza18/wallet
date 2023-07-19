<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\CreateUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{

    public function store(Request $request): UserResource
    {
        try {
            $user = app(CreateUser::class)->execute($request->all());

        } catch (Exception $e) {
            return response()
                ->json(['message' => $e->getMessage()])
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return (new UserResource($user))->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
