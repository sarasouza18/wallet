<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransferResource;
use App\Http\Resources\WalletResource;
use App\Services\CreateTransfer;
use App\Services\CreateWallet;
use App\Services\GetWallet;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WalletController extends Controller
{
    public function store(Request $request): JsonResponse
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

    public function show(string $id): JsonResponse
    {
        try {
            $wallet = app(GetWallet::class)->execute(['id' => $id]);

        } catch (Exception $e) {
            return response()
                ->json(['message' => $e->getMessage()])
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return (new WalletResource($wallet))->response()->setStatusCode(Response::HTTP_OK);
    }

    public function transfer(Request $request): JsonResponse
    {
        try {
            $transfer = app(CreateTransfer::class)->execute($request->all());
        } catch (Exception $e) {
            return response()
                ->json(['message' => $e->getMessage()])
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return (new TransferResource($transfer))->response()->setStatusCode(Response::HTTP_CREATED);
    }
}
