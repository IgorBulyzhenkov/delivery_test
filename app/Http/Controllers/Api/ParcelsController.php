<?php

namespace App\Http\Controllers\Api;

use App\Services\Api\ParcelsService;
use App\Http\Requests\Api\ParcelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParcelsController extends BaseController
{
    protected ParcelsService $parcelsService;

    public function __construct(ParcelsService $parcelsService)
    {
        $this->parcelsService = $parcelsService;
    }

    public function addParcels(Request $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $parReq = new ParcelsRequest();

        $validator = Validator::make($request->all(), $parReq->rules());

        if ($validator->fails()) {
            return response()->json(['status' => false, 'error' => $validator->messages()], 400);
        }

        if (!DeliveriesController::getOneDelivery($request->id_deliveries)) {
            return response(['status' => false, 'error' => 'not found deliveries'], 404);
        }

        $result = $this->parcelsService->handleCreate($request->all());

        return response([
            'status' => true,
            'uuid' => $result['uuid'],
            'message' => 'Parcel created'
        ], 201);
    }
}
