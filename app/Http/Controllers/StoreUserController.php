<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Exception;
use Illuminate\Http\Response;

class StoreUserController extends Controller
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
     * @param StoreUserRequest $request
     *
     * @return JsonResponse
     */
    public function __invoke(StoreUserRequest $request): JsonResponse
    {
        $requestData = $request->validated();

        try {
            $user = app(UserService::class)->execute($requestData);

        } catch (Exception $e) {
            return response()
                ->json(['message' => $e->getMessage()])
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return (new UserResource($user))->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
