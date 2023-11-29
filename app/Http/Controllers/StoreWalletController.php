<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransferResource;
use App\Http\Resources\WalletResource;
use App\Services\TransferService;
use App\Services\CreateWallet;
use App\Services\GetWallet;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StoreWalletController extends Controller
{
    /**
     * @OA\Post(
     *     path="/wallets",
     *     summary="Create a new wallet",
     *     description="create a new wallet",
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
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $wallet = app(CreateWallet::class)->execute($request->all());

        } catch (Exception $e) {
            return response()
                ->json(['message' => $e->getMessage()])
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return (new WalletResource($wallet))->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
