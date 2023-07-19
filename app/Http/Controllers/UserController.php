<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\CreateUser;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{

    /**
     * @OA\Post(
     *     path="/users",
     *     summary="Create a new user",
     *     description="create a new user",
     *
     *     @OA\Parameter(
     *          name="token",
     *          description="token id",
     *          required=false,
     *          in="header",
     *          @OA\Schema(
     *              type="string",
     *              example="token"
     *        )
     *     ),
     *
     *     @OA\Response(
     *          response="201",
     *          description="Success",
     *     ),
     *     @OA\Response(
     *          response=500,
     *          description="Exception message"
     *     ),
     * )
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
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
