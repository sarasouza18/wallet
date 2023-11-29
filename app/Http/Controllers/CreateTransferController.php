<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransferRequest;
use App\Http\Resources\TransferResource;
use App\Services\TransferService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CreateTransferController extends Controller
{

    /**
     * @OA\Post(
     *     path="/wallets/transfer",
     *     summary="Create a new transfer",
     *     description="Subtracts a value from wallet and add a value in another wallet.",
     *
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
     * @param CreateTransferRequest $request
     *
     * @return JsonResponse
     */
    public function __invoke(CreateTransferRequest $request): JsonResponse
    {
        $requestData = $request->validated();

        try {
            $transfer = app(TransferService::class)->execute($requestData);
        } catch (Exception $e) {
            return response()
                ->json(['message' => $e->getMessage()])
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return (new TransferResource($transfer))->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
